<?php ob_start(); ?>

<!-- Banner Image -->
<div class="card shadow mb-4" style="border: none; border-radius: 15px; overflow: hidden;">
    <div style="position: relative; height: 180px; background: linear-gradient(135deg, rgba(78,115,223,0.85), rgba(28,200,138,0.75));">
        <div style="position: relative; z-index: 1; height: 100%; display: flex; align-items: center; padding: 0 2rem;">
            <div>
                <h1 class="h3 mb-1 text-white font-weight-bold"><i class="fas fa-images mr-2"></i>Images Management</h1>
                <p class="text-white-50 mb-0">Quản lý hình ảnh cho các tour</p>
            </div>
            <div class="ml-auto">
                <a href="index.php?controller=image&action=add" class="btn btn-light">
                    <i class="fas fa-plus mr-2"></i>Thêm Hình Ảnh Mới
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Images (<?php echo $totalImages; ?>)</h6>
    </div>
    <div class="card-body">
        <?php if (empty($images)): ?>
            <div class="text-center py-4">
                <i class="fas fa-images fa-3x text-gray-300 mb-3"></i>
                <p class="text-gray-500">No images found.</p>
                <a href="index.php?controller=image&action=add" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i>Add First Image
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Tour</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($images as $image): ?>
                            <tr>
                                <td>
                                    <?php 
                                    $imageSrc = '';
                                    if (!empty($image['imageURL'])) {
                                        // Try different path formats
                                        $possiblePaths = [
                                            '../' . $image['imageURL'],
                                            $image['imageURL'],
                                            '../img/' . $image['imageURL'],
                                            '../img/tours/' . basename($image['imageURL'])
                                        ];
                                        
                                        foreach ($possiblePaths as $path) {
                                            $relativePath = str_replace('\\', '/', $path);
                                            while (strpos($relativePath, '../') === 0) {
                                                $relativePath = substr($relativePath, 3);
                                            }

                                            if (file_exists(__DIR__ . '/../../' . $relativePath)) {
                                                $imageSrc = $path;
                                                break;
                                            }
                                        }
                                        
                                        if (empty($imageSrc)) {
                                            $imageSrc = '../' . $image['imageURL']; // Fallback
                                        }
                                    }
                                    
                                    if (!empty($image['imageURL'])): ?>
                                        <img src="<?php echo htmlspecialchars($imageSrc); ?>" 
                                             alt="Tour Image" 
                                             style="width: 80px; height: 60px; object-fit: cover; border-radius: 4px;"
                                             onerror="this.src='assets/img/no-image.png'; console.log('Image failed:', '<?php echo htmlspecialchars($image['imageURL']); ?>');">
                                    <?php else: ?>
                                        <div class="bg-gray-200 d-flex align-items-center justify-content-center" 
                                             style="width: 80px; height: 60px; border-radius: 4px;">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($image['tour_title'] ?? 'N/A'); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($image['description'] ?? '-'); ?>
                                </td>
                                <td class="table-actions">
                                    <button type="button" class="btn btn-sm btn-info" 
                                            onclick="viewImage('<?php echo htmlspecialchars($image['imageURL'] ?? ''); ?>', '<?php echo htmlspecialchars($image['tour_title'] ?? ''); ?>')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" 
                                            onclick="confirmDelete('index.php?controller=image&action=delete&id=<?php echo $image['imageID']; ?>', 'image')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <nav aria-label="Page navigation" class="mt-3">
                    <ul class="pagination justify-content-center">
                        <?php if ($currentPage > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?controller=image&page=<?php echo $currentPage - 1; ?>">Previous</a>
                            </li>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                                <a class="page-link" href="index.php?controller=image&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php if ($currentPage < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?controller=image&page=<?php echo $currentPage + 1; ?>">Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Image Preview</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="previewImage" src="" alt="Preview" style="max-width: 100%; max-height: 500px;">
                <p id="tourName" class="mt-3 font-weight-bold"></p>
            </div>
        </div>
    </div>
</div>

<script>
function viewImage(imageUrl, tourName) {
    if (imageUrl) {
        // Try the same path logic as in the table
        document.getElementById('previewImage').src = '../' + imageUrl;
        document.getElementById('previewImage').onerror = function() {
            this.src = 'assets/img/no-image.png';
        };
    } else {
        document.getElementById('previewImage').src = 'assets/img/no-image.png';
    }
    document.getElementById('tourName').textContent = tourName || 'Unknown Tour';
    $('#imagePreviewModal').modal('show');
}
</script>

<?php 
$content = ob_get_clean(); 
require_once __DIR__ . '/../layouts/admin.php'; 
?>
