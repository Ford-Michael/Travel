<?php
/**
 * Edit Promotion View
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Promotion</h1>
    <a href="index.php?controller=promotion" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Back to Promotions
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-edit mr-2"></i>Edit: <?php echo htmlspecialchars($promotion['promotionID']); ?>
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?controller=promotion&action=update">
            <input type="hidden" name="promotionID" value="<?php echo htmlspecialchars($promotion['promotionID']); ?>">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Promotion Code</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($promotion['promotionID']); ?>" disabled>
                        <small class="form-text text-muted">Promotion code cannot be changed.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="discount">Discount (%) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="discount" name="discount" 
                                   step="0.01" min="0" max="100" required 
                                   value="<?php echo $promotion['discount']; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="2"><?php echo htmlspecialchars($promotion['description'] ?? ''); ?></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="startDate">Start Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="startDate" name="startDate" required
                               value="<?php echo date('Y-m-d\TH:i', strtotime($promotion['startDate'])); ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="endDate">End Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="endDate" name="endDate" required
                               value="<?php echo date('Y-m-d\TH:i', strtotime($promotion['endDate'])); ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quantity">Usage Limit</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" 
                               min="0" value="<?php echo $promotion['quantity']; ?>"
                               placeholder="Leave empty for unlimited">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="tourID">Apply to Tour (Optional)</label>
                <select class="form-control" id="tourID" name="tourID">
                    <option value="">All Tours</option>
                    <?php foreach ($tours as $tour): ?>
                    <option value="<?php echo $tour['tourID']; ?>" 
                            <?php echo $promotion['tourID'] == $tour['tourID'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($tour['title']); ?> - 
                        <?php echo htmlspecialchars($tour['destination']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <hr>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Update Promotion
                </button>
                <a href="index.php?controller=promotion" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
