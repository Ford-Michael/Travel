<?php
/**
 * Bill / Hóa Đơn Thanh Toán
 * 
 * Matches the company invoice template format.
 * Generated per-booking when a user completes a tour booking.
 *
 * Expected variables: $tour, $booking, $account, $pricing (from BookingController)
 */

$tourName     = $tour['title'] ?? ($tour['tour_name'] ?? 'Tour');
$heroImage    = $tour['imageURL'] ?? ($tour['heroImage'] ?? '');
$numAdults    = (int) ($booking['numAdults'] ?? 1);
$numChildren  = (int) ($booking['numChildren'] ?? 0);
$totalGuests  = $numAdults + $numChildren;

$p = $pricing ?? [];
$adultPrice   = (float) ($p['unitAdultSale'] ?? ($tour['priceAdult'] ?? 0));
$childPrice   = (float) ($p['unitChildSale'] ?? ($tour['priceChild'] ?? 0));
$adultTotal   = (float) ($p['adultLineTotal'] ?? ($adultPrice * $numAdults));
$childTotal   = (float) ($p['childLineTotal'] ?? ($childPrice * $numChildren));
$subtotal     = (float) ($p['listSubtotal'] ?? ($adultTotal + $childTotal));
$discount     = (float) ($p['promoDiscount'] ?? 0);
$taxableAmount= (float) ($p['taxable'] ?? ($subtotal - $discount));
$vatRate      = 0.10;
$vatAmount    = (float) ($p['vat'] ?? ($taxableAmount * $vatRate));
$grandTotal   = (float) ($p['total'] ?? ($taxableAmount + $vatAmount));
$promoPct     = (float) ($p['promoPercent'] ?? ($tour['promoDiscountPercent'] ?? 0));
$discountRowLabel = $discount > 0
    ? 'Giảm giá khuyến mãi (' . number_format($promoPct, 0, ',', '.') . '%)'
    : 'Giảm giá khuyến mãi';

$bookingDate  = $booking['bookingDate'] ?? date('Y-m-d H:i:s');
$bookingId    = (int) ($booking['bookingID'] ?? 0);
$invoiceNo    = 'HD-' . str_pad($bookingId, 6, '0', STR_PAD_LEFT);

// Customer info
$customerName = htmlspecialchars($account['usersname'] ?? $account['username'] ?? '-');
$nameParts = explode(' ', trim($customerName));
$lastName = end($nameParts);

$customerEmail = htmlspecialchars($account['email'] ?? '-');
$customerPhone = htmlspecialchars($account['phoneNumber'] ?? $account['phone'] ?? '-');
$customerAddress = htmlspecialchars($account['address'] ?? 'Chưa cập nhật');
$customerId   = (int) ($account['usersID'] ?? $account['id'] ?? 0);

// Payment deadline: 3 days from booking date
$paymentDeadline = date('d/m/Y', strtotime($bookingDate . ' +3 days'));
?>

<style>
    @media print {
        header, footer, .no-print, nav, .sticky, .top-0 { display: none !important; }
        body { background: white !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .bill-page { box-shadow: none !important; margin: 0 !important; border: none !important; }
    }

    .bill-page {
        font-family: 'Be Vietnam Pro', 'Segoe UI', sans-serif;
        max-width: 800px;
        margin: 0 auto;
        background: #fff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 8px 40px rgba(0,0,0,0.08);
    }

    .bill-header-bar {
        background: linear-gradient(135deg, #6b46a0 0%, #9b6fc0 100%);
        height: 5px;
    }

    .bill-table {
        width: 100%;
        border-collapse: collapse;
    }
    .bill-table th,
    .bill-table td {
        border: 1px solid #c4b5d4;
        padding: 10px 14px;
        text-align: left;
        font-size: 13px;
    }
    .bill-table th {
        background: linear-gradient(135deg, #7c5ba6, #9b6fc0);
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 12px;
    }
    .bill-table tbody tr:nth-child(even) {
        background: #faf8fd;
    }
    .bill-table tbody tr:hover {
        background: #f0ecf5;
    }

    .section-title {
        background: linear-gradient(135deg, #7c5ba6, #9b6fc0);
        color: #fff;
        padding: 8px 16px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 6px 6px 0 0;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
        border: 1px solid #c4b5d4;
        border-top: none;
        border-radius: 0 0 6px 6px;
        overflow: hidden;
    }
    .info-grid .info-cell {
        padding: 10px 16px;
        border-bottom: 1px solid #e8e0f0;
        font-size: 13px;
    }
    .info-grid .info-cell:nth-child(odd) {
        border-right: 1px solid #e8e0f0;
    }
    .info-label {
        color: #6b46a0;
        font-weight: 600;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .info-value {
        color: #1e293b;
        font-weight: 500;
        margin-top: 2px;
    }

    .totals-table {
        width: 100%;
        border-collapse: collapse;
    }
    .totals-table td {
        padding: 8px 16px;
        font-size: 13px;
        border-bottom: 1px solid #e8e0f0;
    }
    .totals-table .total-label {
        text-align: right;
        color: #475569;
        font-weight: 500;
    }
    .totals-table .total-value {
        text-align: right;
        color: #1e293b;
        font-weight: 600;
        width: 160px;
    }
    .totals-table .grand-total td {
        background: linear-gradient(135deg, #7c5ba6, #9b6fc0);
        color: #fff;
        font-weight: 800;
        font-size: 15px;
        border: none;
    }

    .signature-area {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        text-align: center;
        margin-top: 40px;
        padding: 0 40px;
    }
    .signature-area .sig-title {
        font-weight: 700;
        color: #1e293b;
        font-size: 14px;
        margin-bottom: 4px;
    }
    .signature-area .sig-note {
        font-size: 11px;
        color: #94a3b8;
        font-style: italic;
    }
    .signature-area .sig-space {
        height: 60px;
    }
</style>

<main class="py-10 px-4">

    <!-- Action Buttons -->
    <div class="flex items-center justify-between max-w-[800px] mx-auto mb-6 no-print">
        <a href="index.php?controller=account"
           class="inline-flex items-center gap-2 text-sm font-semibold text-[#6b46a0] hover:underline">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            Về tài khoản
        </a>
        <div class="flex gap-3">
            <button onclick="window.print()"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#6b46a0] text-white text-sm font-bold hover:bg-[#5a3690] transition-all shadow-lg shadow-[#6b46a0]/20">
                <span class="material-symbols-outlined text-base">print</span>
                In hóa đơn
            </button>
            <button onclick="saveBillPDF()"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border-2 border-[#6b46a0] text-[#6b46a0] text-sm font-bold hover:bg-[#6b46a0] hover:text-white transition-all">
                <span class="material-symbols-outlined text-base">download</span>
                Tải PDF
            </button>
        </div>
    </div>

    <!-- ═══════════ BILL PAGE ═══════════ -->
    <div class="bill-page" id="billContent">

        <!-- Top color bar -->
        <div class="bill-header-bar"></div>

        <!-- Company Header -->
        <div style="padding: 30px 40px 20px; display: flex; align-items: flex-start; gap: 24px;">
            <div style="flex-shrink: 0;">
                <img src="/travel.bling/img/travel-bling-logo-cropped.png" alt="Travel Bling"
                     style="height: 60px; width: auto; object-fit: contain;" />
            </div>
            <div style="flex: 1; text-align: right;">
                <h2 style="margin: 0; font-size: 20px; font-weight: 800; color: #6b46a0; font-family: 'Plus Jakarta Sans', sans-serif;">
                    Công ty cổ phần Travel.Bling
                </h2>
                <p style="margin: 4px 0 0; font-size: 12px; color: #64748b; line-height: 1.6;">
                    Số 78, Phố Hàng Mơ, Thành phố Hà Nội<br>
                    SĐT: 0365690399 | Email: info@travelbling.com<br>
                    Website: travel.bling
                </p>
            </div>
        </div>

        <!-- Divider -->
        <div style="margin: 0 40px; border-top: 2px solid #7c5ba6;"></div>

        <!-- Title -->
        <h1 style="text-align: center; font-size: 28px; font-weight: 900; color: #1e293b; margin: 24px 0 8px; 
                    font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.02em;">
            HÓA ĐƠN THANH TOÁN
        </h1>
        <p style="text-align: center; font-size: 12px; color: #94a3b8; margin: 0 0 28px;">
            Payment Invoice
        </p>

        <div style="padding: 0 40px 40px;">

            <!-- ═══ SECTION: Customer Info + Invoice Details ═══ -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 28px;">

                <!-- Left: Customer -->
                <div>
                    <div class="section-title">Thông tin khách hàng</div>
                    <div style="border: 1px solid #c4b5d4; border-top: none; border-radius: 0 0 6px 6px; overflow: hidden;">
                        <div style="padding: 10px 16px; border-bottom: 1px solid #e8e0f0;">
                            <span class="info-label">Người liên hệ:</span>
                            <span class="info-value" style="margin-left: 8px;"><?php echo $customerName; ?></span>
                        </div>
                        <div style="padding: 10px 16px; border-bottom: 1px solid #e8e0f0;">
                            <span class="info-label">Công ty/Nhóm:</span>
                            <span class="info-value" style="margin-left: 8px;">Khách lẻ</span>
                        </div>
                        <div style="padding: 10px 16px; border-bottom: 1px solid #e8e0f0;">
                            <span class="info-label">Địa chỉ:</span>
                            <span class="info-value" style="margin-left: 8px;"><?php echo $customerAddress; ?></span>
                        </div>
                        <div style="padding: 10px 16px; border-bottom: 1px solid #e8e0f0;">
                            <span class="info-label">Điện thoại:</span>
                            <span class="info-value" style="margin-left: 8px;"><?php echo $customerPhone; ?></span>
                        </div>
                        <div style="padding: 10px 16px;">
                            <span class="info-label">Email:</span>
                            <span class="info-value" style="margin-left: 8px;"><?php echo $customerEmail; ?></span>
                        </div>
                    </div>
                </div>

                <!-- Right: Invoice Details -->
                <div>
                    <div class="section-title">Chi tiết hóa đơn</div>
                    <div style="border: 1px solid #c4b5d4; border-top: none; border-radius: 0 0 6px 6px; overflow: hidden;">
                        <div style="padding: 10px 16px; border-bottom: 1px solid #e8e0f0;">
                            <span class="info-label">Ngày lập:</span>
                            <span class="info-value" style="margin-left: 8px;"><?php echo date('d/m/Y', strtotime($bookingDate)); ?></span>
                        </div>
                        <div style="padding: 10px 16px; border-bottom: 1px solid #e8e0f0;">
                            <span class="info-label">Mã hóa đơn:</span>
                            <span class="info-value" style="margin-left: 8px; color: #6b46a0; font-weight: 700;"><?php echo $invoiceNo; ?></span>
                        </div>
                        <div style="padding: 10px 16px; border-bottom: 1px solid #e8e0f0;">
                            <span class="info-label">Tiền tệ:</span>
                            <span class="info-value" style="margin-left: 8px;">VNĐ</span>
                        </div>
                        <div style="padding: 10px 16px; border-bottom: 1px solid #e8e0f0;">
                            <span class="info-label">Hạn thanh toán:</span>
                            <span class="info-value" style="margin-left: 8px; color: #dc2626;"><?php echo $paymentDeadline; ?></span>
                        </div>
                        <div style="padding: 10px 16px;">
                            <span class="info-label">Hành trình:</span>
                            <span class="info-value" style="margin-left: 8px;"><?php echo htmlspecialchars($tour['destination'] ?? 'N/A'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ═══ SECTION: Service Table ═══ -->
            <div style="margin-bottom: 24px;">
                <div class="section-title" style="border-radius: 6px 6px 0 0;">Thông tin dịch vụ</div>
                <table class="bill-table">
                    <thead>
                        <tr>
                            <th style="width: 90px;">Ngày</th>
                            <th>Mô tả dịch vụ</th>
                            <th style="width: 50px; text-align: center;">SL</th>
                            <th style="width: 120px; text-align: right;">Đơn giá</th>
                            <th style="width: 130px; text-align: right;">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Adult tickets -->
                        <tr>
                            <td><?php echo date('d/m/Y', strtotime($bookingDate)); ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($tourName); ?></strong><br>
                                <span style="font-size: 11px; color: #64748b;">
                                    Vé người lớn — <?php echo htmlspecialchars($tour['destination'] ?? ''); ?>
                                    <?php if (!empty($tour['duration'])): ?>
                                        | <?php echo htmlspecialchars($tour['duration']); ?>
                                    <?php endif; ?>
                                </span>
                            </td>
                            <td style="text-align: center; font-weight: 600;"><?php echo $numAdults; ?></td>
                            <td style="text-align: right;"><?php echo number_format($adultPrice, 0, ',', '.'); ?>₫</td>
                            <td style="text-align: right; font-weight: 700;"><?php echo number_format($adultTotal, 0, ',', '.'); ?>₫</td>
                        </tr>

                        <?php if ($numChildren > 0): ?>
                        <!-- Child tickets -->
                        <tr>
                            <td><?php echo date('d/m/Y', strtotime($bookingDate)); ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($tourName); ?></strong><br>
                                <span style="font-size: 11px; color: #64748b;">
                                    Vé trẻ em — <?php echo htmlspecialchars($tour['destination'] ?? ''); ?>
                                </span>
                            </td>
                            <td style="text-align: center; font-weight: 600;"><?php echo $numChildren; ?></td>
                            <td style="text-align: right;"><?php echo number_format($childPrice, 0, ',', '.'); ?>₫</td>
                            <td style="text-align: right; font-weight: 700;"><?php echo number_format($childTotal, 0, ',', '.'); ?>₫</td>
                        </tr>
                        <?php endif; ?>

                        <!-- Empty rows for official look -->
                        <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td></tr>
                        <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td></tr>
                    </tbody>
                </table>
            </div>

            <!-- ═══ SECTION: Notes + Totals ═══ -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 32px;">

                <!-- Left: Notes & Terms -->
                <div>
                    <div class="section-title" style="border-radius: 6px 6px 0 0;">Ghi chú & Điều khoản</div>
                    <div style="border: 1px solid #c4b5d4; border-top: none; border-radius: 0 0 6px 6px; padding: 14px 16px; font-size: 12px; color: #475569; line-height: 1.7;">
                        <p style="margin: 0 0 8px;">
                            <strong>•</strong> Vui lòng thanh toán <strong style="color: #6b46a0;">40%</strong> giá trị hóa đơn trước ngày: <strong><?php echo $paymentDeadline; ?></strong>
                        </p>

                        <?php if (!empty($booking['specialRequests'])): ?>
                        <p style="margin: 0 0 8px;">
                            <strong>•</strong> Ghi chú khách hàng: <?php echo htmlspecialchars($booking['specialRequests']); ?>
                        </p>
                        <?php endif; ?>

                        <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid #e8e0f0;">
                            <p style="margin: 0; font-weight: 600; color: #1e293b;">Thông tin chuyển khoản:</p>
                            <p style="margin: 4px 0 0; font-size: 11px; line-height: 1.8;">
                                <em>Ngân hàng:</em> TMCP Ngoại thương Việt Nam (VCB)<br>
                                <em>Số tài khoản:</em> <strong style="color: #6b46a0;">1032059594</strong><br>
                                <em>Tên tài khoản:</em> <strong>NGUYEN VAN HAI</strong>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right: Totals -->
                <div>
                    <table class="totals-table" style="border: 1px solid #c4b5d4; border-radius: 6px; overflow: hidden;">
                        <tr>
                            <td class="total-label">Cộng tiền hàng</td>
                            <td class="total-value"><?php echo number_format($subtotal, 0, ',', '.'); ?>₫</td>
                        </tr>
                        <tr>
                            <td class="total-label"><?php echo htmlspecialchars($discountRowLabel); ?></td>
                            <td class="total-value" style="color: #16a34a;">- <?php echo number_format($discount, 0, ',', '.'); ?>₫</td>
                        </tr>
                        <tr>
                            <td class="total-label">Trị giá tính thuế</td>
                            <td class="total-value"><?php echo number_format($taxableAmount, 0, ',', '.'); ?>₫</td>
                        </tr>
                        <tr>
                            <td class="total-label">Thuế GTGT (10%)</td>
                            <td class="total-value" style="color: #dc2626;">+ <?php echo number_format($vatAmount, 0, ',', '.'); ?>₫</td>
                        </tr>
                        <tr class="grand-total">
                            <td style="text-align: right; padding: 12px 16px;">TỔNG CỘNG</td>
                            <td style="text-align: right; padding: 12px 16px;"><?php echo number_format($grandTotal, 0, ',', '.'); ?>₫</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- ═══ Confirmation statement ═══ -->
            <p style="text-align: center; font-size: 12px; color: #dc2626; font-style: italic; margin-bottom: 12px;">
                "Tôi cam đoan các thông tin cung cấp trên đây là hoàn toàn đúng sự thật và chính xác."
            </p>

            <!-- ═══ Signatures ═══ -->
            <div class="signature-area">
                <div>
                    <div class="sig-title">Đại diện Khách hàng</div>
                    <div class="sig-note">(Ký & Ghi rõ họ tên)</div>
                    <div class="sig-space" style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100px; padding-top: 10px;">
                        <span style="font-family: 'Caveat', cursive, 'Be Vietnam Pro', sans-serif; font-size: 28px; color: #1e293b; transform: rotate(-5deg); font-weight: 700;"><?php echo $lastName; ?></span>
                        <span style="font-weight: 700; font-size: 13px; color: #1e293b; margin-top: 20px;"><?php echo $customerName; ?></span>
                    </div>
                </div>
                <div>
                    <div class="sig-title">Đại diện Công ty</div>
                    <div class="sig-note">(Ký, đóng dấu & Ghi rõ họ tên)</div>
                    <div class="sig-space" style="display: flex; justify-content: center; align-items: center; height: 100px; padding-top: 10px;">
                        <img src="/travel.bling/img/Screenshot 2026-05-01 150327.png" style="height: 90px; object-fit: contain; transform: rotate(2deg);" alt="Company Stamp" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom color bar -->
        <div class="bill-header-bar"></div>
    </div>
</main>

<script>
function saveBillPDF() {
    window.print();
}
</script>
