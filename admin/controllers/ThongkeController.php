<?php
/**
 * Dashboard Controller - Thá»‘ng KÃª (Statistics)
 * Admin statistics dashboard with charts
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/CheckoutModel.php';

class ThongkeController extends Controller {
    private $userModel;
    private $checkoutModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->checkoutModel = new CheckoutModel();
    }

    /**
     * Display statistics dashboard
     */
    public function index() {
        if (!$this->isLoggedIn()) {
            $this->setFlash('warning', 'Please login to access the dashboard.');
            $this->redirect('index.php?controller=auth&action=login');
            return;
        }

        $data = array_merge($this->getStatisticsData(), [
            'title' => 'Thá»‘ng KÃª - Travel Bling Admin',
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);

        $this->view('thongke/index', $data);
    }

    /**
     * Export statistics to Excel-compatible file.
     */
    public function exportExcel() {
        if (!$this->isLoggedIn()) {
            $this->setFlash('warning', 'Please login to access the dashboard.');
            $this->redirect('index.php?controller=auth&action=login');
            return;
        }

        $stats = $this->getStatisticsData();

        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename="statistics-report-' . date('Ymd-His') . '.xls"');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "\xEF\xBB\xBF";

        require __DIR__ . '/../views/thongke/export_excel.php';
        exit;
    }

    /**
     * Export statistics to a print-ready page for saving as PDF.
     */
    public function exportPdf() {
        if (!$this->isLoggedIn()) {
            $this->setFlash('warning', 'Please login to access the dashboard.');
            $this->redirect('index.php?controller=auth&action=login');
            return;
        }

        $stats = $this->getStatisticsData();

        require __DIR__ . '/../views/thongke/export_pdf.php';
        exit;
    }

    private function getStatisticsData() {
        $totalUsers = $this->userModel->count();
        $activeUsers = $this->userModel->countByStatus('active');
        $inactiveUsers = $this->userModel->countByStatus('inactive');

        $totalCheckouts = $this->checkoutModel->count();
        $totalRevenue = $this->checkoutModel->getTotalPayments();
        $completedPayments = $this->checkoutModel->countByPaymentStatus('Completed');
        $pendingPayments = $this->checkoutModel->countByPaymentStatus('Pending');
        $failedPayments = $this->checkoutModel->countByPaymentStatus('Failed');

        $userMonthlyData = $this->getUserMonthlyStats();
        $checkoutMonthlyData = $this->getCheckoutMonthlyStats();

        return [
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'totalCheckouts' => $totalCheckouts,
            'totalRevenue' => $totalRevenue,
            'completedPayments' => $completedPayments,
            'pendingPayments' => $pendingPayments,
            'failedPayments' => $failedPayments,
            'userMonthlyData' => $userMonthlyData,
            'checkoutMonthlyData' => $checkoutMonthlyData
        ];
    }

    /**
     * Get monthly user registration stats
     */
    private function getUserMonthlyStats() {
        $months = [];
        $counts = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = date('Y-m', strtotime("-$i months"));
            $months[] = date('M Y', strtotime("-$i months"));

            $sql = "SELECT COUNT(*) as count FROM Users WHERE DATE_FORMAT(createdDate, '%Y-%m') = :month";
            try {
                $stmt = $this->userModel->query($sql, ['month' => $date]);
                $result = $stmt->fetch();
                $counts[] = $result['count'] ?? 0;
            } catch (Exception $e) {
                $counts[] = 0;
            }
        }

        return ['labels' => $months, 'data' => $counts];
    }

    /**
     * Get monthly checkout/revenue stats
     */
    private function getCheckoutMonthlyStats() {
        $months = [];
        $amounts = [];
        $counts = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = date('Y-m', strtotime("-$i months"));
            $months[] = date('M Y', strtotime("-$i months"));

            $sql = "SELECT COALESCE(SUM(amount), 0) as total, COUNT(*) as count
                    FROM Checkout
                    WHERE DATE_FORMAT(paymentDate, '%Y-%m') = :month
                    AND paymentStatus = 'Completed'";
            try {
                $stmt = $this->checkoutModel->query($sql, ['month' => $date]);
                $result = $stmt->fetch();
                $amounts[] = (float) ($result['total'] ?? 0);
                $counts[] = (int) ($result['count'] ?? 0);
            } catch (Exception $e) {
                $amounts[] = 0;
                $counts[] = 0;
            }
        }

        return ['labels' => $months, 'amounts' => $amounts, 'counts' => $counts];
    }
}
