// Travel Bling Chat Widget Logic
(function(){
  var open=false,tab=0,lastMsg=0,lastBcast=0,unread=0,unreadP=0;
  var histLoaded=false,bkLoaded=false,prLoaded=false,acLoaded=false;
  var M=document.getElementById('msgs'),TY=document.getElementById('ty'),
      IC=document.getElementById('inlineCards'),CI=document.getElementById('ci'),
      CSB=document.getElementById('csb'),CB=document.getElementById('cb'),
      CIA=document.getElementById('cia'),PBD=document.getElementById('pbdg');

  // ── Toggle panel ─────────────────────────────────────
  window.wToggle=function(){
    open=!open;
    document.getElementById('cp').classList.toggle('open',open);
    document.getElementById('cfi').textContent=open?'close':'chat';
    if(open){
      unread=0;updBadge();
      if(!histLoaded)loadHist();
      if(tab===1&&!bkLoaded)loadAccount();
      setTimeout(function(){CI&&CI.focus();},300);
      scrollB();
    }
  };

  // ── Tab switch ────────────────────────────────────────
  window.wTab=function(n){
    tab=n;
    [0,1,2,3].forEach(function(i){
      document.getElementById('t'+i).classList.toggle('on',i===n);
      document.getElementById('p'+i).classList.toggle('on',i===n);
    });
    CIA.style.display=n===0?'':'none';
    if(n===0){unread=0;updBadge();}
    if(n===1){}  // tours tab - user picks region
    if(n===2&&!acLoaded)loadAccount();
    if(n===3){unreadP=0;PBD.style.display='none';if(!prLoaded)loadPromos();}
  };

  // ── Load chat history ─────────────────────────────────
  function loadHist(){
    histLoaded=true;
    fetch('index.php?controller=chat&action=history').then(r=>r.json()).then(function(d){
      if(d.messages&&d.messages.length){
        M.innerHTML='';
        d.messages.forEach(appendMsg);
        lastMsg=d.messages[d.messages.length-1].messageID;
        scrollB();
      }
    }).catch(function(){});
  }

  // ── Send message ──────────────────────────────────────
  window.wSend=function(){
    var txt=CI.value.trim();if(!txt)return;
    CI.value='';CI.style.height='38px';CSB.disabled=true;
    appendMsg({senderType:'user',content:txt,createdAt:new Date().toISOString()});
    IC.innerHTML='';scrollB();
    TY.classList.add('on');scrollB();
    fetch('index.php?controller=chat&action=send',{
      method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},
      body:'content='+encodeURIComponent(txt)
    }).then(r=>r.json()).then(function(d){
      TY.classList.remove('on');
      if(d.aiReply){
        appendMsg({senderType:'ai',content:d.aiReply.content,createdAt:new Date().toISOString()});
        lastMsg=Math.max(lastMsg,d.aiReply.messageID||0);
        if(!open){unread++;updBadge();}
      }
      if(d.cards&&d.cards.length)renderCards(d.cards);
      scrollB();
    }).catch(function(){TY.classList.remove('on');}).finally(function(){CSB.disabled=false;});
  };

  // ── Append message bubble ─────────────────────────────
  function appendMsg(m){
    var t=m.senderType,rc=t==='user'?'u':(t==='admin'?'ad':'ai'),
        av=t==='user'?'u':(t==='admin'?'d':'a'),
        ic=t==='user'?'👤':(t==='admin'?'🛡️':'🤖'),
        nm=t==='user'?'Bạn':(t==='admin'?'Admin':'Hệ thống'),
        tm=new Date(m.createdAt).toLocaleTimeString('vi-VN',{hour:'2-digit',minute:'2-digit'}),
        txt=esc(m.content).replace(/\n/g,'<br>');
    var d=document.createElement('div');
    d.className='mr '+rc;
    d.innerHTML='<div class="mav '+av+'">'+ic+'</div><div><div class="mb">'+txt+'</div><div class="mm">'+nm+' · '+tm+'</div></div>';
    M.appendChild(d);
  }

  // ── Render inline cards after AI reply ───────────────
  function renderCards(cards){
    IC.innerHTML='';
    cards.forEach(function(c){
      if(c.type==='tour'){
        var img=c.heroImage?'<img src="'+esc(c.heroImage)+'" onerror="this.src=\'/travel.bling/img/tour-placeholder.jpg\'">'
                           :'<div style="width:54px;height:54px;border-radius:8px;background:rgba(139,92,246,.2);display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0">🗺️</div>';
        var d=document.createElement('div');d.className='tc';
        d.innerHTML=img+'<div class="tc-info"><div class="tc-name">'+esc(c.title)+'</div>'
          +'<div class="tc-meta">📍'+esc(c.destination||'')+(c.duration?' · ⏱️'+esc(c.duration):'')+'</div>'
          +'<div class="tc-price">Từ '+fmtPrice(c.priceAdult)+'₫</div></div>'
          +'<button class="tc-btn" onclick="location.href=\'index.php?controller=booking&tourID='+c.tourID+'\'">Đặt ngay</button>';
        IC.appendChild(d);
      } else if(c.type==='booking'){
        var ps=c.paymentStatus||'',st=ps.toLowerCase()==='paid'?'paid':(ps.toLowerCase()==='unpaid'?'unpaid':'pending');
        var lbl=st==='paid'?'✅ Đã TT':(st==='unpaid'?'❌ Chưa TT':'⏳ Chờ');
        var d=document.createElement('div');d.className='bc';
        d.innerHTML='<div class="bc-head"><span class="bc-id">🎫 HD-'+pad(c.bookingID,6)+'</span><span class="bs '+st+'">'+lbl+'</span></div>'
          +'<div style="font-size:11px;color:rgba(196,181,253,.8)">📅 '+fmtDate(c.bookingDate)+' · 👥 '+c.numAdults+'NL'+(c.numChildren>0?' '+c.numChildren+'TE':'')+'</div>'
          +(c.title?'<div style="font-size:11px;color:#a78bfa;margin-top:2px">'+esc(c.title)+'</div>':'')
          +'<a class="bc-link" href="index.php?controller=booking&action=renue&bookingID='+c.bookingID+'">→ Xem hóa đơn</a>';
        IC.appendChild(d);
      } else if(c.type==='action'){
        var d=document.createElement('div');d.style.cssText='padding:6px 12px';
        d.innerHTML='<a href="'+esc(c.url||'#')+'" style="display:block;text-align:center;padding:9px;border-radius:10px;background:linear-gradient(135deg,#6b46a0,#8b5cf6);color:#fff;font-size:12px;font-weight:700;text-decoration:none">'+esc(c.label)+'</a>';
        IC.appendChild(d);
      }
    });
  }

  // ── Load tours by region ──────────────────────────────
  window.wLoadTours=function(btn){
    document.querySelectorAll('.rb').forEach(function(b){b.classList.remove('sel');});
    btn.classList.add('sel');
    var r=btn.dataset.r,tc=document.getElementById('tourCards');
    tc.innerHTML='<div class="ld">Đang tải...</div>';
    fetch('index.php?controller=chat&action=tourSuggest&region='+r).then(r=>r.json()).then(function(d){
      tc.innerHTML='';
      if(!d.tours||!d.tours.length){tc.innerHTML='<div class="ld">Không tìm thấy tour phù hợp.</div>';return;}
      d.tours.forEach(function(t){
        var img=t.heroImage?'<img src="'+esc(t.heroImage)+'" onerror="this.src=\'\'" style="width:50px;height:50px;border-radius:7px;object-fit:cover;flex-shrink:0">'
                           :'<div style="width:50px;height:50px;border-radius:7px;background:rgba(139,92,246,.2);display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0">🗺️</div>';
        var el=document.createElement('div');el.className='wtc';
        el.innerHTML=img+'<div class="wtc-i"><div class="wtc-n">'+esc(t.title)+'</div>'
          +'<div class="wtc-m">📍'+esc(t.destination||'')+(t.duration?' · ⏱️'+esc(t.duration):'')+'</div>'
          +'<div class="wtc-m" style="color:#a78bfa;font-weight:700">Từ '+fmtPrice(t.priceAdult)+'₫</div></div>'
          +'<button class="wtc-b" onclick="location.href=\'index.php?controller=booking&tourID='+t.tourID+'\'">Đặt ngay</button>';
        tc.appendChild(el);
      });
    }).catch(function(){tc.innerHTML='<div class="ld">Lỗi tải dữ liệu.</div>';});
  };

  // ── Load account info + bookings ──────────────────────
  function loadAccount(){
    acLoaded=true;
    var ai=document.getElementById('aiInfo'),bk=document.getElementById('bkList');
    Promise.all([
      fetch('index.php?controller=chat&action=accountInfo').then(r=>r.json()),
      fetch('index.php?controller=chat&action=myBookings').then(r=>r.json())
    ]).then(function(res){
      var acc=res[0],bks=res[1].bookings||[];
      ai.innerHTML='<div class="ai-grid">'
        +'<div class="ai-item"><div class="ai-label">Họ tên</div><div class="ai-val">'+esc(acc.name||'-')+'</div></div>'
        +'<div class="ai-item"><div class="ai-label">Email</div><div class="ai-val">'+esc(acc.email||'-')+'</div></div>'
        +'<div class="ai-item"><div class="ai-label">Điện thoại</div><div class="ai-val">'+esc(acc.phone||'-')+'</div></div>'
        +'<div class="ai-item"><div class="ai-label">Địa chỉ</div><div class="ai-val">'+esc(acc.address||'-')+'</div></div>'
        +'</div>';
      if(!bks.length){bk.innerHTML='<div class="ld">Chưa có booking nào.</div>';return;}
      bk.innerHTML='';
      bks.forEach(function(b){
        var ps=b.paymentStatus||'',st=ps.toLowerCase()==='paid'?'paid':(ps.toLowerCase()==='unpaid'?'unpaid':'pending');
        var lbl=st==='paid'?'✅ Đã TT':(st==='unpaid'?'❌ Chưa TT':'⏳ Chờ');
        var el=document.createElement('div');el.className='bc';el.style.margin='0 10px 7px';
        el.innerHTML='<div class="bc-head"><span class="bc-id">🎫 HD-'+pad(b.bookingID,6)+'</span><span class="bs '+st+'">'+lbl+'</span></div>'
          +'<div style="font-size:11px;color:rgba(196,181,253,.8)">📅 '+fmtDate(b.bookingDate)+' · 👥 '+b.numAdults+'NL</div>'
          +(b.title?'<div style="font-size:11px;color:#a78bfa;margin-top:2px">'+esc(b.title)+'</div>':'')
          +'<a class="bc-link" href="index.php?controller=booking&action=renue&bookingID='+b.bookingID+'">→ Xem hóa đơn</a>';
        bk.appendChild(el);
      });
    }).catch(function(){ai.innerHTML='<div class="ld">Lỗi tải.</div>';});
  }

  // ── Load promos / broadcasts ──────────────────────────
  function loadPromos(){
    prLoaded=true;
    var pl=document.getElementById('promoList');
    fetch('index.php?controller=chat&action=broadcasts').then(r=>r.json()).then(function(d){
      pl.innerHTML='';
      if(!d.broadcasts||!d.broadcasts.length){pl.innerHTML='<div class="ld">Chưa có ưu đãi nào.</div>';return;}
      d.broadcasts.forEach(function(b){appendBcast(b,pl);});
      lastBcast=d.broadcasts[d.broadcasts.length-1].broadcastID;
    }).catch(function(){pl.innerHTML='<div class="ld">Lỗi tải.</div>';});
  }

  function appendBcast(b,container){
    var tag=b.tag||'',cls=tag==='PROMO'?'promo':'bcast',lbl=tag==='PROMO'?'🔥 PROMO':'📢 Thông Báo';
    var fmt=b.formatted||b.rawMessage||'';
    // Extract coupon code (pattern: mã XXXXXX or CODE: XXXXXX)
    var couponMatch=fmt.match(/(?:mã|code[:\s])\s*([A-Z0-9]{4,12})/i);
    var couponHTML='';
    if(couponMatch){
      var code=couponMatch[1].toUpperCase();
      couponHTML='<div class="coupon"><span class="coupon-code">'+esc(code)+'</span>'
        +'<button class="coupon-copy" onclick="wCopy(\''+esc(code)+'\',this)">📋 Copy</button></div>';
    }
    var el=document.createElement('div');el.className='pc';
    el.innerHTML='<span class="pc-tag '+cls+'">'+lbl+'</span>'
      +'<div class="pc-text">'+esc(fmt).replace(/\n/g,'<br>')+'</div>'
      +couponHTML
      +'<div style="font-size:10px;color:rgba(196,181,253,.4);margin-top:6px">'+fmtDate(b.createdAt)+'</div>';
    container.appendChild(el);
  }

  // ── Poll for new messages/broadcasts (every 4s) ───────
  function poll(){
    fetch('index.php?controller=chat&action=poll&after_msg='+lastMsg+'&after_bcast='+lastBcast)
      .then(r=>r.json()).then(function(d){
        (d.messages||[]).forEach(function(m){
          if(m.senderType!=='user'){
            appendMsg(m);
            if(!open||tab!==0){unread++;updBadge();}
          }
          lastMsg=Math.max(lastMsg,m.messageID);
          if(open&&tab===0)scrollB();
        });
        (d.broadcasts||[]).forEach(function(b){
          var pl=document.getElementById('promoList');
          if(pl&&pl.querySelector('.ld'))pl.innerHTML='';
          if(pl)appendBcast(b,pl);
          lastBcast=Math.max(lastBcast,b.broadcastID);
          unreadP++;PBD.style.display='inline';
          if(!open||tab!==3){unread++;updBadge();}
        });
      }).catch(function(){});
    setTimeout(poll,4000);
  }

  // ── Helpers ───────────────────────────────────────────
  function updBadge(){CB.textContent=unread>9?'9+':unread;CB.classList.toggle('on',unread>0);}
  function scrollB(){M.scrollTop=M.scrollHeight;}
  function esc(s){return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');}
  function fmtPrice(n){return Number(n||0).toLocaleString('vi-VN');}
  function fmtDate(s){if(!s)return'—';var d=new Date(s);return d.toLocaleDateString('vi-VN');}
  function pad(n,l){return String(n).padStart(l,'0');}

  window.wFill=function(t){CI.value=t;CI.focus();};
  window.wCopy=function(code,btn){navigator.clipboard.writeText(code).then(function(){btn.textContent='✅ Đã copy';setTimeout(function(){btn.textContent='📋 Copy';},2000);});};

  CI.addEventListener('input',function(){CI.style.height='auto';CI.style.height=Math.min(CI.scrollHeight,80)+'px';});
  CI.addEventListener('keydown',function(e){if(e.key==='Enter'&&!e.shiftKey){e.preventDefault();wSend();}});

  setTimeout(poll,3000);
})();
