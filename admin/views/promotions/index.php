<?php
/**
 * Promotions List View
 */
ob_start();
?>

<!-- Banner Image -->
<div class="card shadow mb-4" style="border-radius: 15px; overflow: hidden; border: none;">
    <div style="position: relative; height: 180px; background: url('../img/pexels-atbo-66986-245208.jpg') center/cover no-repeat;">
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(231,74,59,0.85), rgba(246,194,62,0.75));"></div>
        <div style="position: relative; z-index: 1; height: 100%; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem;">
            <div>
                <h1 class="h3 mb-1 text-white font-weight-bold"><i class="fas fa-tags mr-2"></i>Promotions Management</h1>
                <p class="text-white-50 mb-0">Create and manage promotional campaigns</p>
            </div>
            <a href="index.php?controller=promotion&action=create" class="btn btn-light btn-sm shadow-sm">
                <i class="fas fa-plus fa-sm mr-1"></i> Create Promotion
            </a>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="btn-group mr-3" role="group">
            <a href="index.php?controller=promotion" class="btn btn-<?php echo !$currentFilter ? 'primary' : 'outline-primary'; ?>">All</a>
            <a href="index.php?controller=promotion&filter=active" class="btn btn-<?php echo $currentFilter === 'active' ? 'success' : 'outline-success'; ?>">Active</a>
            <a href="index.php?controller=promotion&filter=upcoming" class="btn btn-<?php echo $currentFilter === 'upcoming' ? 'info' : 'outline-info'; ?>">Upcoming</a>
            <a href="index.php?controller=promotion&filter=expired" class="btn btn-<?php echo $currentFilter === 'expired' ? 'secondary' : 'outline-secondary'; ?>">Expired</a>
        </div>
        <form method="GET" class="form-inline d-inline">
            <input type="hidden" name="controller" value="promotion">
            <div class="form-group mr-2">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." 
                       value="<?php echo htmlspecialchars($search ?? ''); ?>">
            </div>
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</div>

<!-- Promotions Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-tags mr-2"></i>All Promotions
            <span class="badge badge-primary ml-2"><?php echo count($promotions); ?></span>
        </h6>
    </div>
    <div class="card-body">
        <?php if (empty($promotions)): ?>
        <div class="text-center py-5">
            <i class="fas fa-tags fa-3x text-gray-300 mb-3"></i>
            <p class="text-gray-500">No promotions found.</p>
            <a href="index.php?controller=promotion&action=create" class="btn btn-primary">Create First Promotion</a>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Discount</th>
                        <th>Tour</th>
                        <th>Period</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($promotions as $promo): ?>
                    <tr>
                        <td><code class="h5"><?php echo htmlspecialchars($promo['promotionID']); ?></code></td>
                        <td><?php echo htmlspecialchars($promo['description'] ?? ''); ?></td>
                        <td class="text-center font-weight-bold text-success">
                            <?php echo number_format($promo['discount'], 2); ?>%
                        </td>
                        <td><?php echo htmlspecialchars($promo['tourTitle'] ?? 'All Tours'); ?></td>
                        <td>
                            <small>
                                <?php echo date('M d', strtotime($promo['startDate'])); ?> - 
                                <?php echo date('M d, Y', strtotime($promo['endDate'])); ?>
                            </small>
                        </td>
                        <td class="text-center">
                            <?php if ($promo['quantity'] !== null): ?>
                            <span class="badge badge-<?php echo $promo['quantity'] > 0 ? 'success' : 'danger'; ?>">
                                <?php echo $promo['quantity']; ?>
                            </span>
                            <?php else: ?>
                            <span class="badge badge-info">∞</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php
                            $statusClass = 'secondary';
                            $statusText = ucfirst($promo['status'] ?? 'unknown');
                            if ($promo['status'] === 'active') $statusClass = 'success';
                            elseif ($promo['status'] === 'upcoming') $statusClass = 'info';
                            elseif ($promo['status'] === 'expired' || $promo['status'] === 'exhausted') $statusClass = 'secondary';
                            ?>
                            <span class="badge badge-<?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                        </td>
                        <td class="table-actions">
                            <a href="index.php?controller=promotion&action=edit&id=<?php echo urlencode($promo['promotionID']); ?>" 
                               class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" onclick="confirmDelete('index.php?controller=promotion&action=delete&id=<?php echo urlencode($promo['promotionID']); ?>', 'promotion')" 
                               class="btn btn-danger btn-sm" title="Delete">
                                <i class="fas fa-trash"></i>
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
