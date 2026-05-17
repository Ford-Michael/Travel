<?php if (!isset($_SESSION['user_id'])) return; ?>
<style>
#cf{position:fixed;bottom:28px;right:28px;z-index:9999;width:60px;height:60px;border-radius:50%;background:linear-gradient(135deg,#6b46a0,#8b5cf6);box-shadow:0 8px 32px rgba(107,70,160,.5);border:none;cursor:pointer;color:#fff;display:flex;align-items:center;justify-content:center;transition:all .3s cubic-bezier(.34,1.56,.64,1)}
#cf:hover{transform:scale(1.12)}
#cb{position:absolute;top:-4px;right:-4px;background:#ef4444;color:#fff;font-size:10px;font-weight:800;width:20px;height:20px;border-radius:50%;display:none;align-items:center;justify-content:center;border:2px solid #fff}
#cb.on{display:flex}
#cp{position:fixed;bottom:100px;right:28px;z-index:9998;width:390px;height:580px;background:linear-gradient(180deg,#1a1035,#110e24);border:1px solid rgba(139,92,246,.3);border-radius:20px;box-shadow:0 20px 60px rgba(0,0,0,.5);display:flex;flex-direction:column;overflow:hidden;transform:scale(.85) translateY(20px);transform-origin:bottom right;opacity:0;pointer-events:none;transition:all .25s cubic-bezier(.34,1.2,.64,1);font-family:'Be Vietnam Pro',sans-serif}
#cp.open{transform:scale(1) translateY(0);opacity:1;pointer-events:all}
.cph{padding:14px 16px;background:linear-gradient(135deg,#6b46a0,#8b5cf6);display:flex;align-items:center;gap:10px;flex-shrink:0}
.cpha{width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;font-size:18px}
.cphi{flex:1}.cphi h3{margin:0;font-size:14px;font-weight:800;color:#fff}.cphi p{margin:0;font-size:11px;color:rgba(255,255,255,.75)}
.cphx{width:30px;height:30px;border-radius:50%;background:rgba(255,255,255,.15);border:none;cursor:pointer;color:#fff;font-size:15px;display:flex;align-items:center;justify-content:center}
.cphx:hover{background:rgba(255,255,255,.3)}
.cptabs{display:flex;background:rgba(0,0,0,.3);flex-shrink:0;border-bottom:1px solid rgba(139,92,246,.15)}
.cpt{flex:1;padding:8px 2px;text-align:center;font-size:11px;font-weight:700;color:rgba(196,181,253,.5);cursor:pointer;border-bottom:2px solid transparent;transition:all .2s}
.cpt.on{color:#c4b5fd;border-bottom-color:#8b5cf6}
.cpb{flex:1;overflow:hidden;position:relative}
.cpp{position:absolute;inset:0;overflow-y:auto;display:none;flex-direction:column}
.cpp.on{display:flex}
.cpp::-webkit-scrollbar{width:3px}
.cpp::-webkit-scrollbar-thumb{background:rgba(139,92,246,.4);border-radius:3px}
.msgs{flex:1;padding:12px;display:flex;flex-direction:column;gap:10px}
.mr{display:flex;gap:8px;animation:mf .25s ease}
.mr.u{flex-direction:row-reverse}
.mav{width:28px;height:28px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:14px}
.mav.a{background:linear-gradient(135deg,#6b46a0,#8b5cf6)}
.mav.u{background:linear-gradient(135deg,#0ea5e9,#6366f1)}
.mav.d{background:linear-gradient(135deg,#dc2626,#ef4444)}
.mb{max-width:78%;padding:9px 13px;border-radius:14px;font-size:12.5px;line-height:1.55;word-break:break-word;white-space:pre-wrap}
.mr.u .mb{background:linear-gradient(135deg,#6b46a0,#8b5cf6);color:#fff;border-bottom-right-radius:4px}
.mr.ai .mb{background:rgba(139,92,246,.12);border:1px solid rgba(139,92,246,.22);color:#e2e8f0;border-bottom-left-radius:4px}
.mr.ad .mb{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.22);color:#fca5a5;border-bottom-left-radius:4px}
.mm{font-size:10px;color:rgba(148,163,184,.5);margin-top:3px}
.mr.u .mm{text-align:right}
.ty{display:none;align-items:center;gap:6px;padding:0 12px 6px}
.ty.on{display:flex}
.td{width:5px;height:5px;border-radius:50%;background:#8b5cf6;animation:tb 1.2s ease-in-out infinite}
.td:nth-child(2){animation-delay:.2s}.td:nth-child(3){animation-delay:.4s}
/* Tour cards */
.tc{display:flex;gap:10px;align-items:center;background:rgba(139,92,246,.08);border:1px solid rgba(139,92,246,.2);border-radius:10px;padding:10px;margin:0 12px 6px;animation:mf .3s ease}
.tc img{width:54px;height:54px;border-radius:8px;object-fit:cover;flex-shrink:0}
.tc-info{flex:1;min-width:0}.tc-name{font-size:12px;font-weight:700;color:#e2e8f0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.tc-meta{font-size:10.5px;color:rgba(196,181,253,.7);margin-top:2px}
.tc-price{font-size:11px;font-weight:700;color:#a78bfa;margin-top:2px}
.tc-btn{padding:4px 10px;border-radius:8px;background:linear-gradient(135deg,#6b46a0,#8b5cf6);border:none;color:#fff;font-size:11px;font-weight:700;cursor:pointer;white-space:nowrap;flex-shrink:0}
/* Booking cards */
.bc{background:rgba(139,92,246,.07);border:1px solid rgba(139,92,246,.18);border-radius:10px;padding:10px 12px;margin:0 12px 6px;font-size:12px;color:#c4b5fd;animation:mf .3s ease}
.bc-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:4px}
.bc-id{font-weight:800;color:#e2e8f0}
.bs{padding:2px 7px;border-radius:8px;font-size:10px;font-weight:700}
.bs.paid{background:rgba(34,197,94,.2);color:#4ade80}
.bs.unpaid{background:rgba(239,68,68,.2);color:#fca5a5}
.bs.pending{background:rgba(245,158,11,.2);color:#fbbf24}
.bc-link{font-size:11px;color:#8b5cf6;text-decoration:none;margin-top:4px;display:inline-block}
/* Region grid */
.rg{display:grid;grid-template-columns:repeat(4,1fr);gap:7px;padding:12px}
.rb{padding:8px 4px;border-radius:10px;background:rgba(139,92,246,.08);border:1px solid rgba(139,92,246,.2);color:#a78bfa;font-size:11px;font-weight:700;cursor:pointer;text-align:center;transition:all .2s}
.rb:hover{background:rgba(139,92,246,.25);color:#fff}
.rb.sel{background:linear-gradient(135deg,#6b46a0,#8b5cf6);color:#fff;border-color:transparent}
#tourCards{padding:0 12px 12px;display:flex;flex-direction:column;gap:8px}
.wtc{display:flex;gap:9px;align-items:center;background:rgba(139,92,246,.08);border:1px solid rgba(139,92,246,.2);border-radius:10px;padding:9px}
.wtc img{width:50px;height:50px;border-radius:7px;object-fit:cover;flex-shrink:0}
.wtc-i{flex:1;min-width:0}
.wtc-n{font-size:12px;font-weight:700;color:#e2e8f0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.wtc-m{font-size:10px;color:rgba(196,181,253,.7);margin-top:2px}
.wtc-b{padding:4px 9px;border-radius:7px;background:linear-gradient(135deg,#6b46a0,#8b5cf6);border:none;color:#fff;font-size:11px;font-weight:700;cursor:pointer;flex-shrink:0}
/* Account tab */
.ai-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;padding:12px}
.ai-item{background:rgba(139,92,246,.08);border:1px solid rgba(139,92,246,.18);border-radius:9px;padding:10px}
.ai-label{font-size:10px;color:rgba(196,181,253,.6);text-transform:uppercase;letter-spacing:.05em}
.ai-val{font-size:13px;font-weight:700;color:#e2e8f0;margin-top:3px;word-break:break-all}
.sec-title{padding:4px 12px 6px;font-size:11px;font-weight:800;color:rgba(196,181,253,.6);text-transform:uppercase;letter-spacing:.08em}
/* Promo tab */
.pc{background:rgba(139,92,246,.07);border:1px solid rgba(139,92,246,.18);border-radius:10px;padding:11px 12px;margin:8px 10px;animation:mf .3s ease}
.pc-tag{display:inline-block;font-size:9px;font-weight:800;text-transform:uppercase;padding:2px 7px;border-radius:20px;margin-bottom:6px}
.pc-tag.promo{background:linear-gradient(135deg,#f59e0b,#ef4444);color:#fff}
.pc-tag.bcast{background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff}
.pc-text{font-size:11.5px;color:#c4b5fd;line-height:1.55;white-space:pre-wrap}
.coupon{display:flex;align-items:center;gap:7px;margin-top:8px;background:rgba(245,158,11,.1);border:1px dashed rgba(245,158,11,.4);border-radius:8px;padding:7px 10px}
.coupon-code{font-size:14px;font-weight:800;color:#fbbf24;letter-spacing:.1em;flex:1}
.coupon-copy{padding:3px 9px;border-radius:6px;background:rgba(245,158,11,.3);border:none;color:#fbbf24;font-size:11px;font-weight:700;cursor:pointer}
/* Input */
.cia{padding:9px 11px;border-top:1px solid rgba(139,92,246,.15);flex-shrink:0;background:rgba(0,0,0,.2)}
.ciq{display:flex;gap:5px;flex-wrap:wrap;margin-bottom:7px}
.ciqb{padding:4px 9px;border-radius:13px;font-size:11px;font-weight:600;border:1px solid rgba(139,92,246,.3);background:rgba(139,92,246,.07);color:#a78bfa;cursor:pointer;transition:all .18s}
.ciqb:hover{background:rgba(139,92,246,.2);color:#fff}
.cir{display:flex;gap:7px;align-items:flex-end}
.cita{flex:1;background:rgba(139,92,246,.1);border:1px solid rgba(139,92,246,.3);border-radius:11px;padding:8px 12px;color:#f1f5f9;font-size:13px;resize:none;font-family:inherit;outline:none;transition:border-color .2s;max-height:80px;min-height:38px}
.cita:focus{border-color:#8b5cf6}
.cisb{width:38px;height:38px;border-radius:11px;flex-shrink:0;background:linear-gradient(135deg,#6b46a0,#8b5cf6);border:none;cursor:pointer;color:#fff;font-size:18px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(107,70,160,.4)}
.cisb:disabled{opacity:.5;pointer-events:none}
@keyframes mf{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:translateY(0)}}
@keyframes tb{0%,60%,100%{transform:translateY(0)}30%{transform:translateY(-5px)}}
.ld{text-align:center;padding:20px;color:rgba(148,163,184,.4);font-size:12px}
</style>

<button id="cf" onclick="wToggle()" title="Chat hỗ trợ">
  <span id="cfi" class="material-symbols-outlined" style="font-size:26px">chat</span>
  <span id="cb" class="fab-badge"></span>
</button>

<div id="cp">
  <div class="cph">
    <div class="cpha">🤖</div>
    <div class="cphi"><h3>Trợ lý Travel Bling</h3><p><span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:#22c55e;box-shadow:0 0 5px #22c55e;margin-right:4px"></span>Sẵn sàng hỗ trợ</p></div>
    <button class="cphx" onclick="wToggle()">✕</button>
  </div>

  <div class="cptabs">
    <div class="cpt on" id="t0" onclick="wTab(0)">💬 Chat</div>
    <div class="cpt" id="t1" onclick="wTab(1)">✈️ Tour</div>
    <div class="cpt" id="t2" onclick="wTab(2)">👤 Tôi</div>
    <div class="cpt" id="t3" onclick="wTab(3)">📢 Ưu đãi<span id="pbdg" style="display:none;background:#ef4444;color:#fff;font-size:9px;padding:1px 4px;border-radius:6px;margin-left:2px">!</span></div>
  </div>

  <div class="cpb">
    <!-- Chat pane -->
    <div class="cpp on" id="p0" style="flex-direction:column">
      <div class="msgs" id="msgs">
        <div class="mr ai"><div class="mav a">🤖</div><div><div class="mb">Xin chào! 👋 Hỏi mình về tour, đặt lịch, hay nhờ soạn thảo nhé!</div></div></div>
      </div>
      <div class="ty" id="ty"><div class="mav a" style="width:24px;height:24px;font-size:12px">🤖</div><div style="display:flex;gap:3px"><div class="td"></div><div class="td"></div><div class="td"></div></div></div>
      <div id="inlineCards"></div>
    </div>

    <!-- Tour pane -->
    <div class="cpp" id="p1">
      <div class="rg">
        <div class="rb" data-r="north" onclick="wLoadTours(this)">🏔️<br>Miền Bắc</div>
        <div class="rb" data-r="central" onclick="wLoadTours(this)">🏖️<br>Miền Trung</div>
        <div class="rb" data-r="south" onclick="wLoadTours(this)">🌆<br>Miền Nam</div>
        <div class="rb" data-r="mekong" onclick="wLoadTours(this)">🌊<br>Miền Tây</div>
        <div class="rb" data-r="islands" onclick="wLoadTours(this)">🏝️<br>Hải Đảo</div>
        <div class="rb" data-r="asia" onclick="wLoadTours(this)">🗼<br>Châu Á</div>
        <div class="rb" data-r="europe" onclick="wLoadTours(this)">🏰<br>Châu Âu</div>
        <div class="rb" data-r="america" onclick="wLoadTours(this)">🗽<br>Châu Mỹ</div>
      </div>
      <div id="tourCards"><div class="ld">Chọn miền để xem tour gợi ý ✈️</div></div>
    </div>

    <!-- Account pane -->
    <div class="cpp" id="p2">
      <div id="aiInfo"><div class="ld">Đang tải thông tin...</div></div>
      <div class="sec-title" style="margin-top:4px">📋 Booking gần đây</div>
      <div id="bkList"><div class="ld">Đang tải...</div></div>
      <div style="padding:8px 12px 12px">
        <a href="index.php?controller=account" style="display:block;text-align:center;padding:9px;border-radius:10px;background:linear-gradient(135deg,#6b46a0,#8b5cf6);color:#fff;font-size:12px;font-weight:700;text-decoration:none">→ Trang tài khoản đầy đủ</a>
      </div>
    </div>

    <!-- Promos pane -->
    <div class="cpp" id="p3">
      <div id="promoList"><div class="ld">Đang tải ưu đãi...</div></div>
    </div>
  </div>

  <!-- Input (chat tab only) -->
  <div class="cia" id="cia">
    <div class="ciq">
      <span class="ciqb" onclick="wFill('Tour miền Bắc có gì?')">🏔️ Miền Bắc</span>
      <span class="ciqb" onclick="wFill('Gợi ý tour gia đình 4 người')">👨‍👩‍👧 Gia đình</span>
      <span class="ciqb" onclick="wFill('Xem thông tin tài khoản của tôi')">👤 Tài khoản</span>
      <span class="ciqb" onclick="wFill('Các booking tôi đã đặt')">🎫 Booking</span>
    </div>
    <div class="cir">
      <textarea id="ci" class="cita" placeholder="Nhắn tin... (Enter gửi)" rows="1"></textarea>
      <button class="cisb" id="csb" onclick="wSend()"><span class="material-symbols-outlined" style="font-size:18px">send</span></button>
    </div>
  </div>
</div>

<script src="/travel.bling/user/views/chat/widget-logic.js"></script>
