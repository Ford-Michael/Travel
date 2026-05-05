<?php
/**
 * Activity History View
 */
ob_start();
?>

<div class="card shadow mb-4" style="border-radius: 15px; overflow: hidden; border: none;">
    <div style="position: relative; height: 180px; background: url('../img/pexels-fotoaibe-1643383.jpg') center/cover no-repeat;">
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(78,115,223,0.85), rgba(90,92,105,0.75));"></div>
        <div style="position: relative; z-index: 1; height: 100%; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem;">
            <div>
                <h1 class="h3 mb-1 text-white font-weight-bold"><i class="fas fa-history mr-2"></i>Activity Log</h1>
                <p class="text-white-50 mb-0">Track login history and admin actions by account</p>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($statistics)): ?>
<div class="row mb-4">
    <?php foreach (array_slice($statistics, 0, 4) as $item): ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo htmlspecialchars($item['actionType'] ?? 'N/A'); ?></div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($item['count'] ?? 0); ?></div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" class="form-inline">
            <input type="hidden" name="controller" value="history">
            <div class="form-group mr-3">
                <input type="text" name="search" class="form-control" placeholder="Search account or action..." value="<?php echo htmlspecialchars($search ?? ''); ?>">
            </div>
            <div class="form-group mr-3">
                <select name="action_type" class="form-control">
                    <option value="">All Actions</option>
                    <?php foreach (($actionTypes ?? []) as $type): ?>
                    <option value="<?php echo htmlspecialchars($type); ?>" <?php echo ($currentActionType ?? '') === $type ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($type); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mr-2">
                <i class="fas fa-filter"></i> Filter
            </button>
            <?php if (!empty($search) || !empty($currentActionType)): ?>
            <a href="index.php?controller=history" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-history mr-2"></i>All Activity
            <span class="badge badge-primary ml-2"><?php echo count($history ?? []); ?></span>
        </h6>
        <a href="index.php?controller=history&action=clear&days=90" class="btn btn-outline-danger btn-sm" onclick="return confirm('Clear history older than 90 days?');">
            <i class="fas fa-trash mr-1"></i> Clear 90+ Days
        </a>
    </div>
    <div class="card-body">
        <?php if (empty($history)): ?>
        <div class="text-center py-5">
            <i class="fas fa-history fa-3x text-gray-300 mb-3"></i>
            <p class="text-gray-500">No activity found.</p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Account</th>
                        <th>Action</th>
                        <th>IP</th>
                        <th>User Agent</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $item): ?>
                    <tr>
                        <td>#<?php echo (int) $item['historyID']; ?></td>
                        <td>
                            <?php if (!empty($item['adminUsername'])): ?>
                                <strong><?php echo htmlspecialchars($item['adminUsername']); ?></strong>
                                <?php if (!empty($item['adminEmail'])): ?>
                                <br><small class="text-muted"><?php echo htmlspecialchars($item['adminEmail']); ?></small>
                                <?php endif; ?>
                            <?php elseif (!empty($item['usersname'])): ?>
                                <strong><?php echo htmlspecialchars($item['usersname']); ?></strong>
                                <?php if (!empty($item['userEmail'])): ?>
                                <br><small class="text-muted"><?php echo htmlspecialchars($item['userEmail']); ?></small>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-muted">System</span>
                            <?php endif; ?>
                        </td>
                        <td><span class="badge badge-info"><?php echo htmlspecialchars($item['actionType'] ?? 'N/A'); ?></span></td>
                        <td><?php echo htmlspecialchars($item['loginIP'] ?? '-'); ?></td>
                        <td>
                            <?php
                            $userAgent = (string) ($item['userAgent'] ?? '-');
                            echo htmlspecialchars(strlen($userAgent) > 80 ? substr($userAgent, 0, 80) . '...' : $userAgent);
                            ?>
                        </td>
                        <td><?php echo !empty($item['timestamp']) ? date('d/m/Y H:i:s', strtotime($item['timestamp'])) : ''; ?></td>
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
