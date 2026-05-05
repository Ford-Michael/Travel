<?php
/**
 * Bookings List View
 */
ob_start();
?>

<!-- Banner Image -->
<div class="card shadow mb-4" style="border-radius: 15px; overflow: hidden; border: none;">
    <div style="position: relative; height: 180px; background: url('../img/pexels-fotoaibe-1571470.jpg') center/cover no-repeat;">
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(246,194,62,0.85), rgba(231,74,59,0.65));"></div>
        <div style="position: relative; z-index: 1; height: 100%; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem;">
            <div>
                <h1 class="h3 mb-1 text-white font-weight-bold"><i class="fas fa-calendar-check mr-2"></i>Bookings Management</h1>
                <p class="text-white-50 mb-0">View and manage all customer bookings</p>
            </div>
            <a href="index.php?controller=booking&action=create" class="btn btn-light btn-sm shadow-sm">
                <i class="fas fa-plus fa-sm mr-1"></i> Add New Booking
            </a>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" class="form-inline">
            <input type="hidden" name="controller" value="booking">
            <div class="form-group mr-3">
                <input type="text" name="search" class="form-control" placeholder="Search bookings..." 
                       value="<?php echo htmlspecialchars($search ?? ''); ?>">
            </div>
            <div class="form-group mr-3">
                <select name="status" class="form-control">
                    <option value="">All Statuses</option>
                    <option value="Pending" <?php echo ($currentStatus ?? '') === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="Confirmed" <?php echo ($currentStatus ?? '') === 'Confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                    <option value="Completed" <?php echo ($currentStatus ?? '') === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                    <option value="Cancelled" <?php echo ($currentStatus ?? '') === 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mr-2">
                <i class="fas fa-filter"></i> Filter
            </button>
            <?php if ($search || $currentStatus): ?>
            <a href="index.php?controller=booking" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Bookings Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-calendar-check mr-2"></i>All Bookings
            <span class="badge badge-primary ml-2"><?php echo count($bookings); ?></span>
        </h6>
    </div>
    <div class="card-body">
        <?php if (empty($bookings)): ?>
        <div class="text-center py-5">
            <i class="fas fa-calendar-check fa-3x text-gray-300 mb-3"></i>
            <p class="text-gray-500">No bookings found.</p>
            <a href="index.php?controller=booking&action=create" class="btn btn-primary">Add First Booking</a>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Tour</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Guests</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td>#<?php echo $booking['bookingID']; ?></td>
                        <td>
                            <strong><?php echo htmlspecialchars($booking['tourTitle'] ?? 'N/A'); ?></strong>
                            <?php if (isset($booking['destination'])): ?>
                            <br><small class="text-muted"><?php echo htmlspecialchars($booking['destination']); ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($booking['usersname'] ?? 'N/A'); ?>
                            <?php if (isset($booking['userEmail'])): ?>
                            <br><small class="text-muted"><?php echo htmlspecialchars($booking['userEmail']); ?></small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('M d, Y', strtotime($booking['bookingDate'])); ?></td>
                        <td class="text-center">
                            <i class="fas fa-user text-primary"></i> <?php echo $booking['numAdults']; ?>
                            <i class="fas fa-child text-success ml-2"></i> <?php echo $booking['numChildren']; ?>
                        </td>
                        <td class="text-right font-weight-bold">$<?php echo number_format($booking['totalPrice'], 2); ?></td>
                        <td class="text-center">
                            <?php
                            $paymentClass = 'secondary';
                            if ($booking['paymentStatus'] === 'Paid') $paymentClass = 'success';
                            elseif ($booking['paymentStatus'] === 'Pending') $paymentClass = 'warning';
                            elseif ($booking['paymentStatus'] === 'Refunded') $paymentClass = 'info';
                            ?>
                            <span class="badge badge-<?php echo $paymentClass; ?>"><?php echo $booking['paymentStatus']; ?></span>
                        </td>
                        <td class="text-center">
                            <?php
                            $statusClass = 'secondary';
                            if ($booking['bookingStatus'] === 'Confirmed') $statusClass = 'success';
                            elseif ($booking['bookingStatus'] === 'Pending') $statusClass = 'warning';
                            elseif ($booking['bookingStatus'] === 'Cancelled') $statusClass = 'danger';
                            elseif ($booking['bookingStatus'] === 'Completed') $statusClass = 'info';
                            ?>
                            <span class="badge badge-<?php echo $statusClass; ?>"><?php echo $booking['bookingStatus']; ?></span>
                        </td>
                        <td class="table-actions">
                            <a href="index.php?controller=booking&action=show&id=<?php echo $booking['bookingID']; ?>" 
                               class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="index.php?controller=booking&action=edit&id=<?php echo $booking['bookingID']; ?>" 
                               class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" onclick="confirmDelete('index.php?controller=booking&action=delete&id=<?php echo $booking['bookingID']; ?>', 'booking')" 
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
