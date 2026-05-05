<?php
/**
 * Create Bill View
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create Bill</h1>
    <a href="index.php?controller=bill" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Back to Bills
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-plus mr-2"></i>New Bill
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?controller=bill&action=store">
            <div class="form-group">
                <label for="bookingID">Select Booking <span class="text-danger">*</span></label>
                <select class="form-control" id="bookingID" name="bookingID" required>
                    <option value="">-- Select a Booking --</option>
                    <?php foreach ($bookings as $booking): ?>
                    <option value="<?php echo $booking['bookingID']; ?>">
                        #<?php echo $booking['bookingID']; ?> - 
                        <?php echo htmlspecialchars($booking['tourTitle'] ?? 'N/A'); ?> - 
                        <?php echo htmlspecialchars($booking['usersname'] ?? 'N/A'); ?> - 
                        $<?php echo number_format($booking['totalPrice'], 2); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <small class="form-text text-muted">Select a booking to generate a bill for.</small>
            </div>
            
            <div class="form-group">
                <label for="details">Additional Details (Optional)</label>
                <textarea class="form-control" id="details" name="details" rows="4"
                          placeholder="Enter any additional notes or details for this bill..."></textarea>
            </div>
            
            <hr>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-file-invoice mr-1"></i> Generate Bill
                </button>
                <a href="index.php?controller=bill" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
