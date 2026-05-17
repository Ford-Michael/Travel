<?php
/**
 * Booking Controller
 * Handles user-facing booking creation.
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/BookingModel.php';
require_once __DIR__ . '/../models/TourModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class BookingController extends Controller {
    private $bookingModel;
    private $tourModel;
    private $userModel;

    /**
     * List-price subtotal, promo reduction, VAT 10% on amount after promo, total.
     * Expects $tour with priceAdult/priceChild and optional priceAdultSale/priceChildSale from TourModel.
     */
    private function computePricingFromTour(array $tour, $numAdults, $numChildren) {
        $na = max(1, (int) $numAdults);
        $nc = max(0, (int) $numChildren);
        $listA = (float) ($tour['priceAdult'] ?? 0);
        $listC = (float) ($tour['priceChild'] ?? 0);
        $saleA = isset($tour['priceAdultSale']) ? (float) $tour['priceAdultSale'] : $listA;
        $saleC = isset($tour['priceChildSale']) ? (float) $tour['priceChildSale'] : $listC;
        $listSubtotal = $listA * $na + $listC * $nc;
        $saleSubtotal = $saleA * $na + $saleC * $nc;
        $promoDiscount = max(0, $listSubtotal - $saleSubtotal);
        $pct = (float) ($tour['promoDiscountPercent'] ?? 0);
        $taxable = $saleSubtotal;
        $vat = $taxable * 0.10;
        $total = $taxable + $vat;
        return [
            'listSubtotal' => $listSubtotal,
            'promoDiscount' => $promoDiscount,
            'promoPercent' => $pct,
            'taxable' => $taxable,
            'vat' => $vat,
            'total' => $total,
            'unitAdultSale' => $saleA,
            'unitChildSale' => $saleC,
            'unitAdultList' => $listA,
            'unitChildList' => $listC,
            'adultLineTotal' => $saleA * $na,
            'childLineTotal' => $saleC * $nc,
        ];
    }

    public function __construct() {
        $this->bookingModel = new BookingModel();
        $this->tourModel = new TourModel();
        $this->userModel = new UserModel();
    }

    /**
     * Show booking page for a selected tour.
     */
    public function index() {
        $this->requireAuth();

        $tourId = (int) $this->get('tour_id', $this->get('id', 0));
        if ($tourId <= 0) {
            $this->setFlash('danger', 'Vui long chon tour truoc khi dat.');
            $this->redirect('index.php?controller=tour');
        }

        $tour = $this->tourModel->getTourDetail($tourId);
        if (!$tour) {
            $this->setFlash('danger', 'Tour khong ton tai.');
            $this->redirect('index.php?controller=tour');
        }

        $currentUser = $this->getCurrentUser();
        $account = $this->userModel->findById($currentUser['id']);

        if (!$account) {
            $this->setFlash('danger', 'Khong tim thay thong tin tai khoan.');
            $this->redirect('index.php?controller=account');
        }

        $this->view('booking/index', [
            'title' => 'Dat tour | Travel Bling',
            'tour' => $tour,
            'account' => $account,
            'user' => $currentUser,
            'flash' => $this->getFlash(),
            'csrf_token' => $this->generateCsrfToken(),
        ]);
    }

    /**
     * Store booking from booking page.
     */
    public function store() {
        $this->requireAuth();

        if (!$this->isPost()) {
            $this->redirect('index.php?controller=tour');
        }

        if (!$this->verifyCsrfToken($this->post('csrf_token'))) {
            $this->setFlash('danger', 'Yeu cau khong hop le. Vui long thu lai.');
            $this->redirect('index.php?controller=tour');
        }

        $tourId = (int) $this->post('tourID');
        $tour = $this->tourModel->getTourDetail($tourId);
        if (!$tour) {
            $this->setFlash('danger', 'Tour khong ton tai.');
            $this->redirect('index.php?controller=tour');
        }

        $numAdults = max(1, (int) $this->post('numAdults', 1));
        $numChildren = max(0, (int) $this->post('numChildren', 0));
        $requestedGuests = $numAdults + $numChildren;
        $availableSlots = (int) ($tour['quantity'] ?? 0);

        if ($requestedGuests <= 0) {
            $this->setFlash('danger', 'So luong khach khong hop le.');
            $this->redirect('index.php?controller=booking&tour_id=' . $tourId);
        }

        if ($availableSlots > 0 && $requestedGuests > $availableSlots) {
            $this->setFlash('danger', 'So luong dat vuot qua so cho con lai cua tour.');
            $this->redirect('index.php?controller=booking&tour_id=' . $tourId);
        }

        $p = $this->computePricingFromTour($tour, $numAdults, $numChildren);
        $totalPrice = $p['total'];

        $currentUser = $this->getCurrentUser();
        $specialRequests = $this->sanitize($this->post('specialRequests', ''));
        
        $fullName = $this->sanitize($this->post('fullName', ''));
        $phoneNumber = $this->sanitize($this->post('phoneNumber', ''));
        $email = $this->sanitize($this->post('email', ''));
        $address = $this->sanitize($this->post('address', ''));

        // Update user profile if new information is provided
        $updateData = [];
        if ($fullName && $fullName !== ($currentUser['usersname'] ?? $currentUser['username'] ?? '')) {
            // Keep the format of the username field
            $updateData[isset($currentUser['usersname']) ? 'usersname' : 'username'] = $fullName;
        }
        if ($phoneNumber && $phoneNumber !== ($currentUser['phoneNumber'] ?? '')) {
            $updateData['phoneNumber'] = $phoneNumber;
        }
        if ($email && $email !== ($currentUser['email'] ?? '')) {
            $updateData['email'] = $email;
        }
        if ($address && $address !== ($currentUser['address'] ?? '')) {
            $updateData['address'] = $address;
        }

        if (!empty($updateData)) {
            $this->userModel->updateProfile($currentUser['id'], $updateData);
        }

        $bookingId = $this->bookingModel->create([
            'tourID' => $tourId,
            'usersID' => $currentUser['id'],
            'bookingDate' => date('Y-m-d H:i:s'),
            'numAdults' => $numAdults,
            'numChildren' => $numChildren,
            'totalPrice' => $totalPrice,
            'paymentStatus' => 'Unpaid',
            'bookingStatus' => 'Pending',
            'specialRequests' => $specialRequests,
        ]);

        if (!$bookingId) {
            $this->setFlash('danger', 'Khong the tao booking. Vui long thu lai.');
            $this->redirect('index.php?controller=booking&tour_id=' . $tourId);
        }

        $this->setFlash('success', 'Đặt tour thành công! Booking của bạn đã được tạo.');

        // ── Generate static bill HTML and save to /user/bill/ ──
        $account = $this->userModel->findById($currentUser['id']);
        $this->generateBillFile($bookingId, $tour, [
            'bookingID'       => $bookingId,
            'bookingDate'     => date('Y-m-d H:i:s'),
            'numAdults'       => $numAdults,
            'numChildren'     => $numChildren,
            'totalPrice'      => $totalPrice,
            'paymentStatus'   => 'Unpaid',
            'bookingStatus'   => 'Pending',
            'specialRequests' => $specialRequests,
        ], $account);

        $this->redirect('index.php?controller=booking&action=renue&id=' . $bookingId);
    }

    /**
     * Show booking invoice / report with 10% tax.
     */
    public function renue() {
        $this->requireAuth();

        $bookingId = (int) $this->get('id', 0);
        if ($bookingId <= 0) {
            $this->setFlash('danger', 'Không tìm thấy booking.');
            $this->redirect('index.php?controller=account');
        }

        $currentUser = $this->getCurrentUser();

        // Fetch booking first, then load the tour separately to avoid schema drift.
        $sql = "SELECT * FROM Booking
                WHERE bookingID = :bookingId AND usersID = :userId";
        $stmt = $this->bookingModel->query($sql, [
            'bookingId' => $bookingId,
            'userId'    => $currentUser['id'],
        ]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            $this->setFlash('danger', 'Booking không tồn tại hoặc không thuộc tài khoản này.');
            $this->redirect('index.php?controller=account');
        }

        $booking = $row;
        $tourId = (int) ($booking['tourID'] ?? 0);
        $tourRaw = $tourId > 0 ? $this->tourModel->findById($tourId) : null;

        if (!$tourRaw) {
            $this->setFlash('danger', 'Tour for this booking no longer exists.');
            $this->redirect('index.php?controller=account');
        }

        $tour = $this->tourModel->enrichTourWithPromotion($tourRaw);
        $tour['tour_name'] = $tour['tour_name'] ?? ($tour['title'] ?? 'Tour');
        $tour['title'] = $tour['title'] ?? $tour['tour_name'];
        $tour['heroImage'] = $tour['heroImage'] ?? ($tour['imageURL'] ?? '');

        // Fetch full account info
        $account = $this->userModel->findById($currentUser['id']);

        $pricing = $this->computePricingFromTour(
            $tour,
            (int) ($booking['numAdults'] ?? 1),
            (int) ($booking['numChildren'] ?? 0)
        );

        $this->view('booking/renue', [
            'title'   => 'Hóa đơn booking #' . $bookingId . ' | Travel Bling',
            'tour'    => $tour,
            'booking' => $booking,
            'pricing' => $pricing,
            'account' => $account,
            'user'    => $currentUser,
            'flash'   => $this->getFlash(),
        ]);
    }

    /**
     * Generate a static HTML bill file and save it to /user/bill/.
     */
    private function generateBillFile($bookingId, $tour, $booking, $account) {
        $billDir = __DIR__ . '/../bill';
        if (!is_dir($billDir)) {
            mkdir($billDir, 0755, true);
        }

        $tourName     = htmlspecialchars($tour['title'] ?? ($tour['tour_name'] ?? 'Tour'));
        $numAdults    = (int) ($booking['numAdults'] ?? 1);
        $numChildren  = (int) ($booking['numChildren'] ?? 0);

        $p = $this->computePricingFromTour($tour, $numAdults, $numChildren);
        $adultPrice   = $p['unitAdultSale'];
        $childPrice   = $p['unitChildSale'];
        $adultTotal   = $p['adultLineTotal'];
        $childTotal   = $p['childLineTotal'];
        $subtotal     = $p['listSubtotal'];
        $discount     = $p['promoDiscount'];
        $taxable      = $p['taxable'];
        $vat          = $p['vat'];
        $grandTotal   = $p['total'];
        $pctFmt = $p['promoPercent'] > 0 ? number_format($p['promoPercent'], 0, ',', '.') : '0';
        $discountRowLabel = $discount > 0
            ? "Giảm giá khuyến mãi ({$pctFmt}%)"
            : 'Giảm giá khuyến mãi';

        $bookingDate  = $booking['bookingDate'] ?? date('Y-m-d H:i:s');
        $invoiceNo    = 'HD-' . str_pad($bookingId, 6, '0', STR_PAD_LEFT);
        $paymentDeadline = date('d/m/Y', strtotime($bookingDate . ' +3 days'));

        $customerName = htmlspecialchars($account['usersname'] ?? $account['username'] ?? '-');
        $nameParts = explode(' ', trim($customerName));
        $lastName = end($nameParts);

        $customerEmail = htmlspecialchars($account['email'] ?? '-');
        $customerPhone = htmlspecialchars($account['phoneNumber'] ?? $account['phone'] ?? '-');
        $customerAddress = htmlspecialchars($account['address'] ?? 'Chưa cập nhật');
        $destination  = htmlspecialchars($tour['destination'] ?? 'N/A');
        $duration     = htmlspecialchars($tour['duration'] ?? '');
        $dateFormatted = date('d/m/Y', strtotime($bookingDate));

        $fmtSubtotal  = number_format($subtotal, 0, ',', '.');
        $fmtDiscount  = number_format($discount, 0, ',', '.');
        $fmtTaxable   = number_format($taxable, 0, ',', '.');
        $fmtVat       = number_format($vat, 0, ',', '.');
        $fmtGrandTotal= number_format($grandTotal, 0, ',', '.');
        $fmtAdultPrice= number_format($adultPrice, 0, ',', '.');
        $fmtAdultTotal= number_format($adultTotal, 0, ',', '.');
        $fmtChildPrice= number_format($childPrice, 0, ',', '.');
        $fmtChildTotal= number_format($childTotal, 0, ',', '.');
        $specialReqs  = htmlspecialchars($booking['specialRequests'] ?? '');

        $childRow = '';
        if ($numChildren > 0) {
            $childRow = "
            <tr>
                <td>{$dateFormatted}</td>
                <td><strong>{$tourName}</strong><br><span style='font-size:11px;color:#64748b;'>Vé trẻ em — {$destination}</span></td>
                <td style='text-align:center;font-weight:600;'>{$numChildren}</td>
                <td style='text-align:right;'>{$fmtChildPrice}₫</td>
                <td style='text-align:right;font-weight:700;'>{$fmtChildTotal}₫</td>
            </tr>";
        }

        $notesExtra = '';
        if ($specialReqs) {
            $notesExtra = "<p style='margin:0 0 8px;'><strong>•</strong> Ghi chú: {$specialReqs}</p>";
        }

        $html = <<<HTML
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn {$invoiceNo} — Travel Bling</title>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Be Vietnam Pro', sans-serif; background: #f1f5f9; padding: 30px; }
        .bill-page { max-width: 800px; margin: 0 auto; background: #fff; border: 1px solid #e2e8f0; }
        .bar { background: linear-gradient(135deg, #6b46a0, #9b6fc0); height: 5px; }
        .section-title { background: linear-gradient(135deg, #7c5ba6, #9b6fc0); color: #fff; padding: 8px 16px; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 0.1em; border-radius: 6px 6px 0 0; }
        .bill-table { width: 100%; border-collapse: collapse; }
        .bill-table th, .bill-table td { border: 1px solid #c4b5d4; padding: 10px 14px; text-align: left; font-size: 13px; }
        .bill-table th { background: linear-gradient(135deg, #7c5ba6, #9b6fc0); color: #fff; font-weight: 600; text-transform: uppercase; font-size: 12px; }
        .bill-table tbody tr:nth-child(even) { background: #faf8fd; }
        .totals-table { width: 100%; border-collapse: collapse; }
        .totals-table td { padding: 8px 16px; font-size: 13px; border-bottom: 1px solid #e8e0f0; }
        .total-label { text-align: right; color: #475569; font-weight: 500; }
        .total-value { text-align: right; color: #1e293b; font-weight: 600; width: 160px; }
        .grand-total td { background: linear-gradient(135deg, #7c5ba6, #9b6fc0); color: #fff !important; font-weight: 800; font-size: 15px; border: none; }
        .info-label { color: #6b46a0; font-weight: 600; font-size: 11px; text-transform: uppercase; }
        .info-value { color: #1e293b; font-weight: 500; margin-left: 8px; }
        .info-cell { padding: 10px 16px; border-bottom: 1px solid #e8e0f0; font-size: 13px; }
        .sig-area { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; text-align: center; margin-top: 40px; padding: 0 40px; }
        .sig-title { font-weight: 700; color: #1e293b; font-size: 14px; margin-bottom: 4px; }
        .sig-note { font-size: 11px; color: #94a3b8; font-style: italic; }
        .sig-space { height: 60px; }
        @media print { body { padding: 0; background: #fff; } .bill-page { border: none; box-shadow: none; } .no-print { display: none !important; } }
    </style>
</head>
<body>
    <div class="no-print" style="max-width:800px;margin:0 auto 16px;text-align:right;">
        <button onclick="window.print()" style="padding:8px 20px;background:#6b46a0;color:#fff;border:none;border-radius:8px;font-weight:700;font-size:13px;cursor:pointer;">🖨️ In hóa đơn</button>
    </div>
    <div class="bill-page">
        <div class="bar"></div>

        <div style="padding:30px 40px 20px;display:flex;align-items:flex-start;gap:24px;">
            <div style="flex-shrink:0;font-size:24px;font-weight:900;color:#6b46a0;font-family:'Plus Jakarta Sans',sans-serif;">✈ TRAVEL.BLING</div>
            <div style="flex:1;text-align:right;">
                <h2 style="margin:0;font-size:18px;font-weight:800;color:#6b46a0;font-family:'Plus Jakarta Sans',sans-serif;">Công ty cổ phần Travel.Bling</h2>
                <p style="margin:4px 0 0;font-size:11px;color:#64748b;line-height:1.6;">Số 78, Phố Hàng Mơ, Thành phố Hà Nội<br>SĐT: 0365690399 | Email: info@travelbling.com<br>Website: travel.bling</p>
            </div>
        </div>

        <div style="margin:0 40px;border-top:2px solid #7c5ba6;"></div>

        <h1 style="text-align:center;font-size:26px;font-weight:900;color:#1e293b;margin:24px 0 6px;font-family:'Plus Jakarta Sans',sans-serif;">HÓA ĐƠN THANH TOÁN</h1>
        <p style="text-align:center;font-size:11px;color:#94a3b8;margin:0 0 24px;">Payment Invoice</p>

        <div style="padding:0 40px 40px;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">
                <div>
                    <div class="section-title">Thông tin khách hàng</div>
                    <div style="border:1px solid #c4b5d4;border-top:none;border-radius:0 0 6px 6px;">
                        <div class="info-cell"><span class="info-label">Người liên hệ:</span><span class="info-value">{$customerName}</span></div>
                        <div class="info-cell"><span class="info-label">Công ty/Nhóm:</span><span class="info-value">Khách lẻ</span></div>
                        <div class="info-cell"><span class="info-label">Địa chỉ:</span><span class="info-value">{$customerAddress}</span></div>
                        <div class="info-cell"><span class="info-label">Điện thoại:</span><span class="info-value">{$customerPhone}</span></div>
                        <div class="info-cell" style="border-bottom:none;"><span class="info-label">Email:</span><span class="info-value">{$customerEmail}</span></div>
                    </div>
                </div>
                <div>
                    <div class="section-title">Chi tiết hóa đơn</div>
                    <div style="border:1px solid #c4b5d4;border-top:none;border-radius:0 0 6px 6px;">
                        <div class="info-cell"><span class="info-label">Ngày lập:</span><span class="info-value">{$dateFormatted}</span></div>
                        <div class="info-cell"><span class="info-label">Mã hóa đơn:</span><span class="info-value" style="color:#6b46a0;font-weight:700;">{$invoiceNo}</span></div>
                        <div class="info-cell"><span class="info-label">Tiền tệ:</span><span class="info-value">VNĐ</span></div>
                        <div class="info-cell"><span class="info-label">Hạn thanh toán:</span><span class="info-value" style="color:#dc2626;">{$paymentDeadline}</span></div>
                        <div class="info-cell" style="border-bottom:none;"><span class="info-label">Hành trình:</span><span class="info-value">{$destination}</span></div>
                    </div>
                </div>
            </div>

            <div style="margin-bottom:24px;">
                <div class="section-title">Thông tin dịch vụ</div>
                <table class="bill-table">
                    <thead><tr><th style="width:90px;">Ngày</th><th>Mô tả dịch vụ</th><th style="width:50px;text-align:center;">SL</th><th style="width:120px;text-align:right;">Đơn giá</th><th style="width:130px;text-align:right;">Thành tiền</th></tr></thead>
                    <tbody>
                        <tr>
                            <td>{$dateFormatted}</td>
                            <td><strong>{$tourName}</strong><br><span style="font-size:11px;color:#64748b;">Vé người lớn — {$destination}{$duration}</span></td>
                            <td style="text-align:center;font-weight:600;">{$numAdults}</td>
                            <td style="text-align:right;">{$fmtAdultPrice}₫</td>
                            <td style="text-align:right;font-weight:700;">{$fmtAdultTotal}₫</td>
                        </tr>
                        {$childRow}
                        <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td></tr>
                    </tbody>
                </table>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:32px;">
                <div>
                    <div class="section-title">Ghi chú & Điều khoản</div>
                    <div style="border:1px solid #c4b5d4;border-top:none;border-radius:0 0 6px 6px;padding:14px 16px;font-size:12px;color:#475569;line-height:1.7;">
                        <p style="margin:0 0 8px;"><strong>•</strong> Vui lòng thanh toán <strong style="color:#6b46a0;">40%</strong> giá trị hóa đơn trước ngày: <strong>{$paymentDeadline}</strong></p>
                        {$notesExtra}
                        <div style="margin-top:12px;padding-top:12px;border-top:1px solid #e8e0f0;">
                            <p style="margin:0;font-weight:600;color:#1e293b;">Thông tin chuyển khoản:</p>
                            <p style="margin:4px 0 0;font-size:11px;line-height:1.8;"><em>Ngân hàng:</em> TMCP Ngoại thương Việt Nam (VCB)<br><em>Số tài khoản:</em> <strong style="color:#6b46a0;">1032059594</strong><br><em>Tên tài khoản:</em> <strong>NGUYEN VAN HAI</strong></p>
                        </div>
                    </div>
                </div>
                <div>
                    <table class="totals-table" style="border:1px solid #c4b5d4;border-radius:6px;overflow:hidden;">
                        <tr><td class="total-label">Cộng tiền hàng</td><td class="total-value">{$fmtSubtotal}₫</td></tr>
                        <tr><td class="total-label">{$discountRowLabel}</td><td class="total-value" style="color:#16a34a;">- {$fmtDiscount}₫</td></tr>
                        <tr><td class="total-label">Trị giá tính thuế</td><td class="total-value">{$fmtTaxable}₫</td></tr>
                        <tr><td class="total-label">Thuế GTGT (10%)</td><td class="total-value" style="color:#dc2626;">+ {$fmtVat}₫</td></tr>
                        <tr class="grand-total"><td style="text-align:right;padding:12px 16px;">TỔNG CỘNG</td><td style="text-align:right;padding:12px 16px;">{$fmtGrandTotal}₫</td></tr>
                    </table>
                </div>
            </div>

            <p style="text-align:center;font-size:12px;color:#dc2626;font-style:italic;margin-bottom:12px;">"Tôi cam đoan các thông tin cung cấp trên đây là hoàn toàn đúng sự thật và chính xác."</p>

            <div class="sig-area">
                <div>
                    <div class="sig-title">Đại diện Khách hàng</div>
                    <div class="sig-note">(Ký & Ghi rõ họ tên)</div>
                    <div class="sig-space" style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100px; padding-top: 10px;">
                        <span style="font-family: 'Caveat', cursive, 'Be Vietnam Pro', sans-serif; font-size: 28px; color: #1e293b; transform: rotate(-5deg); font-weight: 700;">{$lastName}</span>
                        <span style="font-weight: 700; font-size: 13px; color: #1e293b; margin-top: 20px;">{$customerName}</span>
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

        <div class="bar"></div>
    </div>
</body>
</html>
HTML;

        $filename = "bill_booking_{$bookingId}.html";
        file_put_contents($billDir . '/' . $filename, $html);
    }
}
