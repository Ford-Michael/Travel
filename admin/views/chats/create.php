<?php
/**
 * Create Broadcast View
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Send Chat Broadcast</h1>
    <a href="index.php?controller=chat" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Back to Chats
    </a>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-bullhorn mr-2"></i>New System Broadcast
                </h6>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?controller=chat&action=store">
                    <div class="form-group mb-4">
                        <label for="tag">Broadcast Tag / Type</label>
                        <select class="form-control" id="tag" name="tag">
                            <option value="system">System Notification</option>
                            <option value="promotion">Special Promotion</option>
                            <option value="alert">Important Alert</option>
                        </select>
                        <small class="form-text text-muted">This determines the style of the broadcast in the user's chat window.</small>
                    </div>

                    <div class="form-group mb-4">
                        <label for="message">Broadcast Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required
                                  placeholder="Type the message that all users will see..."></textarea>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>
                        This message will be broadcasted to all users and shown globally in the chat interface.
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-paper-plane mr-1"></i> Send Broadcast
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
