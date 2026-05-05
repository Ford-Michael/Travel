<?php
/**
 * Đặt Xe / Car Rental
 * Nhúng trang GreenSM
 * Travel Bling User Site
 */
?>

<style>
    .embed-container {
        width: 100%;
        height: calc(100vh - 140px);
        min-height: 700px;
        border: none;
        display: block;
    }
    .embed-header {
        background: linear-gradient(135deg, #00337c 0%, #2b5bb5 100%);
    }
</style>

<!-- Header Bar -->
<section class="embed-header py-6">
    <div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-2xl" style="font-variation-settings:'FILL' 1">directions_car</span>
            </div>
            <div>
                <h1 class="text-white font-headline font-extrabold text-2xl tracking-tight">Đặt Xe & Thuê Xe</h1>
                <p class="text-white/70 text-sm">Đặt xe trực tiếp qua GreenSM — Đối tác vận chuyển</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-white/60 text-xs uppercase tracking-wider font-bold hidden md:block">Powered by</span>
            <span class="bg-white/10 backdrop-blur-md text-white px-4 py-2 rounded-lg text-sm font-bold">GreenSM</span>
            <a href="https://www.greensm.com/vn-vi" target="_blank" rel="noopener"
                class="bg-on-primary-container text-white px-5 py-2 rounded-lg text-sm font-bold hover:brightness-110 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">open_in_new</span>
                Mở Tab Mới
            </a>
        </div>
    </div>
</section>

<!-- Embedded iframe -->
<iframe
    src="https://www.greensm.com/vn-vi"
    class="embed-container"
    title="GreenSM - Đặt Xe Du Lịch"
    loading="lazy"
    sandbox="allow-scripts allow-same-origin allow-forms allow-popups allow-popups-to-escape-sandbox"
    referrerpolicy="no-referrer"
    allowfullscreen>
</iframe>

<!-- Fallback Notice -->
<div class="bg-surface-container-low py-6 text-center" id="embed-fallback" style="display:none;">
    <div class="max-w-3xl mx-auto px-8">
        <div class="bg-white rounded-2xl p-8 shadow-md">
            <span class="material-symbols-outlined text-secondary text-4xl mb-4">info</span>
            <h3 class="font-headline font-bold text-on-secondary-container text-xl mb-3">Không thể hiển thị trang web nhúng</h3>
            <p class="text-on-surface-variant mb-6">Trang GreenSM có thể không cho phép nhúng trực tiếp. Vui lòng truy cập trực tiếp:</p>
            <a href="https://www.greensm.com/vn-vi" target="_blank" rel="noopener"
                class="bg-on-primary-container text-white px-8 py-4 rounded-lg font-bold text-lg hover:brightness-110 transition-all inline-flex items-center gap-2">
                <span class="material-symbols-outlined">directions_car</span>
                Truy Cập GreenSM
            </a>
        </div>
    </div>
</div>

<script>
(function() {
    var iframe = document.querySelector('.embed-container');
    if (iframe) {
        iframe.addEventListener('error', function() {
            iframe.style.display = 'none';
            document.getElementById('embed-fallback').style.display = 'block';
        });
        // Check if iframe loaded after a timeout
        setTimeout(function() {
            try {
                var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                if (!iframeDoc || iframeDoc.body.innerHTML === '') {
                    iframe.style.display = 'none';
                    document.getElementById('embed-fallback').style.display = 'block';
                }
            } catch(e) {
                // Cross-origin - iframe loaded but we can't access, that's fine
            }
        }, 5000);
    }
})();
</script>
