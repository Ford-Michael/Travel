<?php
/**
 * Admin Chat Dashboard
 * Variables: $account, $sessions, $broadcasts, $viewUserID, $viewSession, $viewMessages
 */
$lastBcastID = !empty($broadcasts) ? (int) end($broadcasts)['broadcastID'] : 0;
$lastViewMsg = !empty($viewMessages) ? (int) end($viewMessages)['messageID'] : 0;
?>

<style>
/* ── Admin Chat Dashboard ── */
.admin-chat-root { display: flex; height: calc(100vh - 72px); overflow: hidden; background: #0a0818; font-family: 'Be Vietnam Pro', sans-serif; }

/* Left panel: session list */
.admin-sessions {
    width: 280px; flex-shrink: 0;
    background: linear-gradient(180deg, #110e24 0%, #0d0b1e 100%);
    border-right: 1px solid rgba(239,68,68,0.15);
    display: flex; flex-direction: column; overflow: hidden;
}
.admin-sessions-header { padding: 18px; background: linear-gradient(135deg, #dc2626, #ef4444); }
.admin-sessions-header h2 { font-size: 13px; font-weight: 800; color: #fff; margin: 0 0 2px; text-transform: uppercase; letter-spacing: 0.1em; }
.admin-sessions-header p  { font-size: 11px; color: rgba(255,255,255,0.7); margin: 0; }
.session-list { flex: 1; overflow-y: auto; }
.session-item {
    padding: 14px 18px; border-bottom: 1px solid rgba(239,68,68,0.08); cursor: pointer;
    transition: background 0.2s;
}
.session-item:hover { background: rgba(239,68,68,0.06); }
.session-item.active { background: rgba(239,68,68,0.12); border-left: 3px solid #ef4444; }
.si-name { font-size: 13px; font-weight: 700; color: #f1f5f9; }
.si-email { font-size: 11px; color: rgba(148,163,184,0.7); margin-top: 2px; }
.si-last  { font-size: 11px; color: rgba(148,163,184,0.5); margin-top: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.si-takeover { display: inline-block; font-size: 10px; font-weight: 700; padding: 2px 6px; border-radius: 10px; background: rgba(239,68,68,0.3); color: #fca5a5; margin-left: 6px; }

/* Center: broadcast panel */
.admin-broadcast-panel {
    width: 300px; flex-shrink: 0;
    background: linear-gradient(180deg, #0f0c21 0%, #0a0818 100%);
    border-right: 1px solid rgba(139,92,246,0.15);
    display: flex; flex-direction: column; overflow: hidden;
}
.abp-header { padding: 18px; background: linear-gradient(135deg, #6b46a0, #8b5cf6); }
.abp-header h2 { font-size: 13px; font-weight: 800; color: #fff; margin: 0 0 2px; text-transform: uppercase; }
.abp-compose { padding: 14px; border-bottom: 1px solid rgba(139,92,246,0.15); }
.abp-compose textarea {
    width: 100%; background: rgba(139,92,246,0.08); border: 1px solid rgba(139,92,246,0.3);
    border-radius: 10px; padding: 10px 12px; color: #f1f5f9; font-size: 12px;
    resize: none; font-family: inherit; outline: none; transition: border-color 0.2s; min-height: 80px;
}
.abp-compose textarea:focus { border-color: #8b5cf6; }
.abp-compose-row { display: flex; gap: 6px; margin-top: 8px; }
.abp-tag-select {
    flex: 1; background: rgba(139,92,246,0.08); border: 1px solid rgba(139,92,246,0.3);
    border-radius: 8px; padding: 6px 10px; color: #c4b5fd; font-size: 12px; outline: none;
}
.abp-send-btn {
    padding: 6px 14px; border-radius: 8px; background: linear-gradient(135deg, #6b46a0, #8b5cf6);
    border: none; color: #fff; font-size: 12px; font-weight: 700; cursor: pointer; transition: all 0.2s;
}
.abp-send-btn:hover { transform: scale(1.03); }
.abp-list { flex: 1; overflow-y: auto; padding: 10px; display: flex; flex-direction: column; gap: 8px; }
.bcast-admin-card {
    background: rgba(139,92,246,0.06); border: 1px solid rgba(139,92,246,0.15);
    border-radius: 10px; padding: 10px 12px; font-size: 11px; color: #c4b5fd; line-height: 1.5;
}
.bcast-admin-card .ba-time { color: rgba(148,163,184,0.5); margin-top: 6px; font-size: 10px; }
.bcast-admin-card .ba-tag { display: inline-block; padding: 1px 6px; border-radius: 8px; font-size: 9px; font-weight: 700; margin-bottom: 4px; background: rgba(239,68,68,0.3); color: #fca5a5; }

/* Right: chat viewer */
.admin-chat-viewer { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
.acv-topbar {
    padding: 14px 20px; background: rgba(17,14,36,0.95); border-bottom: 1px solid rgba(239,68,68,0.12);
    display: flex; align-items: center; justify-content: space-between;
}
.acv-topbar h3 { font-size: 14px; font-weight: 700; color: #fff; margin: 0; }
.acv-topbar p  { font-size: 11px; color: rgba(148,163,184,0.7); margin: 0; }
.takeover-toggle {
    display: flex; align-items: center; gap: 8px;
    padding: 6px 14px; border-radius: 8px; border: none; cursor: pointer; font-size: 12px; font-weight: 700;
    transition: all 0.2s;
}
.takeover-toggle.off { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #fca5a5; }
.takeover-toggle.on  { background: linear-gradient(135deg, #dc2626, #ef4444); color: #fff; }

.acv-messages { flex: 1; overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 12px; }
.acv-messages::-webkit-scrollbar { width: 4px; }
.acv-messages::-webkit-scrollbar-thumb { background: rgba(139,92,246,0.3); border-radius: 4px; }
.acv-msg-row { display: flex; gap: 8px; animation: fadeSlideIn 0.3s ease; }
.acv-msg-row.from-user  { flex-direction: row-reverse; }
.acv-msg-row.from-ai, .acv-msg-row.from-admin { flex-direction: row; }
.acv-avatar { width: 30px; height: 30px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 14px; }
.acv-avatar.u  { background: linear-gradient(135deg, #0ea5e9, #6366f1); }
.acv-avatar.ai { background: linear-gradient(135deg, #6b46a0, #8b5cf6); }
.acv-avatar.ad { background: linear-gradient(135deg, #dc2626, #ef4444); }
.acv-bubble { max-width: 70%; padding: 10px 14px; border-radius: 14px; font-size: 13px; line-height: 1.6; white-space: pre-wrap; word-break: break-word; }
.from-user  .acv-bubble { background: linear-gradient(135deg, #6b46a0, #8b5cf6); color: #fff; border-bottom-right-radius: 4px; }
.from-ai    .acv-bubble { background: rgba(139,92,246,0.1); border: 1px solid rgba(139,92,246,0.2); color: #e2e8f0; border-bottom-left-radius: 4px; }
.from-admin .acv-bubble { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #fca5a5; border-bottom-left-radius: 4px; }
.acv-meta { font-size: 10px; color: rgba(148,163,184,0.5); margin-top: 3px; }
.from-user .acv-meta { text-align: right; }

.acv-input {
    padding: 14px 20px; background: rgba(17,14,36,0.95); border-top: 1px solid rgba(239,68,68,0.12);
}
.acv-input-note { font-size: 11px; color: rgba(148,163,184,0.5); margin-bottom: 8px; }
.acv-input-row { display: flex; gap: 8px; }
.acv-textarea {
    flex: 1; background: rgba(239,68,68,0.06); border: 1px solid rgba(239,68,68,0.2);
    border-radius: 10px; padding: 10px 14px; color: #f1f5f9; font-size: 13px; resize: none;
    font-family: inherit; outline: none; transition: border-color 0.2s; min-height: 44px;
}
.acv-textarea:focus { border-color: #ef4444; }
.acv-send { padding: 0 16px; border-radius: 10px; background: linear-gradient(135deg, #dc2626, #ef4444); border: none; color: #fff; font-size: 12px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
.acv-send:hover { transform: scale(1.03); }

.no-session-msg { flex: 1; display: flex; align-items: center; justify-content: center; color: rgba(148,163,184,0.4); font-size: 14px; text-align: center; }

@keyframes fadeSlideIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
</style>

<div class="admin-chat-root">
    <!-- ═══ LEFT: Session List ═══ -->
    <div class="admin-sessions">
        <div class="admin-sessions-header">
            <h2>🛡️ Phiên Chat</h2>
            <p><?php echo count($sessions); ?> phiên đang hoạt động</p>
        </div>
        <div class="session-list">
            <?php if (empty($sessions)): ?>
                <div style="padding: 20px; color: rgba(148,163,184,0.4); font-size: 12px; text-align: center;">
                    Chưa có người dùng nào bắt đầu chat.
                </div>
            <?php else: ?>
                <?php foreach ($sessions as $s): ?>
                <div class="session-item <?php echo ((int) $s['usersID'] === $viewUserID) ? 'active' : ''; ?>"
                     onclick="location.href='index.php?controller=chat&action=admin&view_user=<?php echo (int) $s['usersID']; ?>'">
                    <div class="si-name">
                        <?php echo htmlspecialchars($s['usersname'] ?? 'User #' . $s['usersID']); ?>
                        <?php if ($s['adminTookover']): ?>
                            <span class="si-takeover">🔴 Takeover</span>
                        <?php endif; ?>
                    </div>
                    <div class="si-email"><?php echo htmlspecialchars($s['email'] ?? ''); ?></div>
                    <div class="si-last"><?php echo htmlspecialchars(substr($s['lastMessage'] ?? '—', 0, 60)); ?></div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- ═══ CENTER: Broadcast Panel ═══ -->
    <div class="admin-broadcast-panel">
        <div class="abp-header">
            <h2>📢 Gửi Thông Báo</h2>
        </div>
        <div class="abp-compose">
            <textarea id="broadcastInput" placeholder="Nhập nội dung thông báo...&#10;Dùng [PROMO] hoặc [ADMIN_BROADCAST] để gắn thẻ."></textarea>
            <div class="abp-compose-row">
                <select id="broadcastTag" class="abp-tag-select">
                    <option value="PROMO">[PROMO] Khuyến mãi</option>
                    <option value="ADMIN_BROADCAST">[ADMIN_BROADCAST] Thông báo</option>
                </select>
                <button class="abp-send-btn" onclick="sendBroadcast()">📤 Gửi tất cả</button>
            </div>
        </div>
        <div class="abp-list" id="broadcastAdminList">
            <?php if (empty($broadcasts)): ?>
                <div style="color: rgba(148,163,184,0.4); font-size: 12px; text-align: center; padding: 16px;">Chưa có thông báo.</div>
            <?php else: ?>
                <?php foreach ($broadcasts as $b): ?>
                <div class="bcast-admin-card">
                    <span class="ba-tag"><?php echo htmlspecialchars($b['tag'] ?? 'INFO'); ?></span>
                    <div><?php echo nl2br(htmlspecialchars(substr($b['formatted'], 0, 120))); ?>...</div>
                    <div class="ba-time"><?php echo date('d/m H:i', strtotime($b['createdAt'])); ?> — <?php echo htmlspecialchars($b['adminName'] ?? 'Admin'); ?></div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- ═══ RIGHT: Chat Viewer / Takeover ═══ -->
    <div class="admin-chat-viewer">
        <?php if ($viewUserID > 0 && $viewSession): ?>
        <?php 
            $viewUser = null;
            foreach ($sessions as $s) { if ((int)$s['usersID'] === $viewUserID) { $viewUser = $s; break; } }
        ?>
        <div class="acv-topbar">
            <div>
                <h3>💬 <?php echo htmlspecialchars($viewUser['usersname'] ?? 'User #' . $viewUserID); ?></h3>
                <p><?php echo htmlspecialchars($viewUser['email'] ?? ''); ?></p>
            </div>
            <button
                id="takeoverBtn"
                class="takeover-toggle <?php echo $viewSession['adminTookover'] ? 'on' : 'off'; ?>"
                onclick="toggleTakeover()"
            >
                <?php echo $viewSession['adminTookover'] ? '🔴 Đang Takeover — Tắt' : '🟢 Bắt đầu Takeover'; ?>
            </button>
        </div>

        <div class="acv-messages" id="acvMessages">
            <?php foreach ($viewMessages as $msg): 
                $type = $msg['senderType'];
                $rowClass = $type === 'user' ? 'from-user' : ($type === 'admin' ? 'from-admin' : 'from-ai');
                $avClass  = $type === 'user' ? 'u' : ($type === 'admin' ? 'ad' : 'ai');
                $icon     = $type === 'user' ? '👤' : ($type === 'admin' ? '🛡️' : '🤖');
                $name     = $type === 'user' ? ($viewUser['usersname'] ?? 'User') : ($type === 'admin' ? 'Admin' : 'AI');
            ?>
            <div class="acv-msg-row <?php echo $rowClass; ?>">
                <div class="acv-avatar <?php echo $avClass; ?>"><?php echo $icon; ?></div>
                <div>
                    <div class="acv-bubble"><?php echo nl2br(htmlspecialchars($msg['content'])); ?></div>
                    <div class="acv-meta"><?php echo $name; ?> • <?php echo date('H:i', strtotime($msg['createdAt'])); ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="acv-input" id="acvInputArea">
            <div class="acv-input-note" id="acvNote">
                <?php echo $viewSession['adminTookover'] 
                    ? '✅ Bạn đang trả lời thay AI. Người dùng sẽ thấy tin nhắn của bạn.'
                    : '⚠️ Chưa Takeover. Bật Takeover để gửi tin nhắn trực tiếp.'; ?>
            </div>
            <div class="acv-input-row">
                <textarea id="adminReplyInput" class="acv-textarea" placeholder="Nhắn cho người dùng..." rows="1"></textarea>
                <button class="acv-send" onclick="sendAdminReply()">Gửi</button>
            </div>
        </div>

        <?php else: ?>
        <div class="no-session-msg">
            <div>
                <div style="font-size: 48px; margin-bottom: 12px;">💬</div>
                <div>Chọn một phiên chat từ danh sách bên trái<br>để xem và hỗ trợ người dùng.</div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
(function(){
    let lastBcastID = <?php echo $lastBcastID; ?>;
    let lastViewMsg = <?php echo $lastViewMsg; ?>;
    const viewUserID = <?php echo $viewUserID; ?>;
    let isTakeover  = <?php echo $viewSession ? ($viewSession['adminTookover'] ? 'true' : 'false') : 'false'; ?>;

    const bcastList = document.getElementById('broadcastAdminList');
    const acvMsgs   = document.getElementById('acvMessages');
    const noteEl    = document.getElementById('acvNote');
    const takeoverBtn = document.getElementById('takeoverBtn');

    // ── Send broadcast ────────────────────────────────────
    window.sendBroadcast = async function() {
        const msg = document.getElementById('broadcastInput').value.trim();
        const tag = document.getElementById('broadcastTag').value;
        if (!msg) return;

        const content = '[' + tag + '] ' + msg;

        try {
            const res = await fetch('index.php?controller=chat&action=broadcast', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'message=' + encodeURIComponent(content)
            });
            const data = await res.json();
            if (data.status === 'ok') {
                document.getElementById('broadcastInput').value = '';
                appendBcastCard(data.formatted, tag, new Date().toISOString());
                lastBcastID = data.broadcastID;
                alert('✅ Đã gửi thông báo đến tất cả người dùng!');
            }
        } catch(e) { alert('Lỗi khi gửi thông báo!'); }
    };

    // ── Admin reply (takeover) ────────────────────────────
    window.sendAdminReply = async function() {
        if (!isTakeover) { alert('Bạn cần bật Takeover trước!'); return; }
        const content = document.getElementById('adminReplyInput').value.trim();
        if (!content || !viewUserID) return;

        try {
            const res = await fetch('index.php?controller=chat&action=takeover', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `usersID=${viewUserID}&active=1&content=${encodeURIComponent(content)}`
            });
            const data = await res.json();
            if (data.status === 'ok') {
                document.getElementById('adminReplyInput').value = '';
                appendAcvMsg({ senderType: 'admin', content, createdAt: new Date().toISOString() });
                scrollAcv();
            }
        } catch(e) {}
    };

    // ── Toggle takeover ───────────────────────────────────
    window.toggleTakeover = async function() {
        const newState = !isTakeover;
        try {
            const res = await fetch('index.php?controller=chat&action=takeover', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `usersID=${viewUserID}&active=${newState ? 1 : 0}`
            });
            const data = await res.json();
            if (data.status === 'ok') {
                isTakeover = newState;
                if (takeoverBtn) {
                    takeoverBtn.className = 'takeover-toggle ' + (isTakeover ? 'on' : 'off');
                    takeoverBtn.textContent = isTakeover ? '🔴 Đang Takeover — Tắt' : '🟢 Bắt đầu Takeover';
                }
                if (noteEl) {
                    noteEl.textContent = isTakeover
                        ? '✅ Bạn đang trả lời thay AI. Người dùng sẽ thấy tin nhắn của bạn.'
                        : '⚠️ Chưa Takeover. Bật Takeover để gửi tin nhắn trực tiếp.';
                }
            }
        } catch(e) {}
    };

    // ── Poll for new messages in viewer ──────────────────
    async function pollAdmin() {
        if (!viewUserID) { setTimeout(pollAdmin, 4000); return; }
        try {
            const res  = await fetch(`index.php?controller=chat&action=adminPoll&usersID=${viewUserID}&after_msg=${lastViewMsg}`);
            const data = await res.json();
            data.messages?.forEach(m => {
                appendAcvMsg(m);
                lastViewMsg = Math.max(lastViewMsg, m.messageID);
                scrollAcv();
            });
        } catch(_) {}
        setTimeout(pollAdmin, 3000);
    }
    pollAdmin();

    // ── Append helpers ───────────────────────────────────
    function appendBcastCard(formatted, tag, time) {
        if (!bcastList) return;
        const ph = bcastList.querySelector('div[style*="color"]');
        if (ph) ph.remove();
        const d = document.createElement('div');
        d.className = 'bcast-admin-card';
        d.innerHTML = `<span class="ba-tag">${esc(tag)}</span><div>${esc(formatted).replace(/\n/g,'<br>').substring(0,150)}...</div><div class="ba-time">${new Date(time).toLocaleString('vi-VN')}</div>`;
        bcastList.prepend(d);
    }

    function appendAcvMsg(msg) {
        if (!acvMsgs) return;
        const type = msg.senderType;
        const rowClass = type === 'user' ? 'from-user' : (type === 'admin' ? 'from-admin' : 'from-ai');
        const avClass  = type === 'user' ? 'u' : (type === 'admin' ? 'ad' : 'ai');
        const icon     = type === 'user' ? '👤' : (type === 'admin' ? '🛡️' : '🤖');
        const name     = type === 'user' ? 'User' : (type === 'admin' ? 'Admin' : 'AI');
        const time     = new Date(msg.createdAt).toLocaleTimeString('vi-VN',{hour:'2-digit',minute:'2-digit'});
        const d = document.createElement('div');
        d.className = 'acv-msg-row ' + rowClass;
        d.innerHTML = `<div class="acv-avatar ${avClass}">${icon}</div><div><div class="acv-bubble">${esc(msg.content).replace(/\n/g,'<br>')}</div><div class="acv-meta">${name} • ${time}</div></div>`;
        acvMsgs.appendChild(d);
    }

    function scrollAcv() { if (acvMsgs) acvMsgs.scrollTop = acvMsgs.scrollHeight; }
    function esc(s) { return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

    if (acvMsgs) acvMsgs.scrollTop = acvMsgs.scrollHeight;
})();
</script>
