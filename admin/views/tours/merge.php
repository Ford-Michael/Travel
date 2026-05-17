<?php
/**
 * Merge Tour View
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Gộp Tour</h1>
    <a href="index.php?controller=tour" class="btn btn-secondary btn-sm shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Quay lại
    </a>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-object-group mr-2"></i>Tính năng Gộp Tour
                </h6>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <h5><i class="fas fa-exclamation-triangle mr-2"></i>Lưu ý quan trọng:</h5>
                    <p class="mb-0">
                        Khi bạn gộp <strong>Tour phụ</strong> vào <strong>Tour chính</strong>:
                    </p>
                    <ul class="mb-0 mt-2">
                        <li>Tất cả Bookings, Đánh giá, Hình ảnh phụ của <strong>Tour phụ</strong> sẽ được chuyển sang <strong>Tour chính</strong>.</li>
                        <li><strong>Tour phụ</strong> sẽ bị đổi tên (đánh dấu đã gộp) và tự động vô hiệu hóa (không hiển thị nữa).</li>
                        <li>Hành động này <strong>không thể hoàn tác</strong> dễ dàng. Hãy kiểm tra thật kỹ trước khi Gộp.</li>
                    </ul>
                </div>

                <form action="index.php?controller=tour&action=processMerge" method="POST">
                    <div class="form-group">
                        <label class="font-weight-bold text-primary">Tour Chính (Giữ lại)</label>
                        <select name="primaryTourID" class="form-control select2" required>
                            <option value="">-- Chọn Tour Chính --</option>
                            <?php foreach ($tours as $t): ?>
                                <?php if ($t['availability']): ?>
                                    <option value="<?php echo $t['tourID']; ?>">
                                        #<?php echo $t['tourID']; ?> - <?php echo htmlspecialchars($t['title']); ?> (<?php echo number_format($t['priceAdult']); ?> đ)
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Đây là tour sẽ nhận tất cả dữ liệu và tiếp tục hiển thị trên website.</small>
                    </div>

                    <div class="text-center my-4">
                        <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
                        <i class="fas fa-plus fa-2x text-primary mx-3"></i>
                        <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-danger">Tour Phụ (Bị gộp & Tắt đi)</label>
                        <select name="secondaryTourID" class="form-control select2" required>
                            <option value="">-- Chọn Tour Phụ --</option>
                            <?php foreach ($tours as $t): ?>
                                <option value="<?php echo $t['tourID']; ?>">
                                    #<?php echo $t['tourID']; ?> - <?php echo htmlspecialchars($t['title']); ?> (<?php echo number_format($t['priceAdult']); ?> đ)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Tour này sẽ chuyển hết dữ liệu cho tour chính và sau đó tự động ẩn khỏi hệ thống.</small>
                    </div>

                    <hr class="mt-5 mb-4">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow" onclick="return confirm('Bạn có chắc chắn muốn gộp 2 tour này không? Việc này không thể phục hồi dữ liệu hoàn toàn về như cũ!');">
                            <i class="fas fa-object-group mr-2"></i>Thực Hiện Gộp Tour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Nếu có thư viện select2 (vì select tour có thể rất dài), ta có thể áp dụng
    if(typeof jQuery !== 'undefined' && $.fn.select2) {
        $('.select2').select2({
            theme: 'bootstrap4'
        });
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
