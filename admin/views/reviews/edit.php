<?php
/**
 * Edit Review View
 */
ob_start();
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Review</h1>
    <a href="index.php?controller=review" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Back to Reviews
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Review #<?php echo (int) ($review['reviewID'] ?? 0); ?></h6>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?controller=review&action=update">
            <input type="hidden" name="reviewID" value="<?php echo (int) ($review['reviewID'] ?? 0); ?>">

            <div class="form-group">
                <label>Tour</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($review['tourTitle'] ?? ''); ?>" disabled>
            </div>

            <div class="form-group">
                <label>User</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($review['usersname'] ?? ''); ?>" disabled>
            </div>

            <div class="form-group">
                <label for="rating">Rating</label>
                <select id="rating" name="rating" class="form-control" required>
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                    <option value="<?php echo $i; ?>" <?php echo (int) ($review['rating'] ?? 0) === $i ? 'selected' : ''; ?>>
                        <?php echo $i; ?> Star
                    </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment" rows="6" class="form-control" required><?php echo htmlspecialchars($review['comment'] ?? ''); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Update Review
            </button>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
