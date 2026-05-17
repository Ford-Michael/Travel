<?php
/**
 * Chat Controller
 * Manages Support Chat operations for Live AI/Admin Sessions
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/ChatModel.php';

class ChatController extends Controller {
    private $chatModel;

    public function __construct() {
        $this->chatModel = new ChatModel();
    }

    /**
     * List all chat sessions
     */
    public function index() {
        $this->requireAuth();
        
        $sessions = $this->chatModel->getAllActiveSessions();
        
        $this->view('chats/index', [
            'title' => 'Live Support Chat',
            'sessions' => $sessions,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * View chat conversation
     */
    public function show() {
        $this->requireAuth();
        
        $id = $this->get('id');
        if (!$id) {
            $this->redirect('index.php?controller=chat');
        }

        $session = $this->chatModel->getSessionByID($id);

        if (!$session) {
            $this->setFlash('danger', 'Chat session not found.');
            $this->redirect('index.php?controller=chat');
        }

        $messages = $this->chatModel->getMessages($id, 100);

        $this->view('chats/view', [
            'title' => 'Chat Conversation',
            'session' => $session,
            'messages' => $messages,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Reply to chat session
     */
    public function reply() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=chat');
        }

        $sessionID = $this->post('sessionID');
        $message = $this->sanitize($this->post('message'));

        if (empty($message)) {
            $this->setFlash('danger', 'Reply message cannot be empty.');
            $this->redirect('index.php?controller=chat&action=show&id=' . $sessionID);
        }

        $admin = $this->getCurrentAdmin();
        $session = $this->chatModel->getSessionByID($sessionID);

        if ($session) {
            // Takeover chat if admin replies
            if (!$session['adminTookover']) {
                $this->chatModel->setAdminTakeover($sessionID, true);
            }
            
            $this->chatModel->addMessage($sessionID, $session['usersID'], 'admin', $message, $admin['id']);
            $this->setFlash('success', 'Reply sent successfully!');
        } else {
            $this->setFlash('danger', 'Session not found.');
        }
        
        $this->redirect('index.php?controller=chat&action=show&id=' . $sessionID);
    }
    
    /**
     * Toggle Takeover Status
     */
    public function toggleTakeover() {
        $this->requireAuth();
        
        $sessionID = $this->get('id');
        $session = $this->chatModel->getSessionByID($sessionID);
        if ($session) {
            $active = !$session['adminTookover'];
            $this->chatModel->setAdminTakeover($sessionID, $active);
            $this->setFlash('success', $active ? 'AI Chat Paused - Admin has taken over.' : 'Admin stopped takeover. AI Chat Enabled.');
            $this->redirect('index.php?controller=chat&action=show&id=' . $sessionID);
        }
        $this->redirect('index.php?controller=chat');
    }

    /**
     * Send Broadcast Message
     */
    public function create() {
        $this->requireAuth();
        
        $this->view('chats/create', [
            'title' => 'Send Broadcast Message',
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Store new broadcast
     */
    public function store() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=chat&action=create');
        }

        $message = $this->sanitize($this->post('message'));
        $tag = $this->sanitize($this->post('tag', 'system'));

        if (empty($message)) {
            $this->setFlash('danger', 'Broadcast message cannot be empty.');
            $this->redirect('index.php?controller=chat&action=create');
        }
        
        $admin = $this->getCurrentAdmin();
        $this->chatModel->addBroadcast($admin['id'], $message, nl2br($message), $tag);

        $this->setFlash('success', 'Broadcast message sent successfully!');
        $this->redirect('index.php?controller=chat');
    }
}
