<?php
/**
 * Home Controller
 * Handles the homepage and general sections
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/TourModel.php';

class HomeController extends Controller {
    private $tourModel;

    public function __construct() {
        $this->tourModel = new TourModel();
    }

    /**
     * Homepage
     */
    public function index() {
        // Get featured tours from DB (fallback to demo data if DB empty)
        try {
            $featuredTours = $this->tourModel->getFeaturedTours(3);
        } catch (Exception $e) {
            $featuredTours = [];
        }

        $data = [
            'title'         => 'Travel Bling | Your Soulmate Knock',
            'description'   => 'Khám phá thế giới cùng Travel Bling - đơn vị lữ hành uy tín hàng đầu với hơn 20 năm kinh nghiệm.',
            'featuredTours' => $featuredTours,
            'flash'         => $this->getFlash(),
            'user'          => $this->getCurrentUser(),
        ];

        $this->view('home/index', $data);
    }

    /**
     * About page
     */
    public function about() {
        $data = [
            'title'  => 'Giới Thiệu | Travel Bling',
            'flash'  => $this->getFlash(),
            'user'   => $this->getCurrentUser(),
            'layout' => 'layouts/about',   // ← dùng layout riêng
        ];
        $this->view('home/about', $data);
    }

    /**
     * Travel handbook page
     */
    public function blog() {
        $data = [
            'title'       => 'Cẩm Nang Du Lịch | Travel Bling',
            'description' => 'Cẩm nang du lịch với kinh nghiệm thực tế, điểm đến nổi bật và mẹo hữu ích từ Travel Bling.',
            'flash'       => $this->getFlash(),
            'user'        => $this->getCurrentUser(),
        ];
        $this->view('home/blog', $data);
    }

    /**
     * Promotion / Khuyến Mãi page
     */
    public function promotion() {
        try {
            $promoTours = $this->tourModel->getTopPurchasedTours(6);
        } catch (Exception $e) {
            $promoTours = [];
        }

        $data = [
            'title'       => 'Khuyến Mãi | Travel Bling',
            'description' => 'Săn deal du lịch hấp dẫn với ưu đãi lên đến 50%. Flash sale, voucher giảm giá và combo tour giá sốc từ Travel Bling.',
            'promoTours'  => $promoTours,
            'flash'       => $this->getFlash(),
            'user'        => $this->getCurrentUser(),
        ];
        $this->view('home/promotion', $data);
    }

    /**
     * Contact page
     */
    public function contact() {
        $data = [
            'title' => 'Liên Hệ | Travel Bling',
            'flash' => $this->getFlash(),
            'user'  => $this->getCurrentUser(),
        ];
        $this->view('home/contact', $data);
    }
}
