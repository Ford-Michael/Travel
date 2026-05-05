<?php
/**
 * View User Details
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User Details</h1>
    <div>
        <a href="index.php?controller=user&action=edit&id=<?php echo $user['usersID']; ?>" class="btn btn-warning btn-sm shadow-sm">
            <i class="fas fa-edit fa-sm mr-1"></i> Edit User
        </a>
        <a href="index.php?controller=user" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Back to Users
        </a>
    </div>
</div>

<div class="row">
    <!-- User Info Card -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user mr-2"></i>User Information
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="150">User ID:</td>
                        <td><strong>#<?php echo $user['usersID']; ?></strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Username:</td>
                        <td><strong><?php echo htmlspecialchars($user['usersname']); ?></strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email:</td>
                        <td>
                            <a href="mailto:<?php echo htmlspecialchars($user['email']); ?>">
                                <?php echo htmlspecialchars($user['email']); ?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Phone:</td>
                        <td><?php echo htmlspecialchars($user['phoneNumber'] ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Address:</td>
                        <td><?php echo htmlspecialchars($user['address'] ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">IP Address:</td>
                        <td><?php echo htmlspecialchars($user['ipAddress'] ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status:</td>
                        <td>
                            <span class="badge badge-<?php echo ($user['status'] ?? 'inactive') === 'active' ? 'success' : 'secondary'; ?>">
                                <?php echo htmlspecialchars(ucfirst($user['status'] ?? 'inactive')); ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Is Active:</td>
                        <td>
                            <?php if (!empty($user['isActive'])): ?>
                            <span class="badge badge-success">Yes</span>
                            <?php else: ?>
                            <span class="badge badge-secondary">No</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Bookings</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($bookingHistory ?? []); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Payments</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($paymentHistory ?? []); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Paid Amount</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php echo number_format($totalPaymentAmount ?? 0, 2); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Actions Card -->
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <a href="index.php?controller=user&action=edit&id=<?php echo $user['usersID']; ?>" 
                   class="btn btn-warning btn-block mb-2">
                    <i class="fas fa-edit mr-1"></i> Edit User
                </a>
                <a href="index.php?controller=user&action=toggleStatus&id=<?php echo $user['usersID']; ?>" 
                   class="btn btn-info btn-block mb-2">
                    <i class="fas fa-toggle-<?php echo $user['isActive'] ? 'off' : 'on'; ?> mr-1"></i>
                    <?php echo $user['isActive'] ? 'Deactivate' : 'Activate'; ?> User
                </a>
                <hr>
                <a href="#" onclick="confirmDelete('index.php?controller=user&action=delete&id=<?php echo $user['usersID']; ?>', 'user')" 
                   class="btn btn-outline-danger btn-block">
                    <i class="fas fa-trash mr-1"></i> Delete User
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-calendar-check mr-2"></i>Booking History
        </h6>
    </div>
    <div class="card-body">
        <?php if (empty($bookingHistory)): ?>
            <p class="text-muted mb-0">No booking history found.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Tour</th>
                            <th>Date</th>
                            <th>Guests</th>
                            <th>Total</th>
                            <th>Booking Status</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookingHistory as $booking): ?>
                        <tr>
                            <td>
                                <a href="index.php?controller=booking&action=show&id=<?php echo $booking['bookingID']; ?>">
                                    #<?php echo $booking['bookingID']; ?>
                                </a>
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($booking['tourTitle'] ?? 'N/A'); ?></strong><br>
                                <small class="text-muted"><?php echo htmlspecialchars($booking['destination'] ?? '-'); ?></small>
                            </td>
                            <td><?php echo !empty($booking['bookingDate']) ? date('d/m/Y H:i', strtotime($booking['bookingDate'])) : '-'; ?></td>
                            <td><?php echo (int) ($booking['numAdults'] ?? 0) + (int) ($booking['numChildren'] ?? 0); ?></td>
                            <td>$<?php echo number_format((float) ($booking['totalPrice'] ?? 0), 2); ?></td>
                            <td>
                                <span class="badge badge-<?php echo ($booking['bookingStatus'] ?? '') === 'Confirmed' ? 'success' : (($booking['bookingStatus'] ?? '') === 'Pending' ? 'warning' : 'secondary'); ?>">
                                    <?php echo htmlspecialchars($booking['bookingStatus'] ?? 'N/A'); ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-<?php echo ($booking['paymentStatus'] ?? '') === 'Paid' ? 'success' : (($booking['paymentStatus'] ?? '') === 'Pending' || ($booking['paymentStatus'] ?? '') === 'Unpaid' ? 'warning' : 'secondary'); ?>">
                                    <?php echo htmlspecialchars($booking['paymentStatus'] ?? 'N/A'); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-credit-card mr-2"></i>Payment History
        </h6>
    </div>
    <div class="card-body">
        <?php if (empty($paymentHistory)): ?>
            <p class="text-muted mb-0">No payment history found.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>Booking</th>
                            <th>Tour</th>
                            <th>Method</th>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paymentHistory as $payment): ?>
                        <tr>
                            <td>
                                <a href="index.php?controller=checkout&action=show&id=<?php echo $payment['checkoutID']; ?>">
                                    #<?php echo $payment['checkoutID']; ?>
                                </a>
                            </td>
                            <td>
                                <?php if (!empty($payment['bookingID'])): ?>
                                    <a href="index.php?controller=booking&action=show&id=<?php echo $payment['bookingID']; ?>">
                                        #<?php echo $payment['bookingID']; ?>
                                    </a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($payment['tourTitle'] ?? 'N/A'); ?></strong><br>
                                <small class="text-muted"><?php echo htmlspecialchars($payment['destination'] ?? '-'); ?></small>
                            </td>
                            <td><?php echo htmlspecialchars($payment['paymentMethod'] ?? '-'); ?></td>
                            <td><code><?php echo htmlspecialchars($payment['transactionID'] ?? '-'); ?></code></td>
                            <td>$<?php echo number_format((float) ($payment['amount'] ?? 0), 2); ?></td>
                            <td>
                                <span class="badge badge-<?php echo ($payment['paymentStatus'] ?? '') === 'Completed' ? 'success' : (($payment['paymentStatus'] ?? '') === 'Pending' ? 'warning' : 'secondary'); ?>">
                                    <?php echo htmlspecialchars($payment['paymentStatus'] ?? 'N/A'); ?>
                                </span>
                            </td>
                            <td><?php echo !empty($payment['paymentDate']) ? date('d/m/Y H:i', strtotime($payment['paymentDate'])) : '-'; ?></td>
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
