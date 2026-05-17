<?php
/**
 * Tour Itinerary Management View
 * Lịch trình tour
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-route mr-2"></i>Lịch Trình Tour
    </h1>
    <div>
        <a href="index.php?controller=tour&action=show&id=<?php echo $tour['tourID']; ?>" class="btn btn-info btn-sm shadow-sm">
            <i class="fas fa-eye mr-1"></i> View Tour
        </a>
        <a href="index.php?controller=tour" class="btn btn-secondary btn-sm shadow-sm ml-2">
            <i class="fas fa-arrow-left mr-1"></i> Back to List
        </a>
    </div>
</div>

<!-- Tour Info Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-primary text-white">
        <h6 class="m-0 font-weight-bold">
            <i class="fas fa-map-marked-alt mr-2"></i><?php echo htmlspecialchars($tour['title']); ?>
        </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <strong><i class="fas fa-map-marker-alt text-danger mr-2"></i>Destination:</strong>
                <?php echo htmlspecialchars($tour['destination']); ?>
            </div>
            <div class="col-md-4">
                <strong><i class="fas fa-clock text-info mr-2"></i>Duration:</strong>
                <?php echo htmlspecialchars($tour['duration'] ?? 'N/A'); ?>
            </div>
            <div class="col-md-4">
                <strong><i class="fas fa-calendar text-success mr-2"></i>Itinerary Days:</strong>
                <?php echo count($itineraryByDay); ?> days
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Add New Itinerary -->
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-success text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-plus mr-2"></i>Thêm Lịch Trình
                </h6>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?controller=tour&action=add-itinerary" enctype="multipart/form-data">
                    <input type="hidden" name="tourID" value="<?php echo $tour['tourID']; ?>">
                    
                    <div class="form-group">
                        <label for="dayNumber"><i class="fas fa-calendar-day mr-1"></i> Ngày <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="dayNumber" name="dayNumber" 
                               min="1" value="1" required>
                        <small class="text-muted">Ngày thứ mấy trong tour</small>
                    </div>

                    <div class="form-group">
                        <label for="title"><i class="fas fa-heading mr-1"></i> Tieu de <small class="text-muted">(khong bat buoc)</small></label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Co the de trong, he thong se tu dat ten theo ngay">
                    </div>

                    <div class="form-group">
                        <label for="description"><i class="fas fa-align-left mr-1"></i> Noi dung chi tiet (text)</label>
                        <textarea class="form-control" id="description" name="description" rows="6"
                                  placeholder="Viet noi dung tu do...&#10;VD:&#10;- Don khach va di chuyen den diem tham quan&#10;- Tham quan khu vuc noi bat&#10;- Nghi trua / dung bua trua&#10;- Hoat dong buoi chieu&#10;- Ve khach san"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="itineraryImage"><i class="fas fa-image mr-1"></i> Hình ảnh minh họa (Không bắt buộc)</label>
                        <input type="file" class="form-control-file border p-1 rounded" id="itineraryImage" name="itineraryImage" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-plus mr-1"></i> Thêm Lịch Trình
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Itinerary List -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-list mr-2"></i>Chi Tiết Lịch Trình
                </h6>
            </div>
            <div class="card-body">
                <?php if (empty($itineraryByDay)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-route fa-4x text-gray-300 mb-3"></i>
                    <h5 class="text-gray-500">Chưa có lịch trình</h5>
                    <p class="text-muted">Thêm lịch trình chi tiết cho từng ngày của tour</p>
                </div>
                <?php else: ?>
                
                <?php foreach ($itineraryByDay as $day => $items): ?>
                <div class="day-section mb-4">
                    <div class="day-header bg-light p-3 rounded mb-3">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-calendar-day mr-2"></i>
                            Ngày <?php echo $day; ?>
                            <span class="badge badge-primary ml-2"><?php echo count($items); ?> hoạt động</span>
                        </h5>
                    </div>
                    
                    <div class="timeline">
                        <?php foreach ($items as $item): ?>
                        <div class="timeline-item card mb-3 border-left-primary">
                            <div class="card-body py-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="font-weight-bold text-dark mb-2">
                                            <?php echo htmlspecialchars($item['title']); ?>
                                        </h6>
                                        
                                        <?php if ($item['description']): ?>
                                        <div class="text-gray-600 small" style="white-space: pre-line;">
                                            <?php echo htmlspecialchars($item['description']); ?>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($item['displayImageURL'] ?? $item['imageURL'])): ?>
                                        <div class="mt-3">
                                            <img src="<?php echo htmlspecialchars($item['displayImageURL'] ?? $item['imageURL']); ?>" class="img-fluid rounded shadow-sm" style="max-height: 150px; object-fit: cover;" alt="Itinerary Image">
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-warning" 
                                                onclick="editItinerary(<?php echo $item['itineraryID']; ?>)"
                                                data-toggle="modal" data-target="#editModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="index.php?controller=tour&action=delete-itinerary&id=<?php echo $item['itineraryID']; ?>&tourId=<?php echo $tour['tourID']; ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Xác nhận xóa lịch trình này?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="index.php?controller=tour&action=update-itinerary-item" enctype="multipart/form-data">
                <input type="hidden" name="tourID" value="<?php echo $tour['tourID']; ?>">
                <input type="hidden" name="itineraryID" id="editItineraryID">
                
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-dark">
                        <i class="fas fa-edit mr-2"></i>Sửa Lịch Trình
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Ngày <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="dayNumber" id="editDayNumber" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" id="editTitle" placeholder="Co the de trong, he thong se tu dat ten theo ngay">
                    </div>
                    <div class="form-group">
                        <label>Nội dung chi tiết</label>
                        <textarea class="form-control" name="description" id="editDescription" rows="6"
                                  placeholder="Viet noi dung tu do...&#10;VD:&#10;- Don khach va di chuyen den diem tham quan&#10;- Tham quan khu vuc noi bat&#10;- Nghi trua / dung bua trua&#10;- Hoat dong buoi chieu&#10;- Ve khach san"></textarea>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-image mr-1"></i> Đổi hình ảnh (Để trống nếu giữ nguyên)</label>
                        <input type="file" class="form-control-file border p-1 rounded" name="itineraryImage" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i>Lưu Thay Đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.timeline-item {
    position: relative;
    transition: all 0.3s ease;
}
.timeline-item:hover {
    transform: translateX(5px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15) !important;
}
.border-left-primary {
    border-left: 4px solid #4e73df !important;
}
.day-header {
    border-left: 4px solid #4e73df;
}
</style>

<script>
function editItinerary(id) {
    fetch('index.php?controller=tour&action=edit-itinerary&id=' + id)
        .then(response => response.json())
        .then(data => {
            if (!data.error) {
                document.getElementById('editItineraryID').value = data.itineraryID;
                document.getElementById('editDayNumber').value = data.dayNumber;
                document.getElementById('editTitle').value = data.title;
                document.getElementById('editDescription').value = data.description || '';
            }
        })
        .catch(error => console.error('Error:', error));
}
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
