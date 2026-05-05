<?php
/**
 * Edit Bill View
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Bill</h1>
    <a href="index.php?controller=bill" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Back to Bills
    </a>
</div>

<div class="row">
    <!-- Bill Edit Form -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-edit mr-2"></i>Edit Bill: <?php echo htmlspecialchars($bill['billID']); ?>
                </h6>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?controller=bill&action=update">
                    <input type="hidden" name="billID" value="<?php echo htmlspecialchars($bill['billID']); ?>">
                    
                    <div class="form-group">
                        <label for="billID">Bill ID</label>
                        <input type="text" class="form-control" id="billID" 
                               value="<?php echo htmlspecialchars($bill['billID']); ?>" readonly disabled>
                        <small class="form-text text-muted">Bill ID cannot be changed.</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="bookingID">Booking</label>
                        <input type="text" class="form-control" id="bookingID" 
                               value="#<?php echo $bill['bookingID']; ?> - <?php echo htmlspecialchars($bill['tourTitle'] ?? 'N/A'); ?> - <?php echo htmlspecialchars($bill['usersname'] ?? 'N/A'); ?>" 
                               readonly disabled>
                        <small class="form-text text-muted">Booking cannot be changed after bill creation.</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="amount">Amount <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" step="0.01" class="form-control" id="amount" name="totalAmount" 
                                   value="<?php echo number_format($bill['amount'], 2, '.', ''); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="dateIssued">Date Issued</label>
                        <input type="text" class="form-control" id="dateIssued" 
                               value="<?php echo date('M d, Y H:i', strtotime($bill['dateIssued'])); ?>" readonly disabled>
                    </div>
                    
                    <div class="form-group">
                        <label for="details">Details / Notes</label>
                        <textarea class="form-control" id="details" name="details" rows="4"
                                  placeholder="Enter any additional notes or details for this bill..."><?php echo htmlspecialchars($bill['details'] ?? ''); ?></textarea>
                    </div>
                    
                    <hr>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Update Bill
                        </button>
                        <a href="index.php?controller=bill" class="btn btn-secondary ml-2">Cancel</a>
                        <a href="index.php?controller=bill&action=show&id=<?php echo urlencode($bill['billID']); ?>" class="btn btn-info ml-2">
                            <i class="fas fa-eye mr-1"></i> View Details
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Bill Info Sidebar -->
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">
                    <i class="fas fa-info-circle mr-2"></i>Bill Information
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr>
                        <th>Bill ID:</th>
                        <td><strong><?php echo htmlspecialchars($bill['billID']); ?></strong></td>
                    </tr>
                    <tr>
                        <th>Booking ID:</th>
                        <td>#<?php echo $bill['bookingID']; ?></td>
                    </tr>
                    <tr>
                        <th>Tour:</th>
                        <td><?php echo htmlspecialchars($bill['tourTitle'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <th>Customer:</th>
                        <td><?php echo htmlspecialchars($bill['usersname'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo htmlspecialchars($bill['userEmail'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td><?php echo htmlspecialchars($bill['phoneNumber'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            <?php
                            $paymentClass = 'secondary';
                            $status = $bill['paymentStatus'] ?? 'Unknown';
                            if ($status === 'Paid') $paymentClass = 'success';
                            elseif ($status === 'Pending') $paymentClass = 'warning';
                            ?>
                            <span class="badge badge-<?php echo $paymentClass; ?>"><?php echo $status; ?></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="card shadow mb-4 border-left-warning">
            <div class="card-body">
                <h6 class="font-weight-bold text-warning"><i class="fas fa-exclamation-triangle mr-2"></i>Quick Actions</h6>
                <div class="d-grid gap-2">
                    <a href="index.php?controller=bill&action=printBill&id=<?php echo urlencode($bill['billID']); ?>" 
                       class="btn btn-outline-secondary btn-sm mb-2" target="_blank">
                        <i class="fas fa-print mr-1"></i> Print Bill
                    </a>
                    <a href="#" onclick="confirmDelete('index.php?controller=bill&action=delete&id=<?php echo urlencode($bill['billID']); ?>', 'bill')" 
                       class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash mr-1"></i> Delete Bill
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
