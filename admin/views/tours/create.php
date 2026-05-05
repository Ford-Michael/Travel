<?php
/**
 * Create Tour View
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add New Tour</h1>
    <a href="index.php?controller=tour" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Back to Tours
    </a>
</div>

<!-- Create Form -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-plus mr-2"></i>Tour Details
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?controller=tour&action=store" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">Tour Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required
                               placeholder="Enter tour title">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="destination">Destination <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="destination" name="destination" required
                               placeholder="e.g., Paris, France">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"
                          placeholder="Enter tour description"></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="priceAdult">Adult Price ($) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="priceAdult" name="priceAdult" 
                               step="0.01" min="0" required placeholder="0.00">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="priceChild">Child Price ($) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="priceChild" name="priceChild" 
                               step="0.01" min="0" required placeholder="0.00">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="numDays">Number of Days <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="numDays" name="numDays" 
                                   min="1" max="30" value="1" required>
                            <div class="input-group-append">
                                <span class="input-group-text">days</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="quantity">Available Spots</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" 
                               min="0" value="0">
                    </div>
                </div>
            </div>
            
            <!-- Dynamic Itinerary Section -->
            <div class="card border-primary mb-3">
                <div class="card-header py-2 bg-primary text-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-route mr-2"></i>Tour Itinerary / Lịch Trình
                    </h6>
                    <button type="button" class="btn btn-sm btn-light" onclick="generateItinerary()">
                        <i class="fas fa-sync-alt mr-1"></i>Generate Days
                    </button>
                </div>
                <div class="card-body py-3">
                    <div class="alert alert-info mb-3">
                        <i class="fas fa-info-circle mr-2"></i>
                        Nhập số ngày và bấm "Generate Days". Bạn có thể sửa tiêu đề và nội dung từng ngày trực tiếp.
                    </div>
                    <div id="itineraryContainer">
                        <!-- Dynamic itinerary textareas will appear here -->
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="departureDate">Departure Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="departureDate" name="departureDate" required>
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center">
                    <div class="form-group mb-0">
                        <div class="custom-control custom-switch mt-4">
                            <input type="checkbox" class="custom-control-input" id="availability" name="availability" checked>
                            <label class="custom-control-label" for="availability">Tour is Available</label>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            
            <!-- Main Image Upload -->
            <div class="card bg-light mb-4 border-left-warning">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-warning">
                        <i class="fas fa-image mr-2"></i>Ảnh đại diện (Main Image) <span class="text-danger">*</span>
                    </h6>
                </div>
                <div class="card-body py-3">
                    <div class="form-group mb-0">
                        <input type="file" class="form-control-file border p-2 rounded bg-white" id="mainImage" name="mainImage" accept="image/*" required>
                    </div>
                </div>
            </div>
            
            <!-- Multi-Image Upload Section -->
            <div class="card bg-light mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-images mr-2"></i>Ảnh phụ / Không gian Tour <small class="text-muted font-weight-normal">(Tùy chọn &mdash; tối đa 10 ảnh)</small>
                    </h6>
                    <span id="imgCountBadge" class="badge badge-info">0 / 10 selected</span>
                </div>
                <div class="card-body">
                    <!-- Drop Zone -->
                    <div id="tourImgDropZone" class="border-2 border-dashed rounded p-4 text-center mb-3"
                         style="border: 2px dashed #4e73df; cursor: pointer; transition: background .2s;"
                         onclick="document.getElementById('tourImages').click()"
                         ondragover="event.preventDefault(); this.style.background='#eef0ff';"
                         ondragleave="this.style.background='';"
                         ondrop="handleDrop(event)">
                        <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                        <p class="mb-1 text-primary font-weight-bold">Click or drag &amp; drop images here</p>
                        <small class="text-muted">JPG, PNG, GIF, WEBP &bull; Max 5MB each &bull; Up to 10 images</small>
                        <input type="file" id="tourImages" name="tourImages[]" multiple
                               accept="image/jpeg,image/png,image/gif,image/webp"
                               style="display:none;" onchange="handleFileSelect(this.files)">
                    </div>

                    <!-- Preview Grid -->
                    <div id="imgPreviewGrid" class="row" style="gap:0;"></div>
                </div>
            </div>
            
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Create Tour
                </button>
                <a href="index.php?controller=tour" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<style>
.itinerary-day-prompt {
    cursor: text;
}

.itinerary-day-input {
    min-height: 140px;
    resize: vertical;
}
</style>

<script>
// ─── Multi-image upload for Create Tour ───────────────────────────────────────
const MAX_IMAGES = 10;
let selectedFiles = []; // DataTransfer list

function syncFileInput() {
    const dt = new DataTransfer();
    selectedFiles.forEach(f => dt.items.add(f));
    document.getElementById('tourImages').files = dt.files;
    document.getElementById('imgCountBadge').textContent = selectedFiles.length + ' / ' + MAX_IMAGES + ' selected';
    document.getElementById('imgCountBadge').className = selectedFiles.length >= MAX_IMAGES
        ? 'badge badge-warning' : 'badge badge-info';
}

function renderPreviews() {
    const grid = document.getElementById('imgPreviewGrid');
    grid.innerHTML = '';
    selectedFiles.forEach(function(file, idx) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-6 col-md-3 col-lg-2 mb-3';
            col.innerHTML = `
                <div class="card h-100 shadow-sm" style="position:relative;">
                    <img src="${e.target.result}" class="card-img-top"
                         style="height:110px;object-fit:cover;border-radius:4px 4px 0 0;" alt="preview">
                    <div class="card-body p-1">
                        <small class="text-muted d-block text-truncate" title="${file.name}">${file.name}</small>
                        <small class="text-muted">${(file.size/1024).toFixed(0)} KB</small>
                    </div>
                    <button type="button" onclick="removeFile(${idx})"
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

function handleFileSelect(files) {
    const incoming = Array.from(files);
    incoming.forEach(function(f) {
        if (selectedFiles.length >= MAX_IMAGES) return;
        if (!f.type.match(/^image\//)) return;
        if (f.size > 5 * 1024 * 1024) { alert(f.name + ' exceeds 5MB limit.'); return; }
        selectedFiles.push(f);
    });
    syncFileInput();
    renderPreviews();
}

function removeFile(idx) {
    selectedFiles.splice(idx, 1);
    syncFileInput();
    renderPreviews();
}

function handleDrop(event) {
    event.preventDefault();
    document.getElementById('tourImgDropZone').style.background = '';
    handleFileSelect(event.dataTransfer.files);
}

// Dynamic Itinerary Generation - Simple Text Format
function generateItinerary() {
    const numDays = parseInt(document.getElementById('numDays').value) || 1;
    const container = document.getElementById('itineraryContainer');

    // Preserve existing values so user can continue editing.
    const existing = {};
    container.querySelectorAll('[id^="itineraryDay"]').forEach(function(textarea) {
        const day = textarea.id.replace('itineraryDay', '');
        const titleInput = document.getElementById('itineraryTitle' + day);
        existing[day] = {
            title: titleInput ? titleInput.value : ('Ngày ' + day),
            description: textarea.value || ''
        };
    });

    let html = '';
    for (let day = 1; day <= numDays; day++) {
        const oldTitle = existing[day] ? existing[day].title : ('Ngày ' + day);
        const oldDescription = existing[day] ? existing[day].description : '';
        html += `
        <div class="card mb-3 border-left-primary itinerary-card" id="day${day}">
            <div class="card-header py-2 bg-light">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary itinerary-day-heading">
                        <i class="fas fa-calendar-day mr-2"></i>Ngày <span>${day}</span>
                    </h6>
                    <div class="d-flex align-items-center">
                        <label class="small mb-0 mr-2 text-muted">Số ngày</label>
                        <input type="number" min="1" class="form-control form-control-sm itinerary-day-number" style="width:90px"
                               name="itinerary[${day}][dayNumber]" value="${day}" onchange="sortItineraryCards()">
                    </div>
                </div>
            </div>
            <div class="card-body py-3">
                <div class="alert alert-light border mb-3 small text-muted itinerary-day-prompt"
                     onclick="focusItineraryDay(${day})">
                    Chỉnh tiêu đề và nội dung cho ngày ${day} theo lịch trình thực tế.
                </div>
                <div class="form-group">
                    <label class="small font-weight-bold text-primary" for="itineraryTitle${day}">Tiêu đề ngày ${day}</label>
                    <input type="text" class="form-control" id="itineraryTitle${day}" name="itinerary[${day}][title]"
                           value="${escapeHtml(oldTitle)}" placeholder="Ví dụ: Khởi hành - Tham quan trung tâm thành phố">
                </div>
                <div class="form-group mb-0">
                    <label class="sr-only" for="itineraryDay${day}">Nội dung lịch trình ngày ${day}</label>
                    <textarea class="form-control itinerary-day-input" id="itineraryDay${day}" name="itinerary[${day}][description]" rows="6"
                              placeholder="Viết nội dung cho ngày ${day}...&#10;Ví dụ:&#10;- Đón khách và di chuyển đến điểm tham quan&#10;- Tham quan các điểm nổi bật trong khu vực&#10;- Dùng bữa trưa và nghỉ ngơi&#10;- Tiếp tục vui chơi / khảo sát buổi chiều&#10;- Kết thúc ngày và về khách sạn">${escapeHtml(oldDescription)}</textarea>
                </div>
            </div>
        </div>
        `;
    }
    
    container.innerHTML = html;
    sortItineraryCards();
}

function focusItineraryDay(day) {
    const textarea = document.getElementById(`itineraryDay${day}`);
    if (textarea) {
        textarea.focus();
    }
}

function escapeHtml(value) {
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function sortItineraryCards() {
    const container = document.getElementById('itineraryContainer');
    const cards = Array.from(container.querySelectorAll('.itinerary-card'));
    cards.sort(function(a, b) {
        const aVal = parseInt(a.querySelector('.itinerary-day-number')?.value || '9999', 10);
        const bVal = parseInt(b.querySelector('.itinerary-day-number')?.value || '9999', 10);
        if (aVal === bVal) return 0;
        return aVal - bVal;
    });

    cards.forEach(function(card) {
        const dayVal = parseInt(card.querySelector('.itinerary-day-number')?.value || '', 10);
        const headingSpan = card.querySelector('.itinerary-day-heading span');
        if (headingSpan && Number.isFinite(dayVal) && dayVal > 0) {
            headingSpan.textContent = dayVal;
        }
        container.appendChild(card);
    });
}

// Auto-generate on page load and when days change
document.getElementById('numDays').addEventListener('change', function() {
    if (confirm('Tạo lại khung lịch trình theo số ngày mới? Dữ liệu đã nhập sẽ được giữ nếu còn cùng ngày.')) {
        generateItinerary();
    }
});

// Generate initial itinerary
generateItinerary();
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
