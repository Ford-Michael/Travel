<?php ob_start(); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add New Image</h1>
    <a href="index.php?controller=image" class="btn btn-secondary">
        <i class="fas fa-arrow-left mr-2"></i>Back to Images
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Image Information</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?controller=image&action=store" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            
            <div class="form-group">
                <label for="tour_id" class="font-weight-bold">Select Tour <span class="text-danger">*</span></label>
                <select class="form-control" id="tour_id" name="tour_id" required>
                    <option value="">-- Choose a Tour --</option>
                    <?php foreach ($tours as $tour): ?>
                        <option value="<?php echo $tour['tourID']; ?>">
                            <?php echo htmlspecialchars($tour['title']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="image" class="font-weight-bold">Upload Image <span class="text-danger">*</span></label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required>
                    <label class="custom-file-label" for="image">Choose image file...</label>
                </div>
                <small class="form-text text-muted">
                    Allowed formats: JPG, PNG, GIF, WEBP. Maximum size: 10MB.
                </small>
            </div>
            
            <div class="form-group">
                <label for="description" class="font-weight-bold">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" 
                          placeholder="Enter image description (optional)"></textarea>
            </div>
            
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="confirm" required>
                    <label class="custom-control-label" for="confirm">
                        I confirm that I have the right to upload this image
                    </label>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>Upload Image
                </button>
                <a href="index.php?controller=image" class="btn btn-secondary ml-2">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
// Update file input label when a file is selected
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    var fileName = document.getElementById("image").files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
    
    // Preview image
    var file = e.target.files[0];
    if (file && file.type.startsWith('image/')) {
        var reader = new FileReader();
        reader.onload = function(e) {
            // You can add image preview here if needed
        };
        reader.readAsDataURL(file);
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    var fileInput = document.getElementById('image');
    var file = fileInput.files[0];
    
    if (file) {
        // Check file size (10MB max)
        if (file.size > 10 * 1024 * 1024) {
            e.preventDefault();
            alert('File size must be less than 10MB.');
            return;
        }
        
        // Check file type
        var allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!allowedTypes.includes(file.type)) {
            e.preventDefault();
            alert('Invalid file type. Only JPG, PNG, GIF, WEBP are allowed.');
            return;
        }
    }
});
</script>

<?php 
$content = ob_get_clean(); 
require_once __DIR__ . '/../layouts/admin.php'; 
?>
