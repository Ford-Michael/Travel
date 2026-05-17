<?php
/**
 * User Chat Interface — Travel Bling
 * Variables: $account, $sessionID, $messages, $broadcasts, $session
 */
$isAdminTakeover = !empty($session['adminTookover']);
$lastMsgID = !empty($messages) ? (int) end($messages)['messageID'] : 0;
$lastBcastID = !empty($broadcasts) ? (int) end($broadcasts)['broadcastID'] : 0;
?>

<style>
/* ── Chat Page Styles ── */
.chat-root { display: flex; height: calc(100vh - 72px); overflow: hidden; background: #0f0a1e; }

/* Sidebar: Broadcasts */
.chat-sidebar {
    width: 320px; flex-shrink: 0;
    background: linear-gradient(180deg, #1a1035 0%, #150d2e 100%);
    border-right: 1px solid rgba(139,92,246,0.2);
    display: flex; flex-direction: column; overflow: hidden;
}
.sidebar-header {
    padding: 20px;
    background: linear-gradient(135deg, #6b46a0, #8b5cf6);
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.sidebar-header h2 { font-size: 14px; font-weight: 800; color: #fff; margin: 0 0 4px; text-transform: uppercase; letter-spacing: 0.1em; }
.sidebar-header p  { font-size: 11px; color: rgba(255,255,255,0.7); margin: 0; }

.broadcasts-list { flex: 1; overflow-y: auto; padding: 12px; display: flex; flex-direction: column; gap: 10px; }
.broadcasts-list::-webkit-scrollbar { width: 4px; }
.broadcasts-list::-webkit-scrollbar-thumb { background: rgba(139,92,246,0.4); border-radius: 4px; }

.broadcast-card {
    background: rgba(139,92,246,0.08);
    border: 1px solid rgba(139,92,246,0.2);
    border-radius: 12px; padding: 14px;
    animation: fadeSlideIn 0.4s ease;
}
.broadcast-card .bcast-tag {
    display: inline-block; font-size: 10px; font-weight: 700; text-transform: uppercase;
    padding: 2px 8px; border-radius: 20px; margin-bottom: 8px;
}
.bcast-tag.promo { background: linear-gradient(135deg, #f59e0b, #ef4444); color: #fff; }
.bcast-tag.broadcast { background: linear-gradient(135deg, #3b82f6, #6366f1); color: #fff; }
.bcast-tag.info { background: rgba(139,92,246,0.3); color: #a78bfa; }

.broadcast-card .bcast-text {
    font-size: 12px; color: #c4b5fd; line-height: 1.6;
    white-space: pre-wrap; word-break: break-word;
}
.broadcast-card .bcast-time { font-size: 10px; color: rgba(196,181,253,0.5); margin-top: 8px; }

/* Main chat area */
.chat-main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }

.chat-topbar {
    padding: 16px 24px;
    background: rgba(26,16,53,0.95);
    border-bottom: 1px solid rgba(139,92,246,0.15);
    display: flex; align-items: center; gap: 12px;
    backdrop-filter: blur(10px);
}
.chat-avatar {
    width: 40px; height: 40px; border-radius: 50%;
    background: linear-gradient(135deg, #6b46a0, #8b5cf6);
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; flex-shrink: 0;
}
.chat-topbar-info h3 { font-size: 15px; font-weight: 700; color: #fff; margin: 0; }
.chat-topbar-info p  { font-size: 11px; color: #a78bfa; margin: 0; }
.status-dot { width: 8px; height: 8px; border-radius: 50%; background: #22c55e; display: inline-block; margin-right: 6px; box-shadow: 0 0 8px #22c55e; animation: pulse-dot 2s ease-in-out infinite; }

/* Messages */
.chat-messages { flex: 1; overflow-y: auto; padding: 24px; display: flex; flex-direction: column; gap: 16px; }
.chat-messages::-webkit-scrollbar { width: 4px; }
.chat-messages::-webkit-scrollbar-thumb { background: rgba(139,92,246,0.3); border-radius: 4px; }

.msg-row { display: flex; gap: 10px; animation: fadeSlideIn 0.3s ease; }
.msg-row.from-user  { flex-direction: row-reverse; }
.msg-row.from-ai    { flex-direction: row; }
.msg-row.from-admin { flex-direction: row; }

.msg-avatar {
    width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center; font-size: 16px;
}
.msg-avatar.ai-av    { background: linear-gradient(135deg, #6b46a0, #8b5cf6); }
.msg-avatar.user-av  { background: linear-gradient(135deg, #0ea5e9, #6366f1); }
.msg-avatar.admin-av { background: linear-gradient(135deg, #ef4444, #f59e0b); }

.msg-bubble {
    max-width: 75%; padding: 12px 16px; border-radius: 18px; font-size: 14px; line-height: 1.6;
    word-break: break-word; white-space: pre-wrap;
}
.from-user .msg-bubble  { background: linear-gradient(135deg, #6b46a0, #8b5cf6); color: #fff; border-bottom-right-radius: 4px; }
.from-ai   .msg-bubble  { background: rgba(139,92,246,0.12); border: 1px solid rgba(139,92,246,0.25); color: #e2e8f0; border-bottom-left-radius: 4px; }
.from-admin .msg-bubble { background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.25); color: #fca5a5; border-bottom-left-radius: 4px; }

.msg-meta { font-size: 10px; color: rgba(148,163,184,0.6); margin-top: 4px; }
.from-user .msg-meta { text-align: right; }

/* Takeover banner */
.takeover-banner {
    margin: 0 24px 12px;
    background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.3);
    border-radius: 10px; padding: 10px 16px; font-size: 12px; color: #fca5a5;
    display: flex; align-items: center; gap: 8px;
}

/* Input */
.chat-input-area {
    padding: 16px 24px;
    background: rgba(26,16,53,0.95);
    border-top: 1px solid rgba(139,92,246,0.15);
    backdrop-filter: blur(10px);
}
.chat-input-row { display: flex; gap: 10px; align-items: flex-end; }
.chat-textarea {
    flex: 1; background: rgba(139,92,246,0.08); border: 1px solid rgba(139,92,246,0.3);
    border-radius: 14px; padding: 12px 16px; color: #f1f5f9; font-size: 14px;
    resize: none; font-family: 'Be Vietnam Pro', sans-serif; outline: none; transition: border-color 0.2s;
    max-height: 120px; min-height: 48px;
}
.chat-textarea:focus { border-color: #8b5cf6; }
.chat-textarea::placeholder { color: rgba(148,163,184,0.5); }
.send-btn {
    width: 48px; height: 48px; border-radius: 14px; flex-shrink: 0;
    background: linear-gradient(135deg, #6b46a0, #8b5cf6);
    border: none; cursor: pointer; color: #fff; font-size: 20px;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.2s; box-shadow: 0 4px 12px rgba(107,70,160,0.4);
}
.send-btn:hover { transform: scale(1.05); box-shadow: 0 6px 20px rgba(107,70,160,0.5); }
.send-btn:active { transform: scale(0.95); }
.send-btn.loading { opacity: 0.6; pointer-events: none; }

/* Typing indicator */
.typing-indicator { display: none; align-items: center; gap: 8px; padding: 0 24px 8px; }
.typing-indicator .ti-dots { display: flex; gap: 4px; }
.typing-indicator .ti-dot {
    width: 6px; height: 6px; border-radius: 50%; background: #8b5cf6;
    animation: typingBounce 1.2s ease-in-out infinite;
}
.ti-dot:nth-child(2) { animation-delay: 0.2s; }
.ti-dot:nth-child(3) { animation-delay: 0.4s; }
.typing-indicator.active { display: flex; }

/* Quick prompts */
.quick-prompts { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 10px; }
.quick-btn {
    padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600;
    border: 1px solid rgba(139,92,246,0.3); background: rgba(139,92,246,0.08);
    color: #a78bfa; cursor: pointer; transition: all 0.2s;
}
.quick-btn:hover { background: rgba(139,92,246,0.2); border-color: #8b5cf6; color: #fff; }

@keyframes fadeSlideIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
@keyframes pulse-dot { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }
@keyframes typingBounce { 0%, 60%, 100% { transform: translateY(0); } 30% { transform: translateY(-6px); } }
</style>

<div class="chat-root">
    <!-- ═══ SIDEBAR: Broadcasts ═══ -->
    <aside class="chat-sidebar">
        <div class="sidebar-header">
            <h2>📢 Kênh Thông Báo</h2>
            <p>Tin tức & ưu đãi từ Travel Bling</p>
        </div>
        <div class="broadcasts-list" id="broadcastsList">
            <?php if (empty($broadcasts)): ?>
                <p style="color: rgba(196,181,253,0.4); font-size: 12px; text-align: center; padding: 20px;">Chưa có thông báo nào.</p>
            <?php else: ?>
                <?php foreach ($broadcasts as $b): 
                    $bTag = $b['tag'] ?? '';
                    $tagClass = ($bTag === 'PROMO') ? 'promo' : (($bTag === 'ADMIN_BROADCAST') ? 'broadcast' : 'info');
                    $tagLabel = ($bTag === 'PROMO') ? '🔥 PROMO' : (($bTag === 'ADMIN_BROADCAST') ? '📢 Thông Báo' : '📌 Tin tức');
                ?>
                <div class="broadcast-card">
                    <span class="bcast-tag <?php echo $tagClass; ?>"><?php echo $tagLabel; ?></span>
                    <div class="bcast-text"><?php echo nl2br(htmlspecialchars($b['formatted'])); ?></div>
                    <div class="bcast-time"><?php echo date('d/m/Y H:i', strtotime($b['createdAt'])); ?></div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </aside>

    <!-- ═══ MAIN CHAT ═══ -->
    <div class="chat-main">
        <!-- Topbar -->
        <div class="chat-topbar">
            <div class="chat-avatar">🤖</div>
            <div class="chat-topbar-info">
                <h3>Trợ lý Travel Bling</h3>
                <p><span class="status-dot"></span>Đang hoạt động — Sẵn sàng hỗ trợ bạn</p>
            </div>
        </div>

        <?php if ($isAdminTakeover): ?>
        <div class="takeover-banner">
            <span>🔴</span>
            <span>Admin đang hỗ trợ trực tiếp trong phiên này. Phản hồi tự động tạm thời bị tắt.</span>
        </div>
        <?php endif; ?>

        <!-- Messages -->
        <div class="chat-messages" id="chatMessages">
            <!-- Welcome message -->
            <div class="msg-row from-ai">
                <div class="msg-avatar ai-av">🤖</div>
                <div>
                    <div class="msg-bubble">Xin chào bạn! 👋 Hệ thống Travel Bling sẵn sàng hỗ trợ. Bạn có thể nhờ hệ thống soạn tin nhắn, tạo prompt AI, hoặc hỏi về các tour du lịch nhé!</div>
                    <div class="msg-meta">Hệ thống • Vừa xong</div>
                </div>
            </div>

            <?php foreach ($messages as $msg): 
                $type = $msg['senderType'];
                $rowClass = $type === 'user' ? 'from-user' : ($type === 'admin' ? 'from-admin' : 'from-ai');
                $avatarClass = $type === 'user' ? 'user-av' : ($type === 'admin' ? 'admin-av' : 'ai-av');
                $avatarIcon = $type === 'user' ? '👤' : ($type === 'admin' ? '🛡️' : '🤖');
                $senderName = $type === 'user' ? 'Bạn' : ($type === 'admin' ? 'Admin' : 'Hệ thống');
            ?>
            <div class="msg-row <?php echo $rowClass; ?>">
                <div class="msg-avatar <?php echo $avatarClass; ?>"><?php echo $avatarIcon; ?></div>
                <div>
                    <div class="msg-bubble"><?php echo nl2br(htmlspecialchars($msg['content'])); ?></div>
                    <div class="msg-meta"><?php echo $senderName; ?> • <?php echo date('H:i', strtotime($msg['createdAt'])); ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Typing indicator -->
        <div class="typing-indicator" id="typingIndicator">
            <div class="msg-avatar ai-av" style="width:28px;height:28px;font-size:14px;">🤖</div>
            <div class="ti-dots">
                <div class="ti-dot"></div>
                <div class="ti-dot"></div>
                <div class="ti-dot"></div>
            </div>
        </div>

        <!-- Input -->
        <div class="chat-input-area">
            <div class="quick-prompts">
                <button class="quick-btn" onclick="fillPrompt('Viết giúp tôi prompt Midjourney tạo ảnh')">🎨 Prompt ảnh AI</button>
                <button class="quick-btn" onclick="fillPrompt('Viết tin nhắn xin nghỉ phép sếp')">📝 Xin nghỉ phép</button>
                <button class="quick-btn" onclick="fillPrompt('Tour nào phù hợp cho gia đình 4 người?')">✈️ Tư vấn tour</button>
                <button class="quick-btn" onclick="fillPrompt('Viết tin nhắn tỏ tình lãng mạn')">💕 Tỏ tình</button>
            </div>
            <div class="chat-input-row">
                <textarea
                    id="chatInput"
                    class="chat-textarea"
                    placeholder="Nhắn tin cho hệ thống... (Enter để gửi, Shift+Enter xuống dòng)"
                    rows="1"
                ></textarea>
                <button class="send-btn" id="sendBtn" onclick="sendMessage()" title="Gửi">
                    <span class="material-symbols-outlined" style="font-size:22px;">send</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    const sessionID   = <?php echo json_encode($sessionID); ?>;
    let lastMsgID     = <?php echo $lastMsgID; ?>;
    let lastBcastID   = <?php echo $lastBcastID; ?>;
    let polling       = true;

    const messagesEl  = document.getElementById('chatMessages');
    const inputEl     = document.getElementById('chatInput');
    const sendBtnEl   = document.getElementById('sendBtn');
    const typingEl    = document.getElementById('typingIndicator');
    const bcastListEl = document.getElementById('broadcastsList');

    // ── Auto-resize textarea ──────────────────────────────
    inputEl.addEventListener('input', () => {
        inputEl.style.height = 'auto';
        inputEl.style.height = Math.min(inputEl.scrollHeight, 120) + 'px';
    });

    // ── Enter to send ──────────────────────────────────────
    inputEl.addEventListener('keydown', e => {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
    });

    // ── Send message ──────────────────────────────────────
    window.sendMessage = async function() {
        const content = inputEl.value.trim();
        if (!content) return;

        inputEl.value = '';
        inputEl.style.height = '48px';
        sendBtnEl.classList.add('loading');

        // Optimistic: append user bubble immediately
        appendMessage({ senderType: 'user', content, createdAt: new Date().toISOString(), messageID: 0 });
        scrollBottom();

        // Show typing indicator
        typingEl.classList.add('active');
        scrollBottom();

        try {
            const res  = await fetch('index.php?controller=chat&action=send', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'content=' + encodeURIComponent(content)
            });
            const data = await res.json();
            typingEl.classList.remove('active');

            if (data.aiReply) {
                appendMessage({ senderType: 'ai', content: data.aiReply.content, createdAt: new Date().toISOString(), messageID: data.aiReply.messageID });
                lastMsgID = Math.max(lastMsgID, data.aiReply.messageID);
                scrollBottom();
            }
            if (data.messageID > lastMsgID) lastMsgID = data.messageID;
        } catch(err) {
            typingEl.classList.remove('active');
            appendMessage({ senderType: 'ai', content: '⚠️ Đã xảy ra lỗi kết nối. Vui lòng thử lại.', createdAt: new Date().toISOString(), messageID: 0 });
        } finally {
            sendBtnEl.classList.remove('loading');
        }
    };

    // ── Append a message bubble ────────────────────────────
    function appendMessage(msg) {
        const type = msg.senderType;
        const rowClass    = type === 'user' ? 'from-user' : (type === 'admin' ? 'from-admin' : 'from-ai');
        const avatarClass = type === 'user' ? 'user-av' : (type === 'admin' ? 'admin-av' : 'ai-av');
        const icon        = type === 'user' ? '👤' : (type === 'admin' ? '🛡️' : '🤖');
        const name        = type === 'user' ? 'Bạn' : (type === 'admin' ? 'Admin' : 'Hệ thống');
        const time        = new Date(msg.createdAt).toLocaleTimeString('vi-VN', {hour:'2-digit',minute:'2-digit'});
        const text        = escHtml(msg.content).replace(/\n/g, '<br>');

        const div = document.createElement('div');
        div.className = 'msg-row ' + rowClass;
        div.innerHTML = `
            <div class="msg-avatar ${avatarClass}">${icon}</div>
            <div>
                <div class="msg-bubble">${text}</div>
                <div class="msg-meta">${name} • ${time}</div>
            </div>`;
        messagesEl.appendChild(div);
    }

    // ── Append broadcast card ──────────────────────────────
    function appendBroadcast(b) {
        const tag   = b.tag || '';
        const cls   = tag === 'PROMO' ? 'promo' : (tag === 'ADMIN_BROADCAST' ? 'broadcast' : 'info');
        const label = tag === 'PROMO' ? '🔥 PROMO' : (tag === 'ADMIN_BROADCAST' ? '📢 Thông Báo' : '📌 Tin tức');
        const time  = new Date(b.createdAt).toLocaleDateString('vi-VN') + ' ' + new Date(b.createdAt).toLocaleTimeString('vi-VN',{hour:'2-digit',minute:'2-digit'});

        // Remove empty placeholder
        const ph = bcastListEl.querySelector('p');
        if (ph) ph.remove();

        const card = document.createElement('div');
        card.className = 'broadcast-card';
        card.innerHTML = `
            <span class="bcast-tag ${cls}">${label}</span>
            <div class="bcast-text">${escHtml(b.formatted).replace(/\n/g,'<br>')}</div>
            <div class="bcast-time">${time}</div>`;
        bcastListEl.appendChild(card);
        bcastListEl.scrollTop = bcastListEl.scrollHeight;

        // Also announce in main chat
        appendMessage({ senderType: 'ai', content: '📢 Có thông báo mới từ Travel Bling:\n\n' + b.formatted, createdAt: b.createdAt, messageID: 0 });
        scrollBottom();
    }

    // ── Long polling ──────────────────────────────────────
    async function poll() {
        if (!polling) return;
        try {
            const res  = await fetch(`index.php?controller=chat&action=poll&after_msg=${lastMsgID}&after_bcast=${lastBcastID}`);
            const data = await res.json();

            data.messages?.forEach(m => {
                if (m.senderType !== 'user') {
                    appendMessage(m);
                    scrollBottom();
                }
                lastMsgID = Math.max(lastMsgID, m.messageID);
            });

            data.broadcasts?.forEach(b => {
                appendBroadcast(b);
                lastBcastID = Math.max(lastBcastID, b.broadcastID);
            });
        } catch(_) {}
        setTimeout(poll, 3000);
    }

    poll();

    // ── Helpers ───────────────────────────────────────────
    function scrollBottom() { messagesEl.scrollTop = messagesEl.scrollHeight; }
    function escHtml(s) { return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }

    window.fillPrompt = function(text) { inputEl.value = text; inputEl.focus(); };

    // Scroll to bottom on load
    scrollBottom();
})();
</script>
