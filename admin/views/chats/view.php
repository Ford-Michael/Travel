<?php
/**
 * View Live Chat Conversation
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Chat Session</h1>
    <div>
        <a href="index.php?controller=chat&action=toggleTakeover&id=<?php echo htmlspecialchars($session['sessionID']); ?>" 
           class="btn btn-<?php echo $session['adminTookover'] ? 'warning' : 'danger'; ?> btn-sm mr-2 shadow-sm">
            <i class="fas <?php echo $session['adminTookover'] ? 'fa-robot' : 'fa-user-shield'; ?> mr-1"></i> 
            <?php echo $session['adminTookover'] ? 'Enable AI' : 'Takeover Chat'; ?>
        </a>
        <a href="index.php?controller=chat" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Back to Chats
        </a>
    </div>
</div>

<div class="row">
    <!-- Chat Conversation -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-comments mr-2"></i>Live Conversation
                    <?php if ($session['adminTookover']): ?>
                        <span class="badge badge-danger ml-2">Admin Controlled</span>
                    <?php else: ?>
                        <span class="badge badge-success ml-2">AI Controlled</span>
                    <?php endif; ?>
                </h6>
            </div>
            <div class="card-body">
                <!-- Messages -->
                <div class="chat-messages bg-light p-3 rounded mb-4" id="chatContainer" style="height: 500px; overflow-y: auto; display: flex; flex-direction: column; gap: 1rem;">
                    <?php foreach ($messages as $msg): ?>
                        <?php if ($msg['senderType'] === 'user'): ?>
                            <!-- User Message -->
                            <div class="d-flex justify-content-end mb-2">
                                <div class="bg-primary text-white p-3 rounded shadow-sm" style="max-width: 80%; border-bottom-right-radius: 0;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong><?php echo htmlspecialchars($session['usersname']); ?></strong>
                                        <small class="ml-3 text-white-50"><?php echo date('H:i', strtotime($msg['createdAt'])); ?></small>
                                    </div>
                                    <div style="word-break: break-word;">
                                        <?php echo nl2br(htmlspecialchars($msg['content'])); ?>
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($msg['senderType'] === 'ai'): ?>
                            <!-- AI Message -->
                            <div class="d-flex justify-content-start mb-2">
                                <div class="bg-white border p-3 rounded shadow-sm" style="max-width: 80%; border-bottom-left-radius: 0;">
                                    <div class="d-flex justify-content-between align-items-center mb-1 text-primary">
                                        <strong><i class="fas fa-robot mr-1"></i> AI Assistant</strong>
                                        <small class="ml-3 text-muted"><?php echo date('H:i', strtotime($msg['createdAt'])); ?></small>
                                    </div>
                                    <div class="text-dark" style="word-break: break-word;">
                                        <?php echo nl2br(htmlspecialchars($msg['content'])); ?>
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($msg['senderType'] === 'admin'): ?>
                            <!-- Admin Message -->
                            <div class="d-flex justify-content-start mb-2">
                                <div class="bg-success text-white p-3 rounded shadow-sm" style="max-width: 80%; border-bottom-left-radius: 0;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong><i class="fas fa-user-shield mr-1"></i> <?php echo htmlspecialchars($msg['adminName'] ?? 'Admin'); ?></strong>
                                        <small class="ml-3 text-white-50"><?php echo date('H:i', strtotime($msg['createdAt'])); ?></small>
                                    </div>
                                    <div style="word-break: break-word;">
                                        <?php echo nl2br(htmlspecialchars($msg['content'])); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                
                <!-- Reply Form -->
                <form method="POST" action="index.php?controller=chat&action=reply" class="mt-3">
                    <input type="hidden" name="sessionID" value="<?php echo htmlspecialchars($session['sessionID']); ?>">
                    <div class="input-group">
                        <textarea class="form-control" id="message" name="message" rows="2" required
                                  placeholder="<?php echo $session['adminTookover'] ? 'Type your admin reply...' : 'Type your admin reply (This will disable AI)...'; ?>"></textarea>
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4" type="submit">
                                <i class="fas fa-paper-plane"></i> Send
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- User Info -->
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user mr-2"></i>User Information
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="text-muted">Name:</td>
                        <td><strong><?php echo htmlspecialchars($session['usersname'] ?? 'Guest'); ?></strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email:</td>
                        <td><?php echo htmlspecialchars($session['email'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Phone:</td>
                        <td><?php echo htmlspecialchars($session['phoneNumber'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">IP Address:</td>
                        <td><code><?php echo htmlspecialchars($session['ipAddress'] ?? 'N/A'); ?></code></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Last Active:</td>
                        <td><?php echo date('M d, Y H:i', strtotime($session['lastActivity'])); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Control:</td>
                        <td>
                            <?php if ($session['adminTookover']): ?>
                            <span class="badge badge-danger">Admin Controlled</span>
                            <?php else: ?>
                            <span class="badge badge-success">AI Controlled</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <?php if ($session['usersID']): ?>
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <a href="index.php?controller=user&action=show&id=<?php echo $session['usersID']; ?>" 
                   class="btn btn-outline-primary btn-block mb-2">
                    <i class="fas fa-user mr-1"></i> View User Profile
                </a>
                <a href="index.php?controller=booking&search=<?php echo urlencode($session['email']); ?>" 
                   class="btn btn-outline-info btn-block">
                    <i class="fas fa-ticket-alt mr-1"></i> View User Bookings
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
// Auto-scroll chat to bottom
document.addEventListener('DOMContentLoaded', function() {
    var chatContainer = document.getElementById('chatContainer');
    chatContainer.scrollTop = chatContainer.scrollHeight;
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
