<?php
/**
 * Dashboard Controller
 * Lunar New Year themed welcome dashboard
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/CheckoutModel.php';

class DashboardController extends Controller {
    
    private $userModel;
    private $checkoutModel;
    
    public function __construct() {
        $this->userModel = new UserModel();
        $this->checkoutModel = new CheckoutModel();
    }
    
    /**
     * Display Lunar New Year themed dashboard
     */
    public function index() {
        // Check authentication
        if (!$this->isLoggedIn()) {
            $this->setFlash('warning', 'Please login to access the dashboard.');
            $this->redirect('index.php?controller=auth&action=login');
            return;
        }
        
        // Fetch summary statistics
        $totalUsers = $this->userModel->count();
        $activeUsers = $this->userModel->countByStatus('active');
        
        // Fetch checkout statistics
        $totalCheckouts = $this->checkoutModel->count();
        $totalRevenue = $this->checkoutModel->getTotalPayments();
        $pendingPayments = $this->checkoutModel->countByPaymentStatus('Pending');
        
        // Get today's date info for Lunar New Year greeting
        $currentYear = date('Y');
        $lunarAnimal = $this->getLunarAnimal($currentYear);
        
        $data = [
            'title' => 'Dashboard - Travel Bling Admin',
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash(),
            // Statistics
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'totalCheckouts' => $totalCheckouts,
            'totalRevenue' => $totalRevenue,
            'pendingPayments' => $pendingPayments,
            // Lunar New Year
            'currentYear' => $currentYear,
            'lunarAnimal' => $lunarAnimal
        ];

        $this->view('dashboard/index', $data);
    }
    
    /**
     * Get the Lunar zodiac animal for a given year
     */
    private function getLunarAnimal($year) {
        $animals = [
            'Tý (Chuột)', 'Sửu (Trâu)', 'Dần (Hổ)', 'Mão (Mèo)',
            'Thìn (Rồng)', 'Tỵ (Rắn)', 'Ngọ (Ngựa)', 'Mùi (Dê)',
            'Thân (Khỉ)', 'Dậu (Gà)', 'Tuất (Chó)', 'Hợi (Lợn)'
        ];
        $index = ($year - 4) % 12;
        return $animals[$index];
    }
}
