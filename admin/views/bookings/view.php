<?php
/**
 * View Booking Details
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Booking #<?php echo $booking['bookingID']; ?></h1>
    <a href="index.php?controller=booking" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Back to Bookings
    </a>
</div>

<div class="row">
    <!-- Booking Info -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle mr-2"></i>Booking Details
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Tour Information</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted">Tour:</td>
                                <td><strong><?php echo htmlspecialchars($booking['tourTitle'] ?? 'N/A'); ?></strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Destination:</td>
                                <td><?php echo htmlspecialchars($booking['destination'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Duration:</td>
                                <td><?php echo htmlspecialchars($booking['duration'] ?? 'N/A'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Customer Information</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted">Name:</td>
                                <td><strong><?php echo htmlspecialchars($booking['usersname'] ?? 'N/A'); ?></strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Email:</td>
                                <td><?php echo htmlspecialchars($booking['userEmail'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Phone:</td>
                                <td><?php echo htmlspecialchars($booking['phoneNumber'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Address:</td>
                                <td><?php echo htmlspecialchars($booking['address'] ?? 'N/A'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-md-6">
                        <h5>Booking Info</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted">Booking Date:</td>
                                <td><?php echo date('F d, Y H:i', strtotime($booking['bookingDate'])); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Adults:</td>
                                <td><?php echo $booking['numAdults']; ?> × $<?php echo number_format($booking['priceAdult'] ?? 0, 2); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Children:</td>
                                <td><?php echo $booking['numChildren']; ?> × $<?php echo number_format($booking['priceChild'] ?? 0, 2); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted"><strong>Total:</strong></td>
                                <td><strong class="text-primary h4">$<?php echo number_format($booking['totalPrice'], 2); ?></strong></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <?php if ($booking['specialRequests']): ?>
                        <h5>Special Requests</h5>
                        <p class="bg-light p-3 rounded"><?php echo nl2br(htmlspecialchars($booking['specialRequests'])); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Status Update -->
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-cog mr-2"></i>Update Status
                </h6>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?controller=booking&action=updateStatus">
                    <input type="hidden" name="bookingID" value="<?php echo $booking['bookingID']; ?>">
                    
                    <div class="form-group">
                        <label>Booking Status</label>
                        <select name="bookingStatus" class="form-control">
                            <option value="Pending" <?php echo $booking['bookingStatus'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="Confirmed" <?php echo $booking['bookingStatus'] === 'Confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                            <option value="Completed" <?php echo $booking['bookingStatus'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                            <option value="Cancelled" <?php echo $booking['bookingStatus'] === 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Payment Status</label>
                        <select name="paymentStatus" class="form-control">
                            <option value="Unpaid" <?php echo $booking['paymentStatus'] === 'Unpaid' ? 'selected' : ''; ?>>Unpaid</option>
                            <option value="Pending" <?php echo $booking['paymentStatus'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="Paid" <?php echo $booking['paymentStatus'] === 'Paid' ? 'selected' : ''; ?>>Paid</option>
                            <option value="Refunded" <?php echo $booking['paymentStatus'] === 'Refunded' ? 'selected' : ''; ?>>Refunded</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save mr-1"></i> Update Status
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <a href="index.php?controller=bill&action=create&booking_id=<?php echo $booking['bookingID']; ?>" 
                   class="btn btn-success btn-block mb-2">
                    <i class="fas fa-file-invoice mr-1"></i> Generate Bill
                </a>
                <a href="#" onclick="confirmDelete('index.php?controller=booking&action=delete&id=<?php echo $booking['bookingID']; ?>', 'booking')" 
                   class="btn btn-danger btn-block">
                    <i class="fas fa-trash mr-1"></i> Delete Booking
                </a>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
