<?php
/**
 * Chats List View
 */
ob_start();
?>

<!-- Banner Image -->
<div class="card shadow mb-4" style="border-radius: 15px; overflow: hidden; border: none;">
    <div style="position: relative; height: 180px; background: url('../img/pexels-fotoaibe-1669799.jpg') center/cover no-repeat;">
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(111,66,193,0.85), rgba(232,62,140,0.7));"></div>
        <div style="position: relative; z-index: 1; height: 100%; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem;">
            <div>
                <h1 class="h3 mb-1 text-white font-weight-bold">
                    <i class="fas fa-comments mr-2"></i>Live Support Chat
                </h1>
                <p class="text-white-50 mb-0">Manage customer support conversations</p>
            </div>
            <a href="index.php?controller=chat&action=create" class="btn btn-light btn-sm shadow-sm">
                <i class="fas fa-bullhorn mr-1"></i> Send Broadcast
            </a>
        </div>
    </div>
</div>

<!-- Chats Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-comments mr-2"></i>Active Sessions
            <span class="badge badge-primary ml-2"><?php echo count($sessions); ?></span>
        </h6>
    </div>
    <div class="card-body">
        <?php if (empty($sessions)): ?>
        <div class="text-center py-5">
            <i class="fas fa-comments fa-3x text-gray-300 mb-3"></i>
            <p class="text-gray-500">No active chat sessions found.</p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th>Status</th>
                        <th>User</th>
                        <th>Last Message Preview</th>
                        <th>Msg Count</th>
                        <th>Last Activity</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sessions as $session): ?>
                    <tr>
                        <td class="text-center align-middle">
                            <?php if ($session['adminTookover']): ?>
                            <span class="badge badge-danger">Admin Takeover</span>
                            <?php else: ?>
                            <span class="badge badge-success">AI Active</span>
                            <?php endif; ?>
                        </td>
                        <td class="align-middle">
                            <strong><?php echo htmlspecialchars($session['usersname'] ?? 'Guest'); ?></strong>
                            <?php if (isset($session['email'])): ?>
                            <br><small class="text-muted"><?php echo htmlspecialchars($session['email']); ?></small>
                            <?php endif; ?>
                        </td>
                        <td class="align-middle">
                            <?php 
                            $message = htmlspecialchars($session['lastMessage'] ?? '');
                            echo strlen($message) > 80 ? substr($message, 0, 80) . '...' : $message;
                            ?>
                        </td>
                        <td class="align-middle text-center">
                            <span class="badge badge-info"><?php echo $session['messageCount']; ?> user msgs</span>
                        </td>
                        <td class="align-middle"><?php echo date('M d, Y H:i', strtotime($session['lastAt'] ?? $session['lastActivity'])); ?></td>
                        <td class="table-actions align-middle text-center">
                            <a href="index.php?controller=chat&action=show&id=<?php echo htmlspecialchars($session['sessionID']); ?>" 
                               class="btn btn-info btn-sm" title="View & Reply">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
