<?php
/**
 * Tour Detail View
 */
ob_start();
$primaryImageUrl = $tour['displayImageURL'] ?? ($tour['imageURL'] ?? null);
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-map-marked-alt mr-2"></i>Tour Details
    </h1>
    <div>
        <a href="index.php?controller=tour&action=edit&id=<?php echo $tour['tourID']; ?>" class="btn btn-warning btn-sm shadow-sm">
            <i class="fas fa-edit mr-1"></i> Edit Tour
        </a>
        <a href="index.php?controller=tour" class="btn btn-secondary btn-sm shadow-sm ml-2">
            <i class="fas fa-arrow-left mr-1"></i> Back to List
        </a>
    </div>
</div>

<div class="row">
    <!-- Tour Information -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle mr-2"></i><?php echo htmlspecialchars($tour['title']); ?>
                </h6>
                <?php if ($tour['availability']): ?>
                    <span class="badge badge-success">Available</span>
                <?php else: ?>
                    <span class="badge badge-secondary">Unavailable</span>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <!-- Description -->
                <div class="mb-4">
                    <h6 class="font-weight-bold text-dark">Description</h6>
                    <p class="text-gray-700">
                        <?php echo nl2br(htmlspecialchars($tour['description'] ?? 'No description available.')); ?>
                    </p>
                </div>
                
                <!-- Tour Details Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%" class="bg-light">Tour ID</th>
                            <td><strong>#<?php echo $tour['tourID']; ?></strong></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Destination</th>
                            <td>
                                <i class="fas fa-map-marker-alt text-danger mr-2"></i>
                                <?php echo htmlspecialchars($tour['destination']); ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Duration</th>
                            <td>
                                <i class="fas fa-clock text-info mr-2"></i>
                                <?php echo htmlspecialchars($tour['duration'] ?? 'N/A'); ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Departure Date</th>
                            <td>
                                <i class="fas fa-calendar-alt text-warning mr-2"></i>
                                <?php echo !empty($tour['departureDate']) ? date('d/m/Y', strtotime($tour['departureDate'])) : 'Not Scheduled'; ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Available Quantity</th>
                            <td>
                                <i class="fas fa-users text-primary mr-2"></i>
                                <?php echo number_format($tour['quantity']); ?> slots
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Main Image -->
        <div class="card shadow mb-4 border-bottom-warning">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-warning">
                    <i class="fas fa-image mr-2"></i>Ảnh Đại Diện (Main Image)
                </h6>
            </div>
            <div class="card-body text-center">
                <?php if (!empty($primaryImageUrl)): ?>
                    <img src="<?php echo htmlspecialchars($primaryImageUrl); ?>" class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: cover;" alt="Main Tour Image">
                    <p class="text-muted small mb-0 mt-3">
                        Ảnh này là ảnh đại diện. Ảnh phụ sẽ hiển thị riêng ở phần gallery bên dưới.
                    </p>
                <?php else: ?>
                    <p class="text-muted mb-0">No main image set.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tour Images -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-images mr-2"></i>Ảnh Phụ (Gallery Images)
                </h6>
            </div>
            <div class="card-body">
                <?php if (!empty($tour['images'])): ?>
                <div class="row">
                    <?php foreach ($tour['images'] as $image): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <img src="<?php echo htmlspecialchars($image['displayImageURL'] ?? $image['imageURL']); ?>" 
                                 class="card-img-top" alt="Tour Image"
                                 style="height: 200px; object-fit: cover;">
                            <?php if ($image['description']): ?>
                            <div class="card-body p-2">
                                <small class="text-muted"><?php echo htmlspecialchars($image['description']); ?></small>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="text-center py-4">
                    <i class="fas fa-image fa-3x text-gray-300 mb-3"></i>
                    <p class="text-gray-500 mb-2">Tour này hiện chưa có ảnh phụ.</p>
                    <?php if (!empty($primaryImageUrl)): ?>
                    <p class="text-muted small mb-3">Ảnh đại diện phía trên không tự động tính là ảnh phụ.</p>
                    <?php endif; ?>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addImageModal">
                        <i class="fas fa-plus mr-1"></i>Thêm ảnh phụ
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Itinerary Preview -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-route mr-2"></i>Tour Itinerary
                </h6>
                <a href="index.php?controller=tour&action=itinerary&id=<?php echo $tour['tourID']; ?>" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-edit"></i> Manage Itinerary
                </a>
            </div>
            <div class="card-body">
                <?php $itineraries = $tour['itinerary'] ?? []; ?>
                <?php if (!empty($itineraries)): ?>
                    <div class="timeline border-left ml-3 pl-3" style="border-left: 2px solid #4e73df;">
                        <?php foreach($itineraries as $item): ?>
                        <div class="timeline-item mb-4 position-relative">
                            <h6 class="font-weight-bold text-primary mb-1">
                                Day <?php echo htmlspecialchars($item['dayNumber']); ?> - <?php echo htmlspecialchars($item['title']); ?>
                            </h6>
                            <p class="mb-2 text-gray-700"><?php echo nl2br(htmlspecialchars($item['description'])); ?></p>
                            <?php if(!empty($item['displayImageURL'] ?? $item['imageURL'])): ?>
                            <img src="<?php echo htmlspecialchars($item['displayImageURL'] ?? $item['imageURL']); ?>" alt="Itinerary Image" class="img-fluid rounded mt-2 shadow-sm" style="max-height: 200px; object-fit: cover;">
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center mb-0 border-dashed p-4 rounded bg-light">No itinerary available for this tour.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Pricing & Actions Sidebar -->
    <div class="col-lg-4">
        <!-- Pricing Card -->
        <div class="card shadow mb-4 border-left-success">
            <div class="card-header py-3 bg-success text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-tag mr-2"></i>Pricing
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <div class="text-xs font-weight-bold text-uppercase mb-1 text-gray-600">Adult Price</div>
                    <div class="h4 mb-0 font-weight-bold text-success">
                        <?php echo number_format($tour['priceAdult'], 0, ',', '.'); ?> VNĐ
                    </div>
                </div>
                <div class="mb-0">
                    <div class="text-xs font-weight-bold text-uppercase mb-1 text-gray-600">Child Price</div>
                    <div class="h4 mb-0 font-weight-bold text-info">
                        <?php echo number_format($tour['priceChild'], 0, ',', '.'); ?> VNĐ
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-bolt mr-2"></i>Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <a href="index.php?controller=tour&action=edit&id=<?php echo $tour['tourID']; ?>" 
                   class="btn btn-warning btn-block mb-2">
                    <i class="fas fa-edit mr-2"></i>Edit Tour
                </a>
                <a href="index.php?controller=tour&action=itinerary&id=<?php echo $tour['tourID']; ?>" 
                   class="btn btn-info btn-block mb-2">
                    <i class="fas fa-route mr-2"></i>Lịch Trình
                </a>
                <a href="index.php?controller=tour&action=toggleAvailability&id=<?php echo $tour['tourID']; ?>" 
                   class="btn btn-<?php echo $tour['availability'] ? 'secondary' : 'success'; ?> btn-block mb-2">
                    <i class="fas fa-toggle-<?php echo $tour['availability'] ? 'off' : 'on'; ?> mr-2"></i>
                    <?php echo $tour['availability'] ? 'Mark Unavailable' : 'Mark Available'; ?>
                </a>
                <hr>
                <a href="#" onclick="confirmDelete('index.php?controller=tour&action=delete&id=<?php echo $tour['tourID']; ?>', 'tour')" 
                   class="btn btn-outline-danger btn-block">
                    <i class="fas fa-trash mr-2"></i>Delete Tour
                </a>
            </div>
        </div>
        
        <!-- Tour Statistics -->
        <div class="card shadow mb-4 border-left-info">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">
                    <i class="fas fa-chart-bar mr-2"></i>Statistics
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 border-right">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo number_format($tour['bookingCount'] ?? 0); ?>
                        </div>
                        <small class="text-gray-500">Bookings</small>
                    </div>
                    <div class="col-6">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo number_format($tour['reviewCount'] ?? 0); ?>
                        </div>
                        <small class="text-gray-500">Reviews</small>
                    </div>
                </div>
                <?php if (($tour['avgRating'] ?? 0) > 0): ?>
                <hr>
                <div class="text-center">
                    <div class="h5 mb-0 text-warning">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star<?php echo $i <= round($tour['avgRating']) ? '' : '-o text-gray-300'; ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <small class="text-gray-500"><?php echo $tour['avgRating']; ?> / 5 rating</small>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Quantity Update -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-cubes mr-2"></i>Update Quantity
                </h6>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?controller=tour&action=updateQuantity">
                    <input type="hidden" name="tourID" value="<?php echo $tour['tourID']; ?>">
                    <div class="input-group">
                        <input type="number" class="form-control" name="quantity" 
                               value="<?php echo $tour['quantity']; ?>" min="0">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Image Management Section -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-images mr-2"></i>Manage Secondary Images / Ảnh Phụ
        </h6>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addImageModal">
            <i class="fas fa-plus mr-1"></i>Add Image
        </button>
    </div>
    <div class="card-body">
        <?php if (!empty($tour['images'])): ?>
        <div class="row">
            <?php foreach ($tour['images'] as $image): ?>
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <img src="<?php echo htmlspecialchars($image['displayImageURL'] ?? $image['imageURL']); ?>" 
                         class="card-img-top" alt="Tour Image"
                         style="height: 150px; object-fit: cover;">
                    <div class="card-body p-2">
                        <small class="text-muted d-block mb-2">
                            <?php echo htmlspecialchars($image['description'] ?? 'No description'); ?>
                        </small>
                        <a href="index.php?controller=tour&action=removeImage&imageId=<?php echo $image['imageID']; ?>&tourId=<?php echo $tour['tourID']; ?>" 
                           class="btn btn-danger btn-sm btn-block"
                           onclick="return confirm('Are you sure you want to delete this image?')">
                            <i class="fas fa-trash mr-1"></i>Delete
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-4">
            <i class="fas fa-image fa-3x text-gray-300 mb-3"></i>
            <p class="text-gray-500 mb-2">Chưa có ảnh phụ nào cho tour này.</p>
            <?php if (!empty($primaryImageUrl)): ?>
            <p class="text-muted small mb-3">Hiện tại tour chỉ có ảnh đại diện. Hãy thêm ảnh phụ để gallery hiển thị ở đây.</p>
            <?php endif; ?>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addImageModal">
                <i class="fas fa-plus mr-1"></i>Add First Image
            </button>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Images Modal (up to 10 at once) -->
<div class="modal fade" id="addImageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="index.php?controller=tour&action=addImage" enctype="multipart/form-data">
                <input type="hidden" name="tourID" value="<?php echo $tour['tourID']; ?>">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-images mr-2"></i>Add Images to Tour
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Upload Option Tabs -->
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#uploadTab">
                                <i class="fas fa-upload mr-1"></i>Upload Files
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#urlTab">
                                <i class="fas fa-link mr-1"></i>Image URL
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Upload File Tab -->
                        <div class="tab-pane fade show active" id="uploadTab">
                            <!-- Count badge -->
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <small class="text-muted">Select up to 10 images at once</small>
                                <span id="modalImgBadge" class="badge badge-info">0 / 10 selected</span>
                            </div>

                            <!-- Drop Zone -->
                            <div id="modalDropZone"
                                 class="rounded p-4 text-center mb-3"
                                 style="border: 2px dashed #4e73df; cursor:pointer; transition: background .2s;"
                                 onclick="document.getElementById('tourImagesModal').click()"
                                 ondragover="event.preventDefault(); this.style.background='#eef0ff';"
                                 ondragleave="this.style.background='';"
                                 ondrop="handleModalDrop(event)">
                                <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                                <p class="mb-1 text-primary font-weight-bold">Click or drag &amp; drop images here</p>
                                <small class="text-muted">JPG, PNG, GIF, WEBP &bull; Max 5MB each &bull; Up to 10 images</small>
                                <input type="file" id="tourImagesModal" name="tourImagesFile[]" multiple
                                       accept="image/jpeg,image/png,image/gif,image/webp"
                                       style="display:none;"
                                       onchange="handleModalFileSelect(this.files)">
                            </div>

                            <!-- Preview Grid -->
                            <div id="modalImgGrid" class="row" style="gap:0;"></div>
                        </div>

                        <!-- URL Tab -->
                        <div class="tab-pane fade" id="urlTab">
                            <div class="form-group">
                                <label for="imageURL">Image URL</label>
                                <input type="url" class="form-control" id="imageURL" name="imageURL"
                                       placeholder="https://example.com/image.jpg">
                                <small class="form-text text-muted">Enter the full URL of the image</small>
                            </div>
                            <div class="form-group">
                                <label for="urlDescription">Description (optional)</label>
                                <input type="text" class="form-control" id="urlDescription" name="description"
                                       placeholder="e.g., Beautiful sunset view">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i>Add Images
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// ─── Multi-image upload for View/Manage Tour Images ───────────────────────────
const MODAL_MAX = 10;
let modalFiles = [];

function modalSyncInput() {
    const dt = new DataTransfer();
    modalFiles.forEach(f => dt.items.add(f));
    document.getElementById('tourImagesModal').files = dt.files;
    document.getElementById('modalImgBadge').textContent = modalFiles.length + ' / ' + MODAL_MAX + ' selected';
    document.getElementById('modalImgBadge').className = modalFiles.length >= MODAL_MAX
        ? 'badge badge-warning' : 'badge badge-info';
}

function modalRenderPreviews() {
    const grid = document.getElementById('modalImgGrid');
    grid.innerHTML = '';
    modalFiles.forEach(function(file, idx) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-6 col-md-4 col-lg-3 mb-3';
            col.innerHTML = `
                <div class="card h-100 shadow-sm" style="position:relative;">
                    <img src="${e.target.result}" class="card-img-top"
                         style="height:100px;object-fit:cover;border-radius:4px 4px 0 0;" alt="preview">
                    <div class="card-body p-1">
                        <small class="text-muted d-block text-truncate" title="${file.name}">${file.name}</small>
                        <small class="text-muted">${(file.size/1024).toFixed(0)} KB</small>
                    </div>
                    <button type="button" onclick="modalRemoveFile(${idx})"
                            class="btn btn-danger btn-sm"
                            style="position:absolute;top:4px;right:4px;padding:1px 6px;font-size:11px;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>`;
            grid.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
}

function handleModalFileSelect(files) {
    const incoming = Array.from(files);
    incoming.forEach(function(f) {
        if (modalFiles.length >= MODAL_MAX) return;
        if (!f.type.match(/^image\//)) return;
        if (f.size > 5 * 1024 * 1024) { alert(f.name + ' exceeds 5MB limit.'); return; }
        modalFiles.push(f);
    });
    modalSyncInput();
    modalRenderPreviews();
}

function modalRemoveFile(idx) {
    modalFiles.splice(idx, 1);
    modalSyncInput();
    modalRenderPreviews();
}

function handleModalDrop(event) {
    event.preventDefault();
    document.getElementById('modalDropZone').style.background = '';
    handleModalFileSelect(event.dataTransfer.files);
}

// Reset modal state on close
document.getElementById('addImageModal').addEventListener('hidden.bs.modal', function() {
    modalFiles = [];
    modalSyncInput();
    modalRenderPreviews();
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>

