<?php
/**
 * Reviews List View
 */
ob_start();
?>

<!-- Banner Image -->
<div class="card shadow mb-4" style="border-radius: 15px; overflow: hidden; border: none;">
    <div style="position: relative; height: 180px; background: url('../img/dl.png') center/cover no-repeat;">
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(246,194,62,0.85), rgba(253,126,20,0.75));"></div>
        <div style="position: relative; z-index: 1; height: 100%; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem;">
            <div>
                <h1 class="h3 mb-1 text-white font-weight-bold"><i class="fas fa-star mr-2"></i>Reviews Management</h1>
                <p class="text-white-50 mb-0">View and moderate customer feedback and ratings</p>
            </div>
            <div class="d-flex align-items-center">
                <a href="index.php?controller=review&action=exportExcel<?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $currentRating ? '&rating=' . urlencode($currentRating) : ''; ?>" class="btn btn-light btn-sm shadow-sm mr-2">
                    <i class="fas fa-file-excel fa-sm mr-1"></i> Export Excel
                </a>
                <a href="index.php?controller=review&action=exportPdf<?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $currentRating ? '&rating=' . urlencode($currentRating) : ''; ?>" class="btn btn-light btn-sm shadow-sm" target="_blank">
                    <i class="fas fa-file-pdf fa-sm mr-1"></i> Export PDF
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<?php if ($statistics): ?>
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Reviews</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $statistics['totalReviews'] ?? 0; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Average Rating</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo number_format($statistics['overallAverage'] ?? 0, 1); ?>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-star fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">5-Star Reviews</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $statistics['fiveStars'] ?? 0; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-trophy fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Filters -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" class="form-inline">
            <input type="hidden" name="controller" value="review">
            <div class="form-group mr-3">
                <input type="text" name="search" class="form-control" placeholder="Search reviews..." 
                       value="<?php echo htmlspecialchars($search ?? ''); ?>">
            </div>
            <div class="form-group mr-3">
                <select name="rating" class="form-control">
                    <option value="">All Ratings</option>
                    <option value="5" <?php echo ($currentRating ?? '') === '5' ? 'selected' : ''; ?>>5 Stars</option>
                    <option value="4" <?php echo ($currentRating ?? '') === '4' ? 'selected' : ''; ?>>4 Stars</option>
                    <option value="3" <?php echo ($currentRating ?? '') === '3' ? 'selected' : ''; ?>>3 Stars</option>
                    <option value="2" <?php echo ($currentRating ?? '') === '2' ? 'selected' : ''; ?>>2 Stars</option>
                    <option value="1" <?php echo ($currentRating ?? '') === '1' ? 'selected' : ''; ?>>1 Star</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mr-2">
                <i class="fas fa-filter"></i> Filter
            </button>
            <a href="index.php?controller=review&action=exportExcel<?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $currentRating ? '&rating=' . urlencode($currentRating) : ''; ?>" class="btn btn-success mr-2">
                <i class="fas fa-file-excel"></i> Excel
            </a>
            <a href="index.php?controller=review&action=exportPdf<?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $currentRating ? '&rating=' . urlencode($currentRating) : ''; ?>" class="btn btn-danger mr-2" target="_blank">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
            <?php if ($search || $currentRating): ?>
            <a href="index.php?controller=review" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Reviews Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-star mr-2"></i>All Reviews
            <span class="badge badge-primary ml-2"><?php echo count($reviews); ?></span>
        </h6>
    </div>
    <div class="card-body">
        <?php if (empty($reviews)): ?>
        <div class="text-center py-5">
            <i class="fas fa-star fa-3x text-gray-300 mb-3"></i>
            <p class="text-gray-500">No reviews found.</p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Tour</th>
                        <th>Customer</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reviews as $review): ?>
                    <tr>
                        <td>#<?php echo $review['reviewID']; ?></td>
                        <td>
                            <strong><?php echo htmlspecialchars($review['tourTitle'] ?? 'N/A'); ?></strong>
                            <?php if (isset($review['destination'])): ?>
                            <br><small class="text-muted"><?php echo htmlspecialchars($review['destination']); ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($review['usersname'] ?? 'N/A'); ?>
                            <?php if (isset($review['userEmail'])): ?>
                            <br><small class="text-muted"><?php echo htmlspecialchars($review['userEmail']); ?></small>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star <?php echo $i <= $review['rating'] ? 'text-warning' : 'text-gray-300'; ?>"></i>
                            <?php endfor; ?>
                        </td>
                        <td>
                            <?php 
                            $comment = htmlspecialchars($review['comment'] ?? '');
                            echo strlen($comment) > 100 ? substr($comment, 0, 100) . '...' : $comment;
                            ?>
                        </td>
                        <td><?php echo date('M d, Y', strtotime($review['timestamp'])); ?></td>
                        <td class="table-actions">
                            <a href="index.php?controller=review&action=edit&id=<?php echo $review['reviewID']; ?>" 
                               class="btn btn-primary btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?controller=review&action=exportExcel&id=<?php echo $review['reviewID']; ?>" 
                               class="btn btn-success btn-sm" title="Export Excel">
                                <i class="fas fa-file-excel"></i>
                            </a>
                            <a href="index.php?controller=review&action=exportPdf&id=<?php echo $review['reviewID']; ?>" 
                               class="btn btn-danger btn-sm" title="Export PDF" target="_blank">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            <a href="#" onclick="confirmDelete('index.php?controller=review&action=delete&id=<?php echo $review['reviewID']; ?>', 'review')" 
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
