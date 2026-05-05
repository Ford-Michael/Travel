<?php
/**
 * Checkouts/Payments List View
 */
ob_start();
?>

<!-- Banner Image -->
<div class="card shadow mb-4" style="border-radius: 15px; overflow: hidden; border: none;">
    <div style="position: relative; height: 180px; background: url('../img/pexels-jason-boyd-1388339-3209045.jpg') center/cover no-repeat;">
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(54,185,204,0.85), rgba(78,115,223,0.75));"></div>
        <div style="position: relative; z-index: 1; height: 100%; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem;">
            <div>
                <h1 class="h3 mb-1 text-white font-weight-bold"><i class="fas fa-credit-card mr-2"></i>Payments Management</h1>
                <p class="text-white-50 mb-0">Monitor all payment transactions and records</p>
            </div>
            <div class="d-flex align-items-center">
                <a href="index.php?controller=checkout&action=exportExcel<?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $currentStatus ? '&status=' . urlencode($currentStatus) : ''; ?>" class="btn btn-light btn-sm shadow-sm mr-2">
                    <i class="fas fa-file-excel fa-sm mr-1"></i> Export Excel
                </a>
                <a href="index.php?controller=checkout&action=exportPdf<?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $currentStatus ? '&status=' . urlencode($currentStatus) : ''; ?>" class="btn btn-light btn-sm shadow-sm" target="_blank">
                    <i class="fas fa-file-pdf fa-sm mr-1"></i> Export PDF
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Summary Card -->
<div class="row mb-4">
    <div class="col-xl-4 col-md-6">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Received</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php echo number_format($totalPayments ?? 0, 2); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" class="form-inline">
            <input type="hidden" name="controller" value="checkout">
            <div class="form-group mr-3">
                <input type="text" name="search" class="form-control" placeholder="Search payments..." 
                       value="<?php echo htmlspecialchars($search ?? ''); ?>">
            </div>
            <div class="form-group mr-3">
                <select name="status" class="form-control">
                    <option value="">All Statuses</option>
                    <option value="Pending" <?php echo ($currentStatus ?? '') === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="Completed" <?php echo ($currentStatus ?? '') === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                    <option value="Failed" <?php echo ($currentStatus ?? '') === 'Failed' ? 'selected' : ''; ?>>Failed</option>
                    <option value="Refunded" <?php echo ($currentStatus ?? '') === 'Refunded' ? 'selected' : ''; ?>>Refunded</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mr-2">
                <i class="fas fa-filter"></i> Filter
            </button>
            <a href="index.php?controller=checkout&action=exportExcel<?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $currentStatus ? '&status=' . urlencode($currentStatus) : ''; ?>" class="btn btn-success mr-2">
                <i class="fas fa-file-excel"></i> Excel
            </a>
            <a href="index.php?controller=checkout&action=exportPdf<?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $currentStatus ? '&status=' . urlencode($currentStatus) : ''; ?>" class="btn btn-danger mr-2" target="_blank">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
            <?php if ($search || $currentStatus): ?>
            <a href="index.php?controller=checkout" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Payments Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-credit-card mr-2"></i>All Payments
            <span class="badge badge-primary ml-2"><?php echo count($checkouts); ?></span>
        </h6>
    </div>
    <div class="card-body">
        <?php if (empty($checkouts)): ?>
        <div class="text-center py-5">
            <i class="fas fa-credit-card fa-3x text-gray-300 mb-3"></i>
            <p class="text-gray-500">No payments found.</p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Tour</th>
                        <th>Customer</th>
                        <th>Method</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th width="100">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($checkouts as $checkout): ?>
                    <tr>
                        <td>#<?php echo $checkout['checkoutID']; ?></td>
                        <td><?php echo htmlspecialchars($checkout['tourTitle'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($checkout['usersname'] ?? 'N/A'); ?></td>
                        <td>
                            <i class="fas fa-<?php 
                                echo $checkout['paymentMethod'] === 'Credit Card' ? 'credit-card' : 
                                    ($checkout['paymentMethod'] === 'PayPal' ? 'paypal' : 'money-bill'); 
                            ?> mr-1"></i>
                            <?php echo htmlspecialchars($checkout['paymentMethod'] ?? 'N/A'); ?>
                        </td>
                        <td><code><?php echo htmlspecialchars($checkout['transactionID'] ?? 'N/A'); ?></code></td>
                        <td class="text-right font-weight-bold">$<?php echo number_format($checkout['amount'], 2); ?></td>
                        <td><?php echo date('M d, Y', strtotime($checkout['paymentDate'])); ?></td>
                        <td class="text-center">
                            <?php
                            $statusClass = 'secondary';
                            $status = $checkout['paymentStatus'] ?? 'Unknown';
                            if ($status === 'Completed') $statusClass = 'success';
                            elseif ($status === 'Pending') $statusClass = 'warning';
                            elseif ($status === 'Failed') $statusClass = 'danger';
                            elseif ($status === 'Refunded') $statusClass = 'info';
                            ?>
                            <span class="badge badge-<?php echo $statusClass; ?>"><?php echo $status; ?></span>
                        </td>
                        <td class="table-actions">
                            <a href="index.php?controller=checkout&action=show&id=<?php echo $checkout['checkoutID']; ?>" 
                               class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="index.php?controller=checkout&action=exportExcel&id=<?php echo $checkout['checkoutID']; ?>" 
                               class="btn btn-success btn-sm" title="Export Excel">
                                <i class="fas fa-file-excel"></i>
                            </a>
                            <a href="index.php?controller=checkout&action=exportPdf&id=<?php echo $checkout['checkoutID']; ?>" 
                               class="btn btn-danger btn-sm" title="Export PDF" target="_blank">
                                <i class="fas fa-file-pdf"></i>
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
