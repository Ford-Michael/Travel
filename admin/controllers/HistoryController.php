<?php
/**
 * History Controller
 * Manages Activity History/Log viewing
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/HistoryModel.php';

class HistoryController extends Controller {
    private $historyModel;

    public function __construct() {
        $this->historyModel = new HistoryModel();
    }

    /**
     * List all history
     */
    public function index() {
        $this->requireAuth();
        
        $search = $this->get('search');
        $actionType = $this->get('action_type');
        $page = max(1, intval($this->get('page', 1)));
        
        if ($search) {
            $history = $this->historyModel->search($search);
        } elseif ($actionType) {
            $history = $this->historyModel->getByActionType($actionType);
        } else {
            $history = $this->historyModel->getPaginated($page, 50);
        }
        
        $actionTypes = $this->historyModel->getActionTypes();
        $statistics = $this->historyModel->getStatistics();
        
        $this->view('history/index', [
            'title' => 'Activity History',
            'history' => $history,
            'search' => $search,
            'currentActionType' => $actionType,
            'actionTypes' => $actionTypes,
            'statistics' => $statistics,
            'currentPage' => $page,
            'totalCount' => $this->historyModel->count(),
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Clear old history
     */
    public function clear() {
        $this->requireAuth();
        
        $days = intval($this->get('days', 90));
        
        if ($days < 7) {
            $this->setFlash('danger', 'Minimum retention period is 7 days.');
            $this->redirect('index.php?controller=history');
        }
        
        $deleted = $this->historyModel->clearOlderThan($days);
        $this->setFlash('success', "Cleared {$deleted} history record(s) older than {$days} days.");
        
        $this->redirect('index.php?controller=history');
    }
}
