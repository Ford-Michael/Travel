<?php
/**
 * Service Controller
 * Handles service pages: Car Rental, Hotel, Flight, Visa
 */

require_once __DIR__ . '/Controller.php';

class ServiceController extends Controller {

    /**
     * Đặt Xe / Airport Transfer & Car Rental
     */
    public function carRental() {
        $data = [
            'title'       => 'Đặt Xe & Thuê Xe | Travel Bling',
            'description' => 'Dịch vụ đặt xe sân bay, thuê xe du lịch cao cấp với tài xế chuyên nghiệp. Airport Transfer & Car Rental.',
            'flash'       => $this->getFlash(),
            'user'        => $this->getCurrentUser(),
        ];
        $this->view('services/car-rental', $data);
    }

    /**
     * Đặt Phòng Khách Sạn / Hotel Booking
     */
    public function hotel() {
        $data = [
            'title'       => 'Đặt Phòng Khách Sạn | Travel Bling',
            'description' => 'Đặt phòng khách sạn cao cấp, resort 5 sao tại các điểm đến nổi tiếng. Curated Luxury Stays.',
            'flash'       => $this->getFlash(),
            'user'        => $this->getCurrentUser(),
        ];
        $this->view('services/hotel', $data);
    }

    /**
     * Đặt Vé Máy Bay / Flight Booking
     */
    public function flight() {
        $data = [
            'title'       => 'Đặt Vé Máy Bay | Travel Bling',
            'description' => 'Tìm kiếm và đặt vé máy bay giá tốt nhất cho mọi chuyến bay nội địa và quốc tế.',
            'flash'       => $this->getFlash(),
            'user'        => $this->getCurrentUser(),
        ];
        $this->view('services/flight', $data);
    }

    /**
     * Dịch Vụ Visa
     */
    public function visa() {
        $data = [
            'title'       => 'Dịch Vụ Visa | Travel Bling',
            'description' => 'Dịch vụ làm visa nhanh chóng, uy tín cho mọi quốc gia. Tỷ lệ đậu cao, hỗ trợ trọn gói.',
            'flash'       => $this->getFlash(),
            'user'        => $this->getCurrentUser(),
        ];
        $this->view('services/visa', $data);
    }
}
