<?php
/**
 * Bills List View
 */
ob_start();
?>

<!-- Banner Image -->
<div class="card shadow mb-4" style="border-radius: 15px; overflow: hidden; border: none;">
    <div style="position: relative; height: 180px; background: url('../img/pexels-fotoaibe-1643383.jpg') center/cover no-repeat;">
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(28,200,138,0.85), rgba(54,185,204,0.75));"></div>
        <div style="position: relative; z-index: 1; height: 100%; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem;">
            <div>
                <h1 class="h3 mb-1 text-white font-weight-bold"><i class="fas fa-file-invoice-dollar mr-2"></i>Bills Management</h1>
                <p class="text-white-50 mb-0">Track and manage all billing records</p>
            </div>
            <div class="d-flex align-items-center">
                <a href="index.php?controller=bill&action=exportExcel<?php echo $search ? '&search=' . urlencode($search) : ''; ?>" class="btn btn-light btn-sm shadow-sm mr-2">
                    <i class="fas fa-file-excel fa-sm mr-1"></i> Export Excel
                </a>
                <a href="index.php?controller=bill&action=exportPdf<?php echo $search ? '&search=' . urlencode($search) : ''; ?>" class="btn btn-light btn-sm shadow-sm mr-2" target="_blank">
                    <i class="fas fa-file-pdf fa-sm mr-1"></i> Export PDF
                </a>
                <a href="index.php?controller=bill&action=create" class="btn btn-light btn-sm shadow-sm">
                    <i class="fas fa-plus fa-sm mr-1"></i> Create Bill
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
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Billed</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php echo number_format($totalBilled ?? 0, 2); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" class="form-inline">
            <input type="hidden" name="controller" value="bill">
            <div class="form-group mr-3">
                <input type="text" name="search" class="form-control" placeholder="Search bills..." 
                       value="<?php echo htmlspecialchars($search ?? ''); ?>">
            </div>
            <button type="submit" class="btn btn-primary mr-2">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="index.php?controller=bill&action=exportExcel<?php echo $search ? '&search=' . urlencode($search) : ''; ?>" class="btn btn-success mr-2">
                <i class="fas fa-file-excel"></i> Excel
            </a>
            <a href="index.php?controller=bill&action=exportPdf<?php echo $search ? '&search=' . urlencode($search) : ''; ?>" class="btn btn-danger mr-2" target="_blank">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
            <?php if ($search): ?>
            <a href="index.php?controller=bill" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Bills Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-file-invoice-dollar mr-2"></i>All Bills
            <span class="badge badge-primary ml-2"><?php echo count($bills); ?></span>
        </h6>
    </div>
    <div class="card-body">
        <?php if (empty($bills)): ?>
        <div class="text-center py-5">
            <i class="fas fa-file-invoice-dollar fa-3x text-gray-300 mb-3"></i>
            <p class="text-gray-500">No bills found.</p>
            <a href="index.php?controller=bill&action=create" class="btn btn-primary">Create First Bill</a>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th>Bill ID</th>
                        <th>Tour</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Issued Date</th>
                        <th>Payment</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bills as $bill): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($bill['billID']); ?></strong></td>
                        <td><?php echo htmlspecialchars($bill['tourTitle'] ?? 'N/A'); ?></td>
                        <td>
                            <?php echo htmlspecialchars($bill['usersname'] ?? 'N/A'); ?>
                            <?php if (isset($bill['userEmail'])): ?>
                            <br><small class="text-muted"><?php echo htmlspecialchars($bill['userEmail']); ?></small>
                            <?php endif; ?>
                        </td>
                        <td class="text-right font-weight-bold">$<?php echo number_format($bill['amount'], 2); ?></td>
                        <td><?php echo date('M d, Y', strtotime($bill['dateIssued'])); ?></td>
                        <td class="text-center">
                            <?php
                            $paymentClass = 'secondary';
                            $status = $bill['paymentStatus'] ?? 'Unknown';
                            if ($status === 'Paid') $paymentClass = 'success';
                            elseif ($status === 'Pending') $paymentClass = 'warning';
                            ?>
                            <span class="badge badge-<?php echo $paymentClass; ?>"><?php echo $status; ?></span>
                        </td>
                        <td class="table-actions">
                            <a href="index.php?controller=bill&action=show&id=<?php echo urlencode($bill['billID']); ?>" 
                               class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="index.php?controller=bill&action=edit&id=<?php echo urlencode($bill['billID']); ?>" 
                               class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?controller=bill&action=printBill&id=<?php echo urlencode($bill['billID']); ?>" 
                               class="btn btn-secondary btn-sm" title="Print" target="_blank">
                                <i class="fas fa-print"></i>
                            </a>
                            <a href="index.php?controller=bill&action=exportExcel&id=<?php echo urlencode($bill['billID']); ?>" 
                               class="btn btn-success btn-sm" title="Export Excel">
                                <i class="fas fa-file-excel"></i>
                            </a>
                            <a href="index.php?controller=bill&action=exportPdf&id=<?php echo urlencode($bill['billID']); ?>" 
                               class="btn btn-danger btn-sm" title="Export PDF" target="_blank">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            <a href="#" onclick="confirmDelete('index.php?controller=bill&action=delete&id=<?php echo urlencode($bill['billID']); ?>', 'bill')" 
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
