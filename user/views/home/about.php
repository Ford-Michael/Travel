<?php
// Rendered inside views/layouts/main.php — no <html>/<head>/<body> needed
?>

<style>
    .editorial-bleed { margin-right: -10vw; }
    .glass-badge {
        background: rgba(43, 91, 181, 0.4);
        backdrop-filter: blur(20px);
    }
</style>

<main>

    <!-- ============================================================
         1. Hero Section
    ============================================================ -->
    <section class="relative h-[819px] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover brightness-75 scale-105"
                 alt="Vịnh Hạ Long hoàng hôn vàng"
                 src="https://lh3.googleusercontent.com/aida-public/AB6AXuBC4Z3T5diiluVlyRC_Dp0caim5zQTepoLWHCHhgsnQjMG3VN1B_gjeqbrom9MLbLdz5Bs4H7SeZKPWAKusnoIJn5d6s14OAFszgbqVt7Ojfz9z-xMXFDt7Lgkj6S7dvM30gkBrjv9V84f0nKAZji0i54zow8myOZWrMz_npqhjlGeQU0_bATJ1J0_WOgbrkxRFw-7wRTJb8DF3wIcDtbnIuh1Be0HFdzbtIdnTHODhl46ZgAQM4nqvdA5wXzxA7XfH3pAjfBCbP04Q" />
            <div class="absolute inset-0 bg-gradient-to-r from-primary/60 to-transparent"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-8 w-full">
            <div class="max-w-2xl">
                <span class="inline-block py-1 px-3 glass-badge text-white text-xs font-bold tracking-widest uppercase mb-6 rounded-sm">
                    Kể từ năm 2004
                </span>
                <h1 class="font-headline text-5xl md:text-7xl font-bold text-white leading-none tracking-tight mb-6">
                    Về Chúng Tôi
                </h1>
                <p class="text-xl md:text-2xl text-white/90 font-light italic leading-relaxed tracking-wide">
                    Travel Bling — Hành trình của niềm tin
                </p>
                <!-- Logo Travel Bling trên hero -->
                <div class="mt-8">
                <img src="/travel.bling/img/travel-bling-logo-cropped.png"
                    alt="Travel Bling"
                         class="h-16 w-auto object-contain"
                         style="filter: brightness(10) saturate(0);" />
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         2. Company Overview
    ============================================================ -->
    <section class="py-24 bg-surface">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

            <div class="lg:col-span-6 order-2 lg:order-1">
                <h2 class="font-headline text-sm font-bold tracking-[0.2em] text-secondary uppercase mb-4">Di sản của chúng tôi</h2>
                <h3 class="font-headline text-4xl font-bold text-on-secondary-fixed leading-tight mb-8">
                    Hơn 20 Năm Kiến Tạo Những Ký Ức Vô Giá
                </h3>
                <div class="space-y-6 text-on-surface-variant text-lg leading-relaxed font-body">
                    <p>Được thành lập với khát khao kết nối con người với những vẻ đẹp tiềm ẩn của Đông Dương,
                        <strong class="text-on-secondary-fixed">Travel Bling</strong> đã vươn mình trở thành biểu tượng
                        của sự uy tín trong ngành lữ hành Việt Nam.</p>
                    <p>Với đội ngũ chuyên gia giàu kinh nghiệm, chúng tôi không chỉ bán những chuyến đi,
                        chúng tôi thiết kế những trải nghiệm mang đậm dấu ấn cá nhân. Mỗi hành trình là một câu chuyện
                        được kể bằng sự tận tâm và am hiểu văn hóa sâu sắc.</p>
                    <div class="pt-6 grid grid-cols-2 gap-8">
                        <div>
                            <div class="text-4xl font-headline font-black text-on-primary-container">20+</div>
                            <div class="text-sm font-bold uppercase tracking-widest text-outline">Năm kinh nghiệm</div>
                        </div>
                        <div>
                            <div class="text-4xl font-headline font-black text-on-primary-container">500k+</div>
                            <div class="text-sm font-bold uppercase tracking-widest text-outline">Khách hàng hài lòng</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-6 order-1 lg:order-2">
                <div class="relative group">
                    <div class="absolute -inset-4 bg-secondary-fixed/30 rounded-lg -rotate-2 transition-transform group-hover:rotate-0"></div>
                    <img class="relative rounded-lg shadow-xl w-full aspect-[4/3] object-cover"
                         alt="Đội ngũ Travel Bling"
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuCzt4W3gv1rF7vujlveN8gU3oBITvf9w22cUfC_3ON5eqW0f_fq09g4-lkGg-5gBFUbBjnhK_3tuWO8CaIEK3TN2exiiz5mOL1jijI0HaARnfYmNbV-ZmRA0wWYf3vtPzx3O9R0zyGUJYvKCy0BhZVfhvENVgu4uD1M4FBqYcN_rsDQKSDoz22MJ-4KqrFJAc6g2YLU9eyaaG827DJEP9G4C8nZt4h5nXsXHi6jPP88rqmk2n3taiud9LhyLh6O1aDWM45Y8nTXb0FC" />
                </div>
            </div>

        </div>
    </section>

    <!-- ============================================================
         3. Mission & Vision
    ============================================================ -->
    <section class="py-24 bg-surface-container-low overflow-hidden">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                <!-- Mission Card -->
                <div class="bg-surface-container-lowest p-12 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-outline-variant/10">
                    <div class="w-16 h-16 bg-primary-fixed flex items-center justify-center rounded-full mb-8">
                        <span class="material-symbols-outlined text-primary text-3xl">rocket_launch</span>
                    </div>
                    <h4 class="font-headline text-3xl font-bold text-on-secondary-fixed mb-6">Sứ mệnh</h4>
                    <p class="text-on-surface-variant text-lg leading-relaxed">
                        Cung cấp những trải nghiệm du lịch chất lượng cao, vượt xa mong đợi của khách hàng.
                        Chúng tôi cam kết bảo tồn các giá trị văn hóa bản địa và thúc đẩy du lịch bền vững
                        tại Việt Nam và khu vực.
                    </p>
                </div>

                <!-- Vision Card -->
                <div class="bg-secondary p-12 rounded-xl shadow-xl text-on-secondary relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 scale-150">
                        <span class="material-symbols-outlined text-[120px]" style="font-variation-settings: 'FILL' 1;">visibility</span>
                    </div>
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-md flex items-center justify-center rounded-full mb-8">
                        <span class="material-symbols-outlined text-white text-3xl">visibility</span>
                    </div>
                    <h4 class="font-headline text-3xl font-bold mb-6">Tầm nhìn</h4>
                    <p class="text-white/90 text-lg leading-relaxed">
                        Trở thành công ty lữ hành hàng đầu Việt Nam, tiên phong trong việc ứng dụng công nghệ
                        để cá nhân hóa hành trình và khẳng định vị thế của du lịch Việt trên bản đồ quốc tế.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================
         4. Core Values
    ============================================================ -->
    <section class="py-24 bg-surface">
        <div class="max-w-7xl mx-auto px-8 text-center mb-16">
            <h2 class="font-headline text-sm font-bold tracking-[0.2em] text-secondary uppercase mb-4">Giá trị cốt lõi</h2>
            <h3 class="font-headline text-4xl font-bold text-on-secondary-fixed">Kim Chỉ Nam Của Mọi Hành Động</h3>
        </div>
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            <div class="text-center p-8 hover:bg-surface-container-low transition-colors rounded-xl group">
                <div class="mb-6 inline-block p-4 bg-surface-container-highest rounded-full text-secondary group-hover:scale-110 duration-200">
                    <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">verified</span>
                </div>
                <h5 class="font-headline text-xl font-bold mb-3">Uy tín</h5>
                <p class="text-on-surface-variant text-sm">Chữ tín là vàng. Chúng tôi luôn thực hiện đúng cam kết với khách hàng.</p>
            </div>

            <div class="text-center p-8 hover:bg-surface-container-low transition-colors rounded-xl group">
                <div class="mb-6 inline-block p-4 bg-surface-container-highest rounded-full text-secondary group-hover:scale-110 duration-200">
                    <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">business_center</span>
                </div>
                <h5 class="font-headline text-xl font-bold mb-3">Chuyên nghiệp</h5>
                <p class="text-on-surface-variant text-sm">Đội ngũ am hiểu chuyên môn, quy trình vận hành tinh gọn và hiệu quả.</p>
            </div>

            <div class="text-center p-8 hover:bg-surface-container-low transition-colors rounded-xl group">
                <div class="mb-6 inline-block p-4 bg-surface-container-highest rounded-full text-secondary group-hover:scale-110 duration-200">
                    <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">volunteer_activism</span>
                </div>
                <h5 class="font-headline text-xl font-bold mb-3">Tận tâm</h5>
                <p class="text-on-surface-variant text-sm">Lắng nghe và thấu hiểu mọi nhu cầu nhỏ nhất của từng khách hàng.</p>
            </div>

            <div class="text-center p-8 hover:bg-surface-container-low transition-colors rounded-xl group">
                <div class="mb-6 inline-block p-4 bg-surface-container-highest rounded-full text-secondary group-hover:scale-110 duration-200">
                    <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">lightbulb</span>
                </div>
                <h5 class="font-headline text-xl font-bold mb-3">Sáng tạo</h5>
                <p class="text-on-surface-variant text-sm">Không ngừng đổi mới để tạo ra những hành trình khác biệt và thú vị.</p>
            </div>

        </div>
    </section>

    <!-- ============================================================
         5. Why Choose Us
    ============================================================ -->
    <section class="py-24 bg-surface-container-low">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="relative editorial-bleed">
                    <img class="rounded-r-3xl shadow-2xl h-[600px] w-full object-cover"
                         alt="Hành trình cùng Travel Bling"
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuB84YGLOUPpEkuC3fIACQM6Lr7Y5rnQtVgF3tuAHIYPQS8xiju-BM0GiW5xE2ieJ5YfXcoZ2JdzVM0lTYkjNzKStDffcxnG2wSioE3xUQlS4rQ6wpODVi9c6WAHVdTu6HHmXBlZk-gbEGEr0Z6j-s6jd6xnalOM7wD6VRAtCkg2jhW22Np_uaPuU0pb_5AhOg__MoBRMWqacA6FR-CvK_Qsuh4l66XcR1KuOMYOmQ1BpDmeX-FiHqYwf3c55IRnCHAS030abz-NFW0s" />
                </div>

                <div class="space-y-12">
                    <div>
                        <h2 class="font-headline text-sm font-bold tracking-[0.2em] text-on-primary-container uppercase mb-4">Lý do chọn Travel Bling</h2>
                        <h3 class="font-headline text-4xl font-bold text-on-secondary-fixed">Khác biệt tạo nên đẳng cấp</h3>
                    </div>
                    <div class="space-y-8">

                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-on-secondary-container text-white rounded-full flex items-center justify-center">
                                <span class="material-symbols-outlined">explore</span>
                            </div>
                            <div>
                                <h6 class="font-bold text-lg mb-1">Hướng dẫn viên chuyên nghiệp</h6>
                                <p class="text-on-surface-variant">Đội ngũ hướng dẫn viên giàu kiến thức thực tế và am hiểu tâm lý du khách.</p>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-on-secondary-container text-white rounded-full flex items-center justify-center">
                                <span class="material-symbols-outlined">support_agent</span>
                            </div>
                            <div>
                                <h6 class="font-bold text-lg mb-1">Hỗ trợ 24/7</h6>
                                <p class="text-on-surface-variant">Chúng tôi luôn đồng hành cùng bạn trên mọi nẻo đường, bất kể múi giờ.</p>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-on-secondary-container text-white rounded-full flex items-center justify-center">
                                <span class="material-symbols-outlined">sell</span>
                            </div>
                            <div>
                                <h6 class="font-bold text-lg mb-1">Giá tốt nhất thị trường</h6>
                                <p class="text-on-surface-variant">Cam kết chất lượng dịch vụ tương xứng nhất với chi phí bạn bỏ ra.</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================
         6. Call to Action
    ============================================================ -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-5">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        </div>
        <div class="max-w-4xl mx-auto px-8 relative z-10 text-center">
            <!-- Logo Travel Bling thay vì text -->
            <div class="flex justify-center mb-8">
                <img src="/travel.bling/img/travel-bling-logo-cropped.png"
                    alt="Travel Bling"
                     class="h-20 w-auto object-contain" />
            </div>
            <h2 class="font-headline text-4xl md:text-5xl font-bold text-on-secondary-fixed mb-8 leading-tight">
                Sẵn sàng cho chuyến phiêu lưu tiếp theo?
            </h2>
            <p class="text-xl text-on-surface-variant mb-12 font-light">
                Hãy để chúng tôi giúp bạn thiết kế một hành trình không thể nào quên.
                Những điểm đến tuyệt vời nhất đang chờ đón bạn.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="index.php?controller=tour"
                   class="bg-on-primary-container text-white px-10 py-4 rounded-md font-bold text-lg hover:scale-95 transition-transform shadow-lg">
                    Khám phá Tour ngay
                </a>
                <a href="index.php?controller=home&action=contact"
                   class="border border-secondary text-secondary px-10 py-4 rounded-md font-bold text-lg hover:bg-secondary hover:text-white transition-all">
                    Yêu cầu tư vấn
                </a>
            </div>
        </div>
    </section>

</main>
