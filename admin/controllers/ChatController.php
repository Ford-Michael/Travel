<?php
/**
 * Chat Controller
 * Manages Support Chat operations
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/ChatModel.php';

class ChatController extends Controller {
    private $chatModel;

    public function __construct() {
        $this->chatModel = new ChatModel();
    }

    /**
     * List all chats
     */
    public function index() {
        $this->requireAuth();
        
        $search = $this->get('search');
        $filter = $this->get('filter');
        
        if ($search) {
            $chats = $this->chatModel->search($search);
        } elseif ($filter === 'unread') {
            $chats = $this->chatModel->getUnread();
        } else {
            $chats = $this->chatModel->getAllWithDetails();
        }
        
        $this->view('chats/index', [
            'title' => 'Support Chat',
            'chats' => $chats,
            'search' => $search,
            'currentFilter' => $filter,
            'unreadCount' => $this->chatModel->getUnreadCount(),
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Show create form (admin initiates chat with user)
     */
    public function create() {
        $this->requireAuth();
        
        require_once __DIR__ . '/../models/UserModel.php';
        $userModel = new UserModel();
        
        $this->view('chats/create', [
            'title' => 'Start New Chat',
            'users' => $userModel->findAll('usersname ASC'),
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Store new chat
     */
    public function store() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=chat&action=create');
        }

        $data = [
            'usersID' => intval($this->post('usersID')),
            'message' => $this->sanitize($this->post('message')),
            'readStatus' => 0,
            'createdDate' => date('Y-m-d H:i:s')
        ];

        // Validation
        if (!$data['usersID']) {
            $this->setFlash('danger', 'Please select a user.');
            $this->redirect('index.php?controller=chat&action=create');
        }

        if (empty($data['message'])) {
            $this->setFlash('danger', 'Message cannot be empty.');
            $this->redirect('index.php?controller=chat&action=create');
        }

        $chatId = $this->chatModel->create($data);

        if ($chatId) {
            $this->setFlash('success', 'Chat started successfully!');
            $this->redirect('index.php?controller=chat&action=show&id=' . $chatId);
        } else {
            $this->setFlash('danger', 'Failed to start chat.');
            $this->redirect('index.php?controller=chat&action=create');
        }
    }

    /**
     * Show edit form
     */
    public function edit() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $chat = $this->chatModel->getWithDetails($id);

        if (!$chat) {
            $this->setFlash('danger', 'Chat not found.');
            $this->redirect('index.php?controller=chat');
        }

        $this->view('chats/edit', [
            'title' => 'Edit Chat',
            'chat' => $chat,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Update chat
     */
    public function update() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=chat');
        }

        $id = $this->post('chatID');
        $chat = $this->chatModel->findById($id);

        if (!$chat) {
            $this->setFlash('danger', 'Chat not found.');
            $this->redirect('index.php?controller=chat');
        }

        $data = [
            'message' => $this->sanitize($this->post('message')),
            'readStatus' => intval($this->post('readStatus'))
        ];

        if ($this->chatModel->update($id, $data)) {
            $this->setFlash('success', 'Chat updated successfully!');
            $this->redirect('index.php?controller=chat');
        } else {
            $this->setFlash('danger', 'Failed to update chat.');
            $this->redirect('index.php?controller=chat&action=edit&id=' . $id);
        }
    }

    /**
     * View chat conversation
     */
    public function show() {
        $this->requireAuth();
        
        $id = $this->get('id');
        $chat = $this->chatModel->getWithDetails($id);

        if (!$chat) {
            $this->setFlash('danger', 'Chat not found.');
            $this->redirect('index.php?controller=chat');
        }

        // Auto-mark as read when viewing
        if (!$chat['readStatus']) {
            $this->chatModel->markAsRead($id);
        }

        $this->view('chats/view', [
            'title' => 'Chat Conversation',
            'chat' => $chat,
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);
    }

    /**
     * Reply to chat
     */
    public function reply() {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=chat');
        }

        $id = $this->post('chatID');
        $message = $this->sanitize($this->post('message'));

        if (empty($message)) {
            $this->setFlash('danger', 'Reply message cannot be empty.');
            $this->redirect('index.php?controller=chat&action=show&id=' . $id);
        }

        $admin = $this->getCurrentAdmin();
        
        if ($this->chatModel->addReply($id, $message, $admin['id'])) {
            $this->setFlash('success', 'Reply sent successfully!');
        } else {
            $this->setFlash('danger', 'Failed to send reply.');
        }
        
        $this->redirect('index.php?controller=chat&action=show&id=' . $id);
    }

    /**
     * Mark chat as read
     */
    public function markRead() {
        $this->requireAuth();
        
        $id = $this->get('id');
        
        if ($this->chatModel->markAsRead($id)) {
            $this->setFlash('success', 'Chat marked as read.');
        } else {
            $this->setFlash('danger', 'Failed to mark chat as read.');
        }
        
        $this->redirect('index.php?controller=chat');
    }

    /**
     * Mark all chats as read
     */
    public function markAllRead() {
        $this->requireAuth();
        
        $count = $this->chatModel->markAllAsRead();
        $this->setFlash('success', $count . ' chat(s) marked as read.');
        
        $this->redirect('index.php?controller=chat');
    }

    /**
     * Delete chat
     */
    public function delete() {
        $this->requireAuth();
        
        $id = $this->get('id');
        
        if ($this->chatModel->delete($id)) {
            $this->setFlash('success', 'Chat deleted successfully!');
        } else {
            $this->setFlash('danger', 'Failed to delete chat.');
        }
        
        $this->redirect('index.php?controller=chat');
    }
}
