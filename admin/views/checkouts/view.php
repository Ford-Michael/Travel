<?php
/**
 * View Checkout/Payment Details
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Payment #<?php echo $checkout['checkoutID']; ?></h1>
    <div>
        <a href="index.php?controller=checkout&action=exportExcel&id=<?php echo $checkout['checkoutID']; ?>" class="btn btn-success btn-sm">
            <i class="fas fa-file-excel mr-1"></i> Excel
        </a>
        <a href="index.php?controller=checkout&action=exportPdf&id=<?php echo $checkout['checkoutID']; ?>" class="btn btn-danger btn-sm" target="_blank">
            <i class="fas fa-file-pdf mr-1"></i> PDF
        </a>
        <a href="index.php?controller=checkout" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left mr-1"></i> Back to Payments
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-credit-card mr-2"></i>Payment Details
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Transaction Information</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted" width="40%">Payment ID:</td>
                                <td><strong>#<?php echo $checkout['checkoutID']; ?></strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Transaction ID:</td>
                                <td><code><?php echo htmlspecialchars($checkout['transactionID'] ?? 'N/A'); ?></code></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Payment Method:</td>
                                <td><?php echo htmlspecialchars($checkout['paymentMethod'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Payment Date:</td>
                                <td><?php echo date('F d, Y H:i', strtotime($checkout['paymentDate'])); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Amount:</td>
                                <td><strong class="text-success h4">$<?php echo number_format($checkout['amount'], 2); ?></strong></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Customer Information</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted" width="40%">Name:</td>
                                <td><strong><?php echo htmlspecialchars($checkout['usersname'] ?? 'N/A'); ?></strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Email:</td>
                                <td><?php echo htmlspecialchars($checkout['userEmail'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Phone:</td>
                                <td><?php echo htmlspecialchars($checkout['phoneNumber'] ?? 'N/A'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <hr>
                
                <h5>Booking Information</h5>
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="20%">Tour:</td>
                        <td><?php echo htmlspecialchars($checkout['tourTitle'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Destination:</td>
                        <td><?php echo htmlspecialchars($checkout['destination'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Guests:</td>
                        <td>
                            <?php echo $checkout['numAdults'] ?? 0; ?> Adults, 
                            <?php echo $checkout['numChildren'] ?? 0; ?> Children
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Booking Total:</td>
                        <td>$<?php echo number_format($checkout['bookingTotal'] ?? 0, 2); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-cog mr-2"></i>Update Status
                </h6>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?controller=checkout&action=updateStatus">
                    <input type="hidden" name="checkoutID" value="<?php echo $checkout['checkoutID']; ?>">
                    
                    <div class="form-group">
                        <label>Current Status</label>
                        <?php
                        $statusClass = 'secondary';
                        $status = $checkout['paymentStatus'] ?? 'Unknown';
                        if ($status === 'Completed') $statusClass = 'success';
                        elseif ($status === 'Pending') $statusClass = 'warning';
                        elseif ($status === 'Failed') $statusClass = 'danger';
                        elseif ($status === 'Refunded') $statusClass = 'info';
                        ?>
                        <div><span class="badge badge-<?php echo $statusClass; ?> badge-lg"><?php echo $status; ?></span></div>
                    </div>
                    
                    <div class="form-group">
                        <label>Change Status</label>
                        <select name="paymentStatus" class="form-control">
                            <option value="Pending" <?php echo $status === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="Completed" <?php echo $status === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                            <option value="Failed" <?php echo $status === 'Failed' ? 'selected' : ''; ?>>Failed</option>
                            <option value="Refunded" <?php echo $status === 'Refunded' ? 'selected' : ''; ?>>Refunded</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save mr-1"></i> Update Status
                    </button>
                </form>
            </div>
        </div>
        
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Related</h6>
            </div>
            <div class="card-body">
                <a href="index.php?controller=booking&action=show&id=<?php echo $checkout['bookingID']; ?>" 
                   class="btn btn-outline-primary btn-block">
                    <i class="fas fa-calendar-check mr-1"></i> View Booking
                </a>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
