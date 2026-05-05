<?php
/**
 * View Chat Conversation
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Chat #<?php echo $chat['chatID']; ?></h1>
    <a href="index.php?controller=chat" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Back to Chats
    </a>
</div>

<div class="row">
    <!-- Chat Conversation -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-comments mr-2"></i>Conversation
                </h6>
            </div>
            <div class="card-body">
                <!-- Messages -->
                <div class="chat-messages bg-light p-3 rounded mb-4" style="max-height: 400px; overflow-y: auto;">
                    <?php 
                    $messages = $chat['messages'] ?? '';
                    // Parse messages - split by admin replies
                    $parts = preg_split('/(\[Admin Reply - [^\]]+\])/', $messages, -1, PREG_SPLIT_DELIM_CAPTURE);
                    
                    $isFirst = true;
                    foreach ($parts as $part):
                        $part = trim($part);
                        if (empty($part)) continue;
                        
                        if (preg_match('/\[Admin Reply - ([^\]]+)\]/', $part, $matches)):
                            // This is an admin reply header
                            $timestamp = $matches[1];
                    ?>
                        <div class="text-right mb-2">
                            <small class="text-muted"><?php echo $timestamp; ?></small>
                        </div>
                    <?php else: ?>
                        <?php if ($isFirst): ?>
                        <div class="chat-bubble user mb-3">
                            <div class="bg-primary text-white p-3 rounded" style="max-width: 80%;">
                                <small class="d-block mb-1">
                                    <strong><?php echo htmlspecialchars($chat['usersname'] ?? 'User'); ?></strong>
                                    <span class="ml-2"><?php echo date('M d, Y H:i', strtotime($chat['createdDate'])); ?></span>
                                </small>
                                <?php echo nl2br(htmlspecialchars($part)); ?>
                            </div>
                        </div>
                        <?php $isFirst = false; ?>
                        <?php else: ?>
                        <div class="chat-bubble admin mb-3 text-right">
                            <div class="bg-success text-white p-3 rounded d-inline-block" style="max-width: 80%;">
                                <small class="d-block mb-1"><strong>Admin</strong></small>
                                <?php echo nl2br(htmlspecialchars($part)); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endif; endforeach; ?>
                </div>
                
                <!-- Reply Form -->
                <form method="POST" action="index.php?controller=chat&action=reply">
                    <input type="hidden" name="chatID" value="<?php echo $chat['chatID']; ?>">
                    <div class="form-group">
                        <label for="message">Your Reply</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required
                                  placeholder="Type your reply..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane mr-1"></i> Send Reply
                    </button>
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
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted">Name:</td>
                        <td><strong><?php echo htmlspecialchars($chat['usersname'] ?? 'Guest'); ?></strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email:</td>
                        <td><?php echo htmlspecialchars($chat['userEmail'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Phone:</td>
                        <td><?php echo htmlspecialchars($chat['phoneNumber'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">IP Address:</td>
                        <td><code><?php echo htmlspecialchars($chat['ipAddress'] ?? 'N/A'); ?></code></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Started:</td>
                        <td><?php echo date('M d, Y H:i', strtotime($chat['createdDate'])); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status:</td>
                        <td>
                            <?php if ($chat['readStatus']): ?>
                            <span class="badge badge-success">Read</span>
                            <?php else: ?>
                            <span class="badge badge-warning">Unread</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <?php if ($chat['usersID']): ?>
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <a href="index.php?controller=user&action=show&id=<?php echo $chat['usersID']; ?>" 
                   class="btn btn-outline-primary btn-block">
                    <i class="fas fa-user mr-1"></i> View User Profile
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
