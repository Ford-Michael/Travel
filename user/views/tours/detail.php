<?php
$images = $tour['images'] ?? [];
$primaryImage = $tour['imageURL'] ?? ($tour['heroImage'] ?? '');
$secondaryImages = [];
$primaryRemoved = false;
foreach ($images as $image) {
    $imageUrl = $image['imageURL'] ?? '';
    if (!$primaryRemoved && $primaryImage && $imageUrl === $primaryImage) {
        $primaryRemoved = true;
        continue;
    }
    $secondaryImages[] = $image;
}
$gallery = array_slice($secondaryImages, 0, 2);
$extraImages = array_slice($secondaryImages, 2);
$supplementaryCount = count($secondaryImages);
$lightboxImages = array_merge([['imageURL' => $primaryImage, 'description' => $tour['tour_name'] ?? '']], $secondaryImages);
$itineraryGalleryImages = !empty($extraImages) ? array_values($extraImages) : array_values($secondaryImages);
$itinerary = $tour['itinerary'] ?? [];
$avgRating = (float) ($tour['avgRating'] ?? 0);
$reviewCount = (int) ($tour['reviewCount'] ?? 0);
$isDomestic = !empty($tour['domesticRegion']);
$continentMeta = $tour['continentMeta'] ?? ['name' => 'Nuoc ngoai'];
$domesticMeta = $tour['domesticMeta'] ?? ['name' => 'Trong nuoc', 'slug' => 'north'];
$collectionLabel = $isDomestic ? 'Trong nuoc' : 'Nuoc ngoai';
$collectionUrl = $isDomestic
    ? 'index.php?controller=tour&action=domestic'
    : 'index.php?controller=tour';
$regionLabel = $isDomestic
    ? ($domesticMeta['name'] ?? 'Trong nuoc')
    : ($continentMeta['name'] ?? 'Nuoc ngoai');
$regionUrl = $isDomestic
    ? 'index.php?controller=tour&action=domesticRegion&region=' . urlencode($tour['domesticRegion'] ?? ($domesticMeta['slug'] ?? 'north'))
    : 'index.php?controller=tour&action=continent&region=' . urlencode($tour['continent'] ?? 'asia');
$adultPriceList = (float) ($tour['priceAdult'] ?? 0);
$childPriceList = (float) ($tour['priceChild'] ?? 0);
$adultPriceSale = (float) ($tour['priceAdultSale'] ?? $adultPriceList);
$childPriceSale = (float) ($tour['priceChildSale'] ?? $childPriceList);
$promoPct = (float) ($tour['promoDiscountPercent'] ?? 0);
$priceGapSale = max(0, $adultPriceSale - $childPriceSale);
$reviews = $reviews ?? [];
$currentUserReview = null;
if (!empty($user['id'])) {
    foreach ($reviews as $reviewItem) {
        if ((int) ($reviewItem['usersID'] ?? 0) === (int) $user['id']) {
            $currentUserReview = $reviewItem;
            break;
        }
    }
}
?>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <nav class="flex flex-wrap items-center gap-2 text-xs font-semibold uppercase tracking-[0.18em] text-slate-400 mb-8">
        <a href="index.php?controller=home" class="hover:text-[#2b5bb5]">Home</a>
        <span>/</span>
        <a href="<?php echo htmlspecialchars($collectionUrl); ?>" class="hover:text-[#2b5bb5]"><?php echo htmlspecialchars($collectionLabel); ?></a>
        <span>/</span>
        <a href="<?php echo htmlspecialchars($regionUrl); ?>" class="hover:text-[#2b5bb5]">
            <?php echo htmlspecialchars($regionLabel); ?>
        </a>
        <span>/</span>
        <span class="text-slate-600"><?php echo htmlspecialchars($tour['tour_name']); ?></span>
    </nav>

    <!-- Hero Gallery -->
    <section class="grid grid-cols-12 gap-4 mb-4">
        <div class="col-span-12 lg:col-span-8 relative overflow-hidden rounded-[28px] cursor-pointer" onclick="openLightbox(0)">
            <img src="<?php echo htmlspecialchars($primaryImage); ?>" alt="<?php echo htmlspecialchars($tour['tour_name']); ?>" class="h-[520px] w-full object-cover transition-transform duration-500 hover:scale-105">
            <div class="absolute left-6 top-6 rounded-full bg-white/20 px-4 py-2 text-xs font-bold uppercase tracking-[0.24em] text-white backdrop-blur-sm">
                Featured tour
            </div>
            <?php if ($promoPct > 0): ?>
                <div class="absolute left-6 top-16 rounded-full bg-[#ff645a] px-4 py-2 text-xs font-bold uppercase tracking-[0.15em] text-white shadow-lg">
                    Giảm <?php echo number_format($promoPct, 0); ?>%
                </div>
            <?php endif; ?>
            <?php if ($supplementaryCount > 0): ?>
                <div class="absolute right-6 bottom-6 rounded-full bg-black/50 px-4 py-2 text-xs font-bold text-white backdrop-blur-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">photo_library</span>
                    + <?php echo $supplementaryCount; ?> anh
                </div>
            <?php endif; ?>
        </div>
        <div class="col-span-12 lg:col-span-4 grid grid-cols-2 lg:grid-cols-1 gap-4">
            <?php if (!empty($gallery)): ?>
                <?php foreach ($gallery as $gi => $item): ?>
                    <div class="overflow-hidden rounded-[24px] h-[252px] cursor-pointer" onclick="openLightbox(<?php echo $gi + 1; ?>)">
                        <img src="<?php echo htmlspecialchars($item['imageURL']); ?>" alt="<?php echo htmlspecialchars($item['description'] ?? $tour['tour_name']); ?>" class="h-full w-full object-cover transition-transform duration-500 hover:scale-105">
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-2 lg:col-span-1 overflow-hidden rounded-[24px] h-[520px]">
                    <img src="<?php echo htmlspecialchars($primaryImage); ?>" alt="<?php echo htmlspecialchars($tour['tour_name']); ?>" class="h-full w-full object-cover">
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Expandable Extra Gallery -->
    <?php if (!empty($extraImages)): ?>
    <section class="mb-12">
        <div id="extraGallery" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 overflow-hidden transition-all duration-500" style="max-height: 0; opacity: 0;">
            <?php foreach ($extraImages as $ei => $img): ?>
                <div class="overflow-hidden rounded-[20px] h-[220px] cursor-pointer" onclick="openLightbox(<?php echo $ei + 3; ?>)">
                    <img src="<?php echo htmlspecialchars($img['imageURL']); ?>"
                         alt="<?php echo htmlspecialchars($img['description'] ?? $tour['tour_name']); ?>"
                         class="h-full w-full object-cover transition-transform duration-500 hover:scale-110">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <button id="toggleGalleryBtn" onclick="toggleGallery()"
                class="inline-flex items-center gap-2 rounded-full bg-[#2b5bb5] px-8 py-3 text-sm font-bold text-white shadow-lg hover:bg-[#00337c] transition-all duration-300">
                <span class="material-symbols-outlined text-base" id="toggleGalleryIcon">expand_more</span>
                <span id="toggleGalleryText">+ <?php echo count($extraImages); ?> anh</span>
            </button>
        </div>
    </section>
    <?php endif; ?>

    <!-- Lightbox -->
    <div id="lightbox" class="fixed inset-0 z-[9999] bg-black/90 hidden items-center justify-center" onclick="closeLightbox(event)">
        <button onclick="closeLightbox(event, true)" class="absolute top-6 right-6 text-white hover:text-[#ff645a] transition z-10 text-3xl">
            <span class="material-symbols-outlined text-4xl">close</span>
        </button>
        <button onclick="lightboxNav(-1)" class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 text-white hover:text-[#ff645a] transition z-10">
            <span class="material-symbols-outlined text-5xl">chevron_left</span>
        </button>
        <button onclick="lightboxNav(1)" class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 text-white hover:text-[#ff645a] transition z-10">
            <span class="material-symbols-outlined text-5xl">chevron_right</span>
        </button>
        <img id="lightboxImg" src="" alt="" class="max-h-[85vh] max-w-[90vw] object-contain rounded-2xl shadow-2xl">
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white text-sm font-bold bg-black/50 px-4 py-2 rounded-full backdrop-blur-sm">
            <span id="lightboxCounter"></span>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-10 mb-16">
        <div class="col-span-12 lg:col-span-8">
            <div class="mb-8">
                <h1 class="font-headline text-4xl sm:text-5xl font-extrabold text-on-secondary-fixed tracking-tight">
                    <?php echo htmlspecialchars($tour['tour_name']); ?>
                </h1>
                <div class="mt-5 flex flex-wrap items-center gap-5 text-sm">
                    <div class="flex items-center gap-1 text-[#ff645a]">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' <?php echo $i <= round($avgRating) ? 1 : 0; ?>">star</span>
                        <?php endfor; ?>
                        <span class="ml-2 text-slate-500 font-medium">(<?php echo $reviewCount; ?> reviews)</span>
                    </div>
                    <div class="h-4 w-px bg-slate-200"></div>
                    <div class="text-slate-500 font-medium">
                        Tour code: <span class="font-bold text-[#2b5bb5]"><?php echo htmlspecialchars($tour['tourCode'] ?? 'TBL'); ?></span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-5 p-7 bg-surface-container-low rounded-[28px] mb-12">
                <div class="text-center">
                    <span class="material-symbols-outlined text-[#2b5bb5] text-4xl">schedule</span>
                    <p class="mt-3 text-[11px] uppercase font-bold tracking-[0.18em] text-slate-400">Duration</p>
                    <p class="mt-1 text-sm font-bold text-slate-900"><?php echo htmlspecialchars($tour['duration'] ?? 'Dang cap nhat'); ?></p>
                </div>
                <div class="text-center">
                    <span class="material-symbols-outlined text-[#2b5bb5] text-4xl">flight</span>
                    <p class="mt-3 text-[11px] uppercase font-bold tracking-[0.18em] text-slate-400">Transport</p>
                    <p class="mt-1 text-sm font-bold text-slate-900">Airplane</p>
                </div>
                <div class="text-center">
                    <span class="material-symbols-outlined text-[#2b5bb5] text-4xl">location_on</span>
                    <p class="mt-3 text-[11px] uppercase font-bold tracking-[0.18em] text-slate-400">Destination</p>
                    <p class="mt-1 text-sm font-bold text-slate-900"><?php echo htmlspecialchars($tour['destination'] ?? $regionLabel); ?></p>
                </div>
                <div class="text-center">
                    <span class="material-symbols-outlined text-[#2b5bb5] text-4xl">groups</span>
                    <p class="mt-3 text-[11px] uppercase font-bold tracking-[0.18em] text-slate-400">Quantity</p>
                    <p class="mt-1 text-sm font-bold text-slate-900"><?php echo (int) ($tour['quantity'] ?? 0); ?> cho</p>
                </div>
            </div>

            <div class="rounded-[28px] bg-white border border-slate-100 p-8 shadow-sm mb-10">
                <h2 class="font-headline text-3xl font-bold text-slate-900">Tong quan tour</h2>
                <p class="mt-5 text-base leading-8 text-slate-600 whitespace-pre-line">
                    <?php echo htmlspecialchars($tour['description'] ?? 'Noi dung tour dang duoc cap nhat.'); ?>
                </p>
            </div>

            <div class="rounded-[28px] bg-white border border-slate-100 p-8 shadow-sm mb-10">
                <h2 class="font-headline text-3xl font-bold text-slate-900">Lich trinh</h2>
                <?php if (empty($itinerary)): ?>
                    <div class="mt-6 rounded-2xl border border-dashed border-slate-300 px-6 py-10 text-center text-slate-500">
                        Tour nay chua co lich trinh chi tiet trong he thong.
                    </div>
                <?php else: ?>
                    <div class="mt-8 space-y-10">
                        <?php foreach ($itinerary as $index => $item): ?>
                            <div class="relative border-l-2 border-[#2b5bb5]/20 pl-10">
                                <div class="absolute -left-[10px] top-0 h-5 w-5 rounded-full bg-[#2b5bb5] ring-4 ring-white"></div>
                                <span class="inline-flex rounded-full bg-[#d9e2ff] px-3 py-1 text-xs font-bold uppercase tracking-[0.18em] text-[#00337c]">
                                    Day <?php echo (int) ($item['dayNumber'] ?? 1); ?>
                                </span>
                                <h3 class="mt-4 font-headline text-2xl font-bold text-slate-900">
                                    <?php echo htmlspecialchars($item['title'] ?? 'Lich trinh'); ?>
                                </h3>
                                <?php if (!empty($item['location']) || !empty($item['time'])): ?>
                                    <div class="mt-3 flex flex-wrap gap-4 text-sm text-slate-500">
                                        <?php if (!empty($item['location'])): ?>
                                            <span class="inline-flex items-center gap-2"><span class="material-symbols-outlined text-base text-[#2b5bb5]">pin_drop</span><?php echo htmlspecialchars($item['location']); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($item['time'])): ?>
                                            <span class="inline-flex items-center gap-2"><span class="material-symbols-outlined text-base text-[#2b5bb5]">schedule</span><?php echo htmlspecialchars($item['time']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($item['imageURL'])): ?>
                                    <div class="mt-5 overflow-hidden rounded-2xl">
                                        <img src="<?php echo htmlspecialchars($item['imageURL']); ?>"
                                             alt="Day <?php echo (int) ($item['dayNumber'] ?? 1); ?> - <?php echo htmlspecialchars($item['title'] ?? ''); ?>"
                                             class="w-full h-[320px] object-cover rounded-2xl transition-transform duration-500 hover:scale-105 cursor-pointer shadow-md"
                                             onclick="window.open(this.src, '_blank')">
                                    </div>
                                <?php endif; ?>
                                <p class="mt-4 text-base leading-8 text-slate-600">
                                    <?php echo htmlspecialchars($item['description'] ?? 'Dang cap nhat.'); ?>
                                </p>

                                <?php if (!empty($itineraryGalleryImages[$index]['imageURL'])): ?>
                                    <?php $inlineImage = $itineraryGalleryImages[$index]; ?>
                                    <div class="mt-6 <?php echo $index % 2 === 0 ? '' : 'lg:pl-16'; ?>">
                                        <div class="overflow-hidden rounded-[24px] border border-slate-100 shadow-sm bg-slate-50 <?php echo $index % 2 === 0 ? 'lg:max-w-[88%]' : 'lg:ml-auto lg:max-w-[88%]'; ?>">
                                            <img src="<?php echo htmlspecialchars($inlineImage['imageURL']); ?>"
                                                 alt="<?php echo htmlspecialchars($inlineImage['description'] ?? $tour['tour_name']); ?>"
                                                 class="h-[260px] w-full object-cover transition-transform duration-500 hover:scale-105 cursor-pointer"
                                                 onclick="window.open(this.src, '_blank')">
                                            <?php if (!empty($inlineImage['description'])): ?>
                                                <div class="px-5 py-4 text-sm text-slate-500">
                                                    <?php echo htmlspecialchars($inlineImage['description']); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="rounded-[28px] bg-gradient-to-br from-[#fff7ed] via-white to-[#eef4ff] border border-[#fde7cf] p-8 shadow-sm mb-10">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <h2 class="font-headline text-3xl font-bold text-slate-900">Binh luan gia ca</h2>
                        <p class="mt-3 max-w-2xl text-base leading-8 text-slate-600">
                            Muc gia hien tai phu hop cho nhom khach uu tien trai nghiem tron goi. Gia nguoi lon dang o muc
                            <span class="font-bold text-[#ff645a]"><?php echo number_format($adultPriceSale, 0, ',', '.'); ?> đ</span>,
                            trong khi gia tre em la
                            <span class="font-bold text-[#2b5bb5]"><?php echo number_format($childPriceSale, 0, ',', '.'); ?> đ</span>.
                            Chenh lech giua hai muc gia la
                            <span class="font-bold text-slate-900"><?php echo number_format($priceGapSale, 0, ',', '.'); ?> đ</span>.
                        </p>
                    </div>
                    <div class="rounded-2xl bg-white/90 px-5 py-4 shadow-sm border border-white">
                        <div class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-bold">Danh gia nhanh</div>
                        <div class="mt-2 text-lg font-bold text-slate-900">Gia tron goi, de so sanh</div>
                    </div>
                </div>
                <div class="mt-6 grid gap-4 md:grid-cols-3">
                    <div class="rounded-2xl bg-white px-5 py-4 shadow-sm border border-slate-100 relative overflow-hidden">
                        <?php if ($promoPct > 0): ?>
                            <span class="absolute top-0 right-0 bg-[#ff645a] text-white text-[10px] font-bold px-2 py-1 rounded-bl-lg">-<?php echo number_format($promoPct, 0); ?>%</span>
                        <?php endif; ?>
                        <div class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-bold">Gia nguoi lon</div>
                        <p class="mt-2 text-2xl font-black text-[#ff645a]"><?php echo number_format($adultPriceSale, 0, ',', '.'); ?> đ</p>
                        <?php if ($promoPct > 0): ?>
                            <p class="text-sm text-slate-400 line-through"><?php echo number_format($adultPriceList, 0, ',', '.'); ?> đ</p>
                        <?php endif; ?>
                    </div>
                    <div class="rounded-2xl bg-white px-5 py-4 shadow-sm border border-slate-100 relative overflow-hidden">
                        <?php if ($promoPct > 0): ?>
                            <span class="absolute top-0 right-0 bg-[#ff645a] text-white text-[10px] font-bold px-2 py-1 rounded-bl-lg">-<?php echo number_format($promoPct, 0); ?>%</span>
                        <?php endif; ?>
                        <div class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-bold">Gia tre em</div>
                        <p class="mt-2 text-2xl font-black text-[#2b5bb5]"><?php echo number_format($childPriceSale, 0, ',', '.'); ?> đ</p>
                        <?php if ($promoPct > 0): ?>
                            <p class="text-sm text-slate-400 line-through"><?php echo number_format($childPriceList, 0, ',', '.'); ?> đ</p>
                        <?php endif; ?>
                    </div>
                    <div class="rounded-2xl bg-white px-5 py-4 shadow-sm border border-slate-100">
                        <div class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-bold">Chenh lech</div>
                        <p class="mt-2 text-2xl font-black text-slate-900"><?php echo number_format($priceGapSale, 0, ',', '.'); ?> đ</p>
                    </div>
                </div>
            </div>
        </div>

        <aside class="col-span-12 lg:col-span-4">
            <div class="sticky top-28 rounded-[28px] border border-slate-200 bg-white p-8 shadow-sm">
                <div class="mb-8">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-slate-400 mb-2">Starting from</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-black text-[#ff645a]"><?php echo number_format($adultPriceSale, 0, ',', '.'); ?>đ</span>
                        <span class="text-sm text-slate-400">/ pax</span>
                    </div>
                    <?php if ($promoPct > 0): ?>
                        <div class="mt-1 flex items-center gap-2">
                            <span class="text-sm font-medium text-slate-400 line-through"><?php echo number_format($adultPriceList, 0, ',', '.'); ?>đ</span>
                            <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-bold text-red-700 ring-1 ring-inset ring-red-600/10">Khuyến mãi -<?php echo number_format($promoPct, 0); ?>%</span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="space-y-4 mb-8">
                    <div class="rounded-2xl bg-slate-50 px-4 py-4">
                        <div class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-bold">Gia nguoi lon</div>
                        <div class="mt-2 text-lg font-bold text-slate-900"><?php echo number_format($adultPriceSale, 0, ',', '.'); ?> đ</div>
                        <?php if ($promoPct > 0): ?>
                            <div class="text-sm text-slate-400 line-through"><?php echo number_format($adultPriceList, 0, ',', '.'); ?> đ</div>
                        <?php endif; ?>
                    </div>
                    <div class="rounded-2xl bg-slate-50 px-4 py-4">
                        <div class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-bold">Gia tre em</div>
                        <div class="mt-2 text-lg font-bold text-slate-900"><?php echo number_format($childPriceSale, 0, ',', '.'); ?> đ</div>
                        <?php if ($promoPct > 0): ?>
                            <div class="text-sm text-slate-400 line-through"><?php echo number_format($childPriceList, 0, ',', '.'); ?> đ</div>
                        <?php endif; ?>
                    </div>
                </div>

                <form class="space-y-4 mb-8">
                    <div>
                        <label class="mb-2 block text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Departure date</label>
                        <select class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                            <option>Tuan nay</option>
                            <option>Tuan sau</option>
                            <option>Theo yeu cau</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="mb-2 block text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Adults</label>
                            <input type="number" value="1" min="1" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                        </div>
                        <div>
                            <label class="mb-2 block text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Children</label>
                            <input type="number" value="0" min="0" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                        </div>
                    </div>
                    <a href="index.php?controller=booking&tour_id=<?php echo (int) ($tour['tourID'] ?? 0); ?>" class="block w-full rounded-2xl bg-[#ff645a] px-6 py-4 text-center text-base font-bold text-white transition hover:brightness-110">
                        Book this tour
                    </a>
                </form>

                <div class="space-y-4">
                    <a href="index.php?controller=home&action=contact" class="block w-full rounded-2xl border-2 border-[#2b5bb5] px-6 py-4 text-center text-sm font-bold text-[#2b5bb5] transition hover:bg-[#2b5bb5]/5">
                        Send inquiry
                    </a>
                    <div class="rounded-2xl bg-[#d9e2ff] px-5 py-4">
                        <div class="text-[11px] uppercase tracking-[0.2em] text-[#00337c] font-bold">Hotline 24/7</div>
                        <div class="mt-2 text-2xl font-black text-[#00337c]">1800 6789</div>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <section class="mb-16">
        <div class="rounded-[28px] bg-white border border-slate-100 p-8 shadow-sm">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h2 class="font-headline text-3xl font-bold text-slate-900">Danh gia va binh luan</h2>
                    <p class="mt-2 text-slate-500">Nguoi dung co the viet danh gia, sau do admin co the sua hoac xoa trong quan tri.</p>
                </div>
                <div class="rounded-2xl bg-slate-50 px-5 py-4">
                    <div class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-bold">Tong binh luan</div>
                    <div class="mt-2 text-2xl font-black text-slate-900"><?php echo count($reviews); ?></div>
                </div>
            </div>

            <div class="mt-8 grid gap-8 lg:grid-cols-[0.95fr,1.05fr]">
                <div class="rounded-[24px] border border-slate-200 bg-slate-50 p-6">
                    <?php if (!empty($user)): ?>
                        <h3 class="font-headline text-2xl font-bold text-slate-900">
                            <?php echo $currentUserReview ? 'Cap nhat danh gia cua ban' : 'Viet binh luan moi'; ?>
                        </h3>
                        <form method="POST" action="index.php?controller=review&action=store" class="mt-6 space-y-4">
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token ?? ''); ?>">
                            <input type="hidden" name="tourID" value="<?php echo (int) ($tour['tourID'] ?? 0); ?>">

                            <div>
                                <label class="mb-2 block text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">So sao</label>
                                <select name="rating" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm">
                                    <?php for ($star = 5; $star >= 1; $star--): ?>
                                        <option value="<?php echo $star; ?>" <?php echo (int) ($currentUserReview['rating'] ?? 5) === $star ? 'selected' : ''; ?>>
                                            <?php echo $star; ?> sao
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div>
                                <label class="mb-2 block text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Binh luan</label>
                                <textarea name="comment" rows="6" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm" placeholder="Chia se trai nghiem cua ban ve tour nay..."><?php echo htmlspecialchars($currentUserReview['comment'] ?? ''); ?></textarea>
                            </div>

                            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-[#ff645a] px-6 py-4 text-base font-bold text-white transition hover:brightness-110">
                                <?php echo $currentUserReview ? 'Cap nhat danh gia' : 'Gui danh gia'; ?>
                            </button>
                        </form>
                    <?php else: ?>
                        <h3 class="font-headline text-2xl font-bold text-slate-900">Dang nhap de viet binh luan</h3>
                        <p class="mt-3 text-slate-600 leading-7">Ban can dang nhap tai khoan de gui danh gia cho tour nay.</p>
                        <a href="index.php?controller=auth&action=login" class="mt-6 inline-flex items-center justify-center rounded-2xl bg-[#2b5bb5] px-6 py-4 text-base font-bold text-white">
                            Dang nhap ngay
                        </a>
                    <?php endif; ?>
                </div>

                <div class="space-y-4">
                    <?php if (empty($reviews)): ?>
                        <div class="rounded-[24px] border border-dashed border-slate-300 px-6 py-10 text-center text-slate-500">
                            Chua co binh luan nao cho tour nay.
                        </div>
                    <?php else: ?>
                        <?php foreach ($reviews as $reviewItem): ?>
                            <article class="rounded-[24px] border border-slate-100 bg-white p-6 shadow-sm">
                                <div class="flex flex-wrap items-start justify-between gap-3">
                                    <div>
                                        <h3 class="text-lg font-bold text-slate-900"><?php echo htmlspecialchars($reviewItem['usersname'] ?? 'Nguoi dung'); ?></h3>
                                        <p class="mt-1 text-sm text-slate-400">
                                            <?php echo !empty($reviewItem['timestamp']) ? date('d/m/Y H:i', strtotime($reviewItem['timestamp'])) : ''; ?>
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-1 text-[#ff645a]">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' <?php echo $i <= (int) ($reviewItem['rating'] ?? 0) ? 1 : 0; ?>">star</span>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <p class="mt-4 text-base leading-8 text-slate-600">
                                    <?php echo htmlspecialchars($reviewItem['comment'] ?? ''); ?>
                                </p>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-20 mb-16">
        <div class="flex items-end justify-between gap-4 mb-10">
            <div>
                <h2 class="font-headline text-3xl sm:text-4xl font-extrabold text-slate-900">Similar experiences</h2>
                <p class="mt-2 text-slate-500">Nhung hanh trinh cung Chau de ban tham khao them.</p>
            </div>
        </div>

        <?php if (empty($relatedTours)): ?>
            <div class="rounded-[28px] border border-dashed border-slate-300 px-8 py-16 text-center text-slate-500">
                Chua co tour lien quan de hien thi.
            </div>
        <?php else: ?>
            <div class="grid gap-8 md:grid-cols-3">
                <?php foreach ($relatedTours as $item): ?>
                    <article class="overflow-hidden rounded-[24px] bg-surface-container-lowest shadow-sm">
                        <div class="h-64 overflow-hidden">
                            <img src="<?php echo htmlspecialchars($item['heroImage']); ?>" alt="<?php echo htmlspecialchars($item['tour_name']); ?>" class="h-full w-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="font-headline text-xl font-bold text-slate-900 line-clamp-2"><?php echo htmlspecialchars($item['tour_name']); ?></h3>
                            <div class="mt-4 flex items-center justify-between">
                                <div>
                                    <div class="text-xs uppercase tracking-[0.2em] text-slate-400">Gia tu</div>
                                    <div class="mt-2 text-xl font-black text-[#ff645a]"><?php echo number_format((float) ($item['priceAdult'] ?? 0), 0, ',', '.'); ?> đ</div>
                                </div>
                                <a href="index.php?controller=tour&action=detail&id=<?php echo (int) $item['tourID']; ?>" class="rounded-full bg-[#2b5bb5] px-5 py-3 text-sm font-bold text-white">Xem tour</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</main>

<script>
    const lightboxImages = <?php echo json_encode($lightboxImages, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
    let currentLightboxIndex = 0;

    function openLightbox(index) {
        if (!lightboxImages.length) return;
        currentLightboxIndex = index;
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        renderLightbox();
    }

    function renderLightbox() {
        const current = lightboxImages[currentLightboxIndex] || {};
        document.getElementById('lightboxImg').src = current.imageURL || '';
        document.getElementById('lightboxImg').alt = current.description || '';
        document.getElementById('lightboxCounter').textContent = (currentLightboxIndex + 1) + ' / ' + lightboxImages.length;
    }

    function closeLightbox(event, forceClose) {
        if (!forceClose && event.target.id !== 'lightbox') return;
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
    }

    function lightboxNav(step) {
        if (!lightboxImages.length) return;
        currentLightboxIndex = (currentLightboxIndex + step + lightboxImages.length) % lightboxImages.length;
        renderLightbox();
    }

    function toggleGallery() {
        const gallery = document.getElementById('extraGallery');
        const icon = document.getElementById('toggleGalleryIcon');
        const text = document.getElementById('toggleGalleryText');
        const isOpen = gallery.style.maxHeight && gallery.style.maxHeight !== '0px';

        if (isOpen) {
            gallery.style.maxHeight = '0';
            gallery.style.opacity = '0';
            icon.textContent = 'expand_more';
            text.textContent = '+ <?php echo count($extraImages); ?> anh';
            return;
        }

        gallery.style.maxHeight = gallery.scrollHeight + 'px';
        gallery.style.opacity = '1';
        icon.textContent = 'expand_less';
        text.textContent = 'An bot';
    }

</script>
