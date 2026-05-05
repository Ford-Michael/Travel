<?php
/**
 * Edit Tour View
 */
ob_start();
$primaryImageUrl = $tour['displayImageURL'] ?? ($tour['imageURL'] ?? null);
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Tour</h1>
    <a href="index.php?controller=tour" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Back to Tours
    </a>
</div>

<!-- Edit Form -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-edit mr-2"></i>Edit Tour: <?php echo htmlspecialchars($tour['title']); ?>
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?controller=tour&action=update" enctype="multipart/form-data">
            <input type="hidden" name="tourID" value="<?php echo $tour['tourID']; ?>">
            
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">Tour Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required
                               value="<?php echo htmlspecialchars($tour['title']); ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="destination">Destination <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="destination" name="destination" required
                               value="<?php echo htmlspecialchars($tour['destination']); ?>">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?php echo htmlspecialchars($tour['description']); ?></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="priceAdult">Adult Price ($) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="priceAdult" name="priceAdult" 
                               step="0.01" min="0" required value="<?php echo $tour['priceAdult']; ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="priceChild">Child Price ($) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="priceChild" name="priceChild" 
                               step="0.01" min="0" required value="<?php echo $tour['priceChild']; ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" class="form-control" id="duration" name="duration" 
                               value="<?php echo htmlspecialchars($tour['duration']); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="quantity">Available Spots</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" 
                               min="0" value="<?php echo $tour['quantity']; ?>">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="departureDate">Departure Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="departureDate" name="departureDate" required
                               value="<?php echo htmlspecialchars($tour['departureDate'] ?? ''); ?>">
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center">
                    <div class="form-group mb-0">
                        <div class="custom-control custom-switch mt-4">
                            <input type="checkbox" class="custom-control-input" id="availability" name="availability" 
                                   <?php echo $tour['availability'] ? 'checked' : ''; ?>>
                            <label class="custom-control-label" for="availability">Tour is Available</label>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!-- Main Image Upload -->
            <div class="card bg-light mb-3 border-left-warning">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-warning">
                        <i class="fas fa-image mr-2"></i>Ảnh đại diện (Main Image)
                    </h6>
                </div>
                <div class="card-body py-3">
                    <?php if (!empty($primaryImageUrl)): ?>
                    <div class="mb-3">
                        <p class="small text-muted mb-1">Ảnh đại diện hiện tại:</p>
                        <img src="<?php echo htmlspecialchars($primaryImageUrl); ?>" alt="Main Image" class="img-thumbnail" style="max-height: 150px;">
                    </div>
                    <?php endif; ?>
                    <div class="form-group mb-0">
                        <label for="mainImage" class="small">Tải lên ảnh mới để thay thế (Tùy chọn)</label>
                        <input type="file" class="form-control-file border p-2 rounded bg-white" id="mainImage" name="mainImage" accept="image/*">
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Update Tour
                </button>
                <a href="index.php?controller=tour&action=show&id=<?php echo $tour['tourID']; ?>" 
                   class="btn btn-info ml-2">
                    <i class="fas fa-eye mr-1"></i> View Details
                </a>
                <a href="index.php?controller=tour" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
