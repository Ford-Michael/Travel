<?php
/**
 * Create Promotion View
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create Promotion</h1>
    <a href="index.php?controller=promotion" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Back to Promotions
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-plus mr-2"></i>New Promotion
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?controller=promotion&action=store">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="promotionID">Promotion Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-uppercase" id="promotionID" name="promotionID" required
                               placeholder="e.g., SUMMER2024" maxlength="50">
                        <small class="form-text text-muted">Unique code customers will use at checkout.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="discount">Discount (%) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="discount" name="discount" 
                                   step="0.01" min="0" max="100" required placeholder="0.00">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="2"
                          placeholder="e.g., Summer holiday special discount"></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="startDate">Start Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="startDate" name="startDate" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="endDate">End Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="endDate" name="endDate" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quantity">Usage Limit</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" 
                               min="0" placeholder="Leave empty for unlimited">
                        <small class="form-text text-muted">Max number of times this code can be used.</small>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="tourID">Apply to Tour (Optional)</label>
                <select class="form-control" id="tourID" name="tourID">
                    <option value="">All Tours</option>
                    <?php foreach ($tours as $tour): ?>
                    <option value="<?php echo $tour['tourID']; ?>">
                        <?php echo htmlspecialchars($tour['title']); ?> - 
                        <?php echo htmlspecialchars($tour['destination']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <small class="form-text text-muted">Leave empty to apply to all tours.</small>
            </div>
            
            <hr>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Create Promotion
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
