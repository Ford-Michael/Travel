<?php
if (!function_exists('accountBadgeClass')) {
    function accountBadgeClass($status) {
        $status = strtolower(trim((string) $status));

        if (in_array($status, ['paid', 'completed', 'confirmed', 'active'], true)) {
            return 'bg-emerald-100 text-emerald-700';
        }

        if (in_array($status, ['pending', 'unpaid', 'processing'], true)) {
            return 'bg-amber-100 text-amber-700';
        }

        if (in_array($status, ['cancelled', 'inactive', 'failed'], true)) {
            return 'bg-rose-100 text-rose-700';
        }

        return 'bg-slate-100 text-slate-700';
    }
}

if (!function_exists('accountStatusLabel')) {
    function accountStatusLabel($status) {
        $status = strtolower(trim((string) $status));
        $map = [
            'paid' => 'Đã thanh toán',
            'completed' => 'Hoàn tất',
            'confirmed' => 'Đã xác nhận',
            'active' => 'Đang hoạt động',
            'pending' => 'Đang chờ',
            'unpaid' => 'Chưa thanh toán',
            'processing' => 'Đang xử lý',
            'cancelled' => 'Đã hủy',
            'inactive' => 'Tạm khóa',
            'failed' => 'Thất bại',
        ];
        return $map[$status] ?? ($status !== '' ? ucfirst($status) : 'Chưa cập nhật');
    }
}
?>

<main class="bg-gradient-to-b from-[#f8fbff] via-white to-[#f5f7fb]">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-8">
        <div class="rounded-[32px] editorial-gradient text-white overflow-hidden shadow-2xl">
            <div class="grid lg:grid-cols-[1.4fr,0.9fr] gap-8 px-6 sm:px-10 py-10 sm:py-12">
                <div class="space-y-5">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-badge text-sm font-semibold">
                        <span class="material-symbols-outlined text-base">shield_person</span>
                        Trung tâm tài khoản
                    </span>
                    <div class="space-y-3">
                        <h1 class="font-headline text-3xl sm:text-4xl font-extrabold tracking-tight">
                            Chi tiết tài khoản
                        </h1>
                        <p class="text-white/80 max-w-2xl">
                            Tổng hợp thông tin hồ sơ, lịch sử đặt tour và lịch sử thanh toán của tài khoản đang đăng nhập.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3 text-sm">
                        <div class="bg-white/10 border border-white/15 rounded-2xl px-4 py-3">
                            <div class="text-white/70">Tài khoản</div>
                            <div class="font-semibold"><?php echo htmlspecialchars($account['usersname'] ?? $account['username'] ?? '-'); ?></div>
                        </div>
                        <div class="bg-white/10 border border-white/15 rounded-2xl px-4 py-3">
                            <div class="text-white/70">Email</div>
                            <div class="font-semibold break-all"><?php echo htmlspecialchars($account['email'] ?? '-'); ?></div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-1 gap-4">
                    <div class="rounded-3xl bg-white text-slate-900 p-5 shadow-lg">
                        <div class="text-sm text-slate-500">Tổng booking</div>
                        <div class="mt-2 text-3xl font-headline font-extrabold"><?php echo count($bookingHistory ?? []); ?></div>
                    </div>
                    <div class="rounded-3xl bg-white text-slate-900 p-5 shadow-lg">
                        <div class="text-sm text-slate-500">Tổng giao dịch</div>
                        <div class="mt-2 text-3xl font-headline font-extrabold"><?php echo count($paymentHistory ?? []); ?></div>
                    </div>
                    <div class="rounded-3xl bg-white text-slate-900 p-5 shadow-lg">
                        <div class="text-sm text-slate-500">Đã thanh toán</div>
                        <div class="mt-2 text-3xl font-headline font-extrabold"><?php echo number_format((float) $totalPaymentAmount, 0, ',', '.'); ?> đ</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <div class="grid xl:grid-cols-[1.05fr,1.45fr] gap-6">
            <div class="bg-white rounded-[28px] shadow-sm border border-slate-200/70 p-6 sm:p-7">
                <div class="flex items-center justify-between gap-3 mb-6">
                    <div>
                        <h2 class="font-headline text-2xl font-bold text-slate-900">Thông tin tài khoản</h2>
                        <p class="text-sm text-slate-500 mt-1">Hiển thị các trường đang có trong bảng người dùng.</p>
                    </div>
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">
                        <?php echo count($accountFields ?? []); ?> trường
                    </span>
                </div>

                <form method="post" action="index.php?controller=account&action=save-contact" class="mb-6 rounded-2xl border border-slate-200 bg-slate-50/80 p-4 grid sm:grid-cols-2 gap-3">
                    <div class="sm:col-span-2">
                        <h3 class="text-sm font-bold text-slate-800">Cập nhật nhanh Email / Số điện thoại</h3>
                    </div>
                    <label class="text-sm text-slate-700">
                        Email
                        <input type="email" name="email" value="<?php echo htmlspecialchars($account['email'] ?? ''); ?>" class="mt-1 w-full rounded-xl border-slate-300 text-sm focus:border-[#2b5bb5] focus:ring-[#2b5bb5]" placeholder="Nhập email">
                    </label>
                    <label class="text-sm text-slate-700">
                        Số điện thoại
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($account['phoneNumber'] ?? ($account['phone'] ?? '')); ?>" class="mt-1 w-full rounded-xl border-slate-300 text-sm focus:border-[#2b5bb5] focus:ring-[#2b5bb5]" placeholder="Nhập số điện thoại">
                    </label>
                    <label class="sm:col-span-2 text-sm text-slate-700">
                        Địa chỉ
                        <input type="text" name="address" value="<?php echo htmlspecialchars($account['address'] ?? ''); ?>" class="mt-1 w-full rounded-xl border-slate-300 text-sm focus:border-[#2b5bb5] focus:ring-[#2b5bb5]" placeholder="Nhập địa chỉ">
                    </label>
                    <div class="sm:col-span-2">
                        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-xl bg-[#00337c] text-white text-sm font-semibold hover:bg-[#00285f] transition-colors">
                            Lưu thông tin
                        </button>
                    </div>
                </form>

                <div class="grid sm:grid-cols-2 gap-4">
                    <?php foreach ($accountFields as $field): ?>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50/80 px-4 py-4">
                            <div class="text-xs uppercase tracking-[0.2em] text-slate-400 font-semibold">
                                <?php echo htmlspecialchars($field['label']); ?>
                            </div>
                            <div class="mt-2 text-sm font-semibold text-slate-900 break-words">
                                <?php echo htmlspecialchars($field['value']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="bg-white rounded-[28px] shadow-sm border border-slate-200/70 p-6 sm:p-7">
                <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                    <div>
                        <h2 class="font-headline text-2xl font-bold text-slate-900">Tổng quan hoạt động</h2>
                        <p class="text-sm text-slate-500 mt-1">Thông tin nhanh về đặt tour và thanh toán.</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-[#fff6e8] to-white p-5">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <div class="text-sm text-slate-500">Booking gần nhất</div>
                                <div class="mt-2 text-lg font-bold text-slate-900">
                                    <?php echo !empty($bookingHistory[0]['tourTitle']) ? htmlspecialchars($bookingHistory[0]['tourTitle']) : 'Chưa có booking'; ?>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-[#e84c3d] text-4xl">event_note</span>
                        </div>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-[#eef4ff] to-white p-5">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <div class="text-sm text-slate-500">Thanh toán gần nhất</div>
                                <div class="mt-2 text-lg font-bold text-slate-900">
                                    <?php echo !empty($paymentHistory[0]['paymentMethod']) ? htmlspecialchars($paymentHistory[0]['paymentMethod']) : 'Chưa có giao dịch'; ?>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-[#2b5bb5] text-4xl">credit_score</span>
                        </div>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <div class="text-sm text-slate-500">Trạng thái tài khoản</div>
                        <div class="mt-3">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold <?php echo accountBadgeClass($account['status'] ?? (!empty($account['isActive']) ? 'active' : 'inactive')); ?>">
                                <?php echo htmlspecialchars(accountStatusLabel($account['status'] ?? (!empty($account['isActive']) ? 'active' : 'inactive'))); ?>
                            </span>
                        </div>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <div class="text-sm text-slate-500">Kích hoạt</div>
                        <div class="mt-3">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold <?php echo !empty($account['isActive']) ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700'; ?>">
                                <?php echo !empty($account['isActive']) ? 'Đang hoạt động' : 'Tạm khóa'; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <div class="bg-white rounded-[28px] shadow-sm border border-slate-200/70 overflow-hidden">
            <div class="px-6 sm:px-7 py-6 border-b border-slate-200 bg-slate-50/70">
                <h2 class="font-headline text-2xl font-bold text-slate-900">Lịch sử booking</h2>
                <p class="text-sm text-slate-500 mt-1">Danh sách đặt tour của tài khoản hiện tại.</p>
            </div>

            <?php if (empty($bookingHistory)): ?>
                <div class="px-6 sm:px-7 py-10 text-center text-slate-500">
                    Tài khoản này chưa có booking nào.
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-slate-900 text-white">
                            <tr>
                                <th class="px-5 py-4 text-left font-semibold">Mã booking</th>
                                <th class="px-5 py-4 text-left font-semibold">Tour</th>
                                <th class="px-5 py-4 text-left font-semibold">Ngày đặt</th>
                                <th class="px-5 py-4 text-left font-semibold">Khách</th>
                                <th class="px-5 py-4 text-left font-semibold">Tổng tiền</th>
                                <th class="px-5 py-4 text-left font-semibold">Booking</th>
                                <th class="px-5 py-4 text-left font-semibold">Thanh toan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            <?php foreach ($bookingHistory as $booking): ?>
                                <tr class="hover:bg-slate-50">
                                    <td class="px-5 py-4 font-semibold text-slate-900">#<?php echo (int) ($booking['bookingID'] ?? 0); ?></td>
                                    <td class="px-5 py-4">
                                        <div class="font-semibold text-slate-900">
                                            <?php echo htmlspecialchars($booking['tourTitle'] ?? 'N/A'); ?>
                                        </div>
                                        <div class="text-xs text-slate-500 mt-1">
                                            <?php echo htmlspecialchars($booking['destination'] ?? 'Chưa cập nhật'); ?>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 text-slate-600">
                                        <?php echo !empty($booking['bookingDate']) ? date('d/m/Y H:i', strtotime($booking['bookingDate'])) : '-'; ?>
                                    </td>
                                    <td class="px-5 py-4 text-slate-600">
                                        <?php echo (int) ($booking['numAdults'] ?? 0) + (int) ($booking['numChildren'] ?? 0); ?>
                                    </td>
                                    <td class="px-5 py-4 font-semibold text-slate-900">
                                        <?php echo number_format((float) ($booking['totalPrice'] ?? 0), 0, ',', '.'); ?> đ
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold <?php echo accountBadgeClass($booking['bookingStatus'] ?? ''); ?>">
                                            <?php echo htmlspecialchars(accountStatusLabel($booking['bookingStatus'] ?? '')); ?>
                                        </span>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold <?php echo accountBadgeClass($booking['paymentStatus'] ?? ''); ?>">
                                            <?php echo htmlspecialchars(accountStatusLabel($booking['paymentStatus'] ?? '')); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="bg-white rounded-[28px] shadow-sm border border-slate-200/70 overflow-hidden">
            <div class="px-6 sm:px-7 py-6 border-b border-slate-200 bg-slate-50/70">
                <h2 class="font-headline text-2xl font-bold text-slate-900">Lịch sử thanh toán</h2>
                <p class="text-sm text-slate-500 mt-1">Tất cả giao dịch liên quan đến booking của tài khoản.</p>
            </div>

            <?php if (empty($paymentHistory)): ?>
                <div class="px-6 sm:px-7 py-10 text-center text-slate-500">
                    Tài khoản này chưa có giao dịch thanh toán nào.
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-[#00337c] text-white">
                            <tr>
                                <th class="px-5 py-4 text-left font-semibold">Mã pay</th>
                                <th class="px-5 py-4 text-left font-semibold">Booking</th>
                                <th class="px-5 py-4 text-left font-semibold">Tour</th>
                                <th class="px-5 py-4 text-left font-semibold">Phương thức</th>
                                <th class="px-5 py-4 text-left font-semibold">Mã giao dịch</th>
                                <th class="px-5 py-4 text-left font-semibold">Số tiền</th>
                                <th class="px-5 py-4 text-left font-semibold">Trạng thái</th>
                                <th class="px-5 py-4 text-left font-semibold">Ngày</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            <?php foreach ($paymentHistory as $payment): ?>
                                <tr class="hover:bg-slate-50">
                                    <td class="px-5 py-4 font-semibold text-slate-900">#<?php echo (int) ($payment['checkoutID'] ?? 0); ?></td>
                                    <td class="px-5 py-4 text-slate-600">
                                        <?php echo !empty($payment['bookingID']) ? '#' . (int) $payment['bookingID'] : '-'; ?>
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="font-semibold text-slate-900">
                                            <?php echo htmlspecialchars($payment['tourTitle'] ?? 'N/A'); ?>
                                        </div>
                                        <div class="text-xs text-slate-500 mt-1">
                                            <?php echo htmlspecialchars($payment['destination'] ?? 'Chưa cập nhật'); ?>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 text-slate-600">
                                        <?php echo htmlspecialchars($payment['paymentMethod'] ?? '-'); ?>
                                    </td>
                                    <td class="px-5 py-4 text-slate-600 font-mono text-xs">
                                        <?php echo htmlspecialchars($payment['transactionID'] ?? '-'); ?>
                                    </td>
                                    <td class="px-5 py-4 font-semibold text-slate-900">
                                        <?php echo number_format((float) ($payment['amount'] ?? 0), 0, ',', '.'); ?> đ
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold <?php echo accountBadgeClass($payment['paymentStatus'] ?? ''); ?>">
                                            <?php echo htmlspecialchars(accountStatusLabel($payment['paymentStatus'] ?? '')); ?>
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-slate-600">
                                        <?php echo !empty($payment['paymentDate']) ? date('d/m/Y H:i', strtotime($payment['paymentDate'])) : '-'; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>
