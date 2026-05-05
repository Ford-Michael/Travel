<?php
/**
 * Create Booking View
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-calendar-plus mr-2"></i>Create New Booking
    </h1>
    <a href="index.php?controller=booking" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Back to Bookings
    </a>
</div>

<!-- Create Form -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-info-circle mr-2"></i>Booking Details
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?controller=booking&action=store">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tourID">Tour <span class="text-danger">*</span></label>
                        <select class="form-control" id="tourID" name="tourID" required>
                            <option value="">-- Select Tour --</option>
                            <?php foreach ($tours as $tour): ?>
                            <option value="<?php echo $tour['tourID']; ?>" 
                                    data-adult="<?php echo $tour['priceAdult']; ?>"
                                    data-child="<?php echo $tour['priceChild']; ?>">
                                <?php echo htmlspecialchars($tour['title']); ?> 
                                (Adult: $<?php echo number_format($tour['priceAdult'], 2); ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usersID">Customer <span class="text-danger">*</span></label>
                        <select class="form-control" id="usersID" name="usersID" required>
                            <option value="">-- Select Customer --</option>
                            <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['usersID']; ?>">
                                <?php echo htmlspecialchars($user['usersname']); ?> 
                                (<?php echo htmlspecialchars($user['email']); ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="numberOfAdults">Number of Adults <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="numberOfAdults" name="numberOfAdults" 
                               value="1" min="1" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="numberOfChildren">Number of Children</label>
                        <input type="number" class="form-control" id="numberOfChildren" name="numberOfChildren" 
                               value="0" min="0">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="bookingDate">Booking Date</label>
                        <input type="datetime-local" class="form-control" id="bookingDate" name="bookingDate" 
                               value="<?php echo date('Y-m-d\TH:i'); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="totalPrice">Total Price ($)</label>
                        <input type="number" class="form-control" id="totalPrice" name="totalPrice" 
                               step="0.01" min="0" value="0.00" readonly>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bookingStatus">Booking Status</label>
                        <select class="form-control" id="bookingStatus" name="bookingStatus">
                            <option value="Pending" selected>Pending</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="paymentStatus">Payment Status</label>
                        <select class="form-control" id="paymentStatus" name="paymentStatus">
                            <option value="Unpaid" selected>Unpaid</option>
                            <option value="Paid">Paid</option>
                            <option value="Refunded">Refunded</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="specialRequests">Special Requests</label>
                        <textarea class="form-control" id="specialRequests" name="specialRequests" 
                                  rows="1" placeholder="Any special requests..."></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Destination Section -->
            <div class="card bg-light mb-3">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-map-marker-alt mr-2"></i>Destination Information
                    </h6>
                </div>
                <div class="card-body py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="destination">Destination</label>
                                <input type="text" class="form-control" id="destination" name="destination" 
                                       placeholder="e.g., Da Nang, Ha Long Bay...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="destinationAddress">Destination Address</label>
                                <input type="text" class="form-control" id="destinationAddress" name="destinationAddress" 
                                       placeholder="Full address...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Hotel/Room Section -->
            <div class="card bg-light mb-3">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-success">
                        <i class="fas fa-hotel mr-2"></i>Hotel & Room Information
                    </h6>
                </div>
                <div class="card-body py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="hotelName">Hotel Name</label>
                                <input type="text" class="form-control" id="hotelName" name="hotelName" 
                                       placeholder="e.g., Grand Hotel...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-2">
                                <label for="roomNumber">Room Number</label>
                                <input type="text" class="form-control" id="roomNumber" name="roomNumber" 
                                       placeholder="e.g., 101">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-2">
                                <label for="roomType">Room Type</label>
                                <select class="form-control" id="roomType" name="roomType">
                                    <option value="">-- Select --</option>
                                    <option value="Single">Single</option>
                                    <option value="Double">Double</option>
                                    <option value="Twin">Twin</option>
                                    <option value="Suite">Suite</option>
                                    <option value="Deluxe">Deluxe</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-2">
                                <label for="checkInDate">Check-in Date</label>
                                <input type="date" class="form-control" id="checkInDate" name="checkInDate">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-2">
                                <label for="checkOutDate">Check-out Date</label>
                                <input type="date" class="form-control" id="checkOutDate" name="checkOutDate">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bus/Transport Section -->
            <div class="card bg-light mb-3">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-warning">
                        <i class="fas fa-bus mr-2"></i>Transport Information
                    </h6>
                </div>
                <div class="card-body py-3">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="busCompany">Bus/Transport Company</label>
                                <input type="text" class="form-control" id="busCompany" name="busCompany" 
                                       placeholder="e.g., Phuong Trang...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-2">
                                <label for="vehicleType">Vehicle Type</label>
                                <select class="form-control" id="vehicleType" name="vehicleType">
                                    <option value="">-- Select --</option>
                                    <option value="Bus">Bus</option>
                                    <option value="Minibus">Minibus</option>
                                    <option value="Van">Van</option>
                                    <option value="Car">Car</option>
                                    <option value="Limousine">Limousine</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-2">
                                <label for="seatNumber">Seat Number</label>
                                <input type="text" class="form-control" id="seatNumber" name="seatNumber" 
                                       placeholder="e.g., A12">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="pickupAddress">Pickup Address</label>
                                <input type="text" class="form-control" id="pickupAddress" name="pickupAddress" 
                                       placeholder="Pickup location...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-2">
                                <label for="pickupTime">Pickup Time</label>
                                <input type="time" class="form-control" id="pickupTime" name="pickupTime">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Travel Dates Section -->
            <div class="card bg-light mb-3">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-danger">
                        <i class="fas fa-calendar-alt mr-2"></i>Travel Dates
                    </h6>
                </div>
                <div class="card-body py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="travelStartDate">Travel Start Date</label>
                                <input type="date" class="form-control" id="travelStartDate" name="travelStartDate">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="travelEndDate">Travel End Date</label>
                                <input type="date" class="form-control" id="travelEndDate" name="travelEndDate">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label for="numberOfDays">Number of Days</label>
                                <input type="number" class="form-control" id="numberOfDays" name="numberOfDays" 
                                       min="1" placeholder="Auto-calculated" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Create Booking
                </button>
                <a href="index.php?controller=booking" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
// Auto-calculate total price
function calculateTotal() {
    var tour = document.getElementById('tourID');
    var selectedOption = tour.options[tour.selectedIndex];
    var adultPrice = parseFloat(selectedOption.dataset.adult) || 0;
    var childPrice = parseFloat(selectedOption.dataset.child) || 0;
    var adults = parseInt(document.getElementById('numberOfAdults').value) || 0;
    var children = parseInt(document.getElementById('numberOfChildren').value) || 0;
    
    var total = (adultPrice * adults) + (childPrice * children);
    document.getElementById('totalPrice').value = total.toFixed(2);
}

// Auto-calculate number of days
function calculateDays() {
    var startDate = document.getElementById('travelStartDate').value;
    var endDate = document.getElementById('travelEndDate').value;
    
    if (startDate && endDate) {
        var start = new Date(startDate);
        var end = new Date(endDate);
        var diffTime = Math.abs(end - start);
        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        document.getElementById('numberOfDays').value = diffDays;
    }
}

document.getElementById('tourID').addEventListener('change', calculateTotal);
document.getElementById('numberOfAdults').addEventListener('input', calculateTotal);
document.getElementById('numberOfChildren').addEventListener('input', calculateTotal);
document.getElementById('travelStartDate').addEventListener('change', calculateDays);
document.getElementById('travelEndDate').addEventListener('change', calculateDays);
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
