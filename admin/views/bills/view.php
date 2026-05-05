<?php
/**
 * View Bill Details
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bill <?php echo htmlspecialchars($bill['billID']); ?></h1>
    <div>
        <a href="index.php?controller=bill&action=exportExcel&id=<?php echo urlencode($bill['billID']); ?>" 
           class="btn btn-success btn-sm">
            <i class="fas fa-file-excel mr-1"></i> Excel
        </a>
        <a href="index.php?controller=bill&action=exportPdf&id=<?php echo urlencode($bill['billID']); ?>" 
           class="btn btn-danger btn-sm" target="_blank">
            <i class="fas fa-file-pdf mr-1"></i> PDF
        </a>
        <a href="index.php?controller=bill&action=printBill&id=<?php echo urlencode($bill['billID']); ?>" 
           class="btn btn-secondary btn-sm" target="_blank">
            <i class="fas fa-print mr-1"></i> Print
        </a>
        <a href="index.php?controller=bill" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-file-invoice-dollar mr-2"></i>Bill Details
        </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Bill Information</h5>
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="40%">Bill ID:</td>
                        <td><strong><?php echo htmlspecialchars($bill['billID']); ?></strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Date Issued:</td>
                        <td><?php echo date('F d, Y H:i', strtotime($bill['dateIssued'])); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Amount:</td>
                        <td><strong class="text-primary h4">$<?php echo number_format($bill['amount'], 2); ?></strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Booking ID:</td>
                        <td>
                            <a href="index.php?controller=booking&action=show&id=<?php echo $bill['bookingID']; ?>">
                                #<?php echo $bill['bookingID']; ?>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5>Customer Information</h5>
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="40%">Name:</td>
                        <td><strong><?php echo htmlspecialchars($bill['usersname'] ?? 'N/A'); ?></strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email:</td>
                        <td><?php echo htmlspecialchars($bill['userEmail'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Phone:</td>
                        <td><?php echo htmlspecialchars($bill['phoneNumber'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Address:</td>
                        <td><?php echo htmlspecialchars($bill['address'] ?? 'N/A'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
        
        <hr>
        
        <h5>Tour Details</h5>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Tour</th>
                    <th>Destination</th>
                    <th>Duration</th>
                    <th>Adults</th>
                    <th>Children</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($bill['tourTitle'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($bill['destination'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($bill['duration'] ?? 'N/A'); ?></td>
                    <td><?php echo $bill['numAdults'] ?? 0; ?></td>
                    <td><?php echo $bill['numChildren'] ?? 0; ?></td>
                    <td class="text-right font-weight-bold">$<?php echo number_format($bill['bookingTotal'] ?? 0, 2); ?></td>
                </tr>
            </tbody>
        </table>
        
        <?php if (!empty($bill['details'])): ?>
        <h5>Additional Details</h5>
        <p class="bg-light p-3 rounded"><?php echo nl2br(htmlspecialchars($bill['details'])); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
