<?php
/**
 * ChatController
 * Routes:
 *   GET  index.php?controller=chat               → User chat page
 *   POST index.php?controller=chat&action=send   → User sends message (AJAX)
 *   GET  index.php?controller=chat&action=poll   → Long-poll new messages (AJAX)
 *   GET  index.php?controller=chat&action=admin  → Admin dashboard
 *   POST index.php?controller=chat&action=broadcast → Admin broadcast (AJAX)
 *   POST index.php?controller=chat&action=takeover  → Admin takeover (AJAX)
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/ChatModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class ChatController extends Controller {

    private ChatModel $chatModel;
    private UserModel $userModel;

    // ── System Prompt for AI assistant ──────────────────────
    private const SYSTEM_PROMPT = <<<'PROMPT'
Bạn là Trợ lý AI thông minh của hệ thống Travel Bling.
Nhiệm vụ của bạn:
1. Hỗ trợ khách hàng giải đáp thắc mắc về tour, du lịch, hệ thống.
2. Sẵn sàng trò chuyện, tâm sự và trả lời MỌI CÂU HỎI của người dùng về bất kỳ lĩnh vực nào (toán học, lịch sử, lập trình, đời sống...) giống như một ChatGPT thông thường.

Nguyên tắc:
- Luôn xưng "Hệ thống" hoặc "Tôi" và gọi khách là "Bạn".
- Giữ thái độ thân thiện, cởi mở, thông minh.
- Với các câu hỏi ngoài luồng, hãy thoải mái trả lời chi tiết và chính xác.
- Riêng về thông tin tour của Travel Bling: KHÔNG bịa đặt giá cả hay lịch trình nếu không chắc chắn.
PROMPT;

    public function __construct() {
        $this->chatModel = new ChatModel();
        $this->userModel = new UserModel();
    }

    // ══════════════════════════════════════════════════════
    // USER CHAT PAGE
    // ══════════════════════════════════════════════════════

    public function index(): void {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        $account = $this->userModel->findById($user['id']);

        $sessionID = $this->chatModel->getOrCreateSession((int) $user['id']);
        $messages  = $this->chatModel->getMessages($sessionID, 60);
        $broadcasts = $this->chatModel->getRecentBroadcasts(10);
        $session   = $this->chatModel->getSessionByUser((int) $user['id']);

        $this->view('chat/index', [
            'title'      => 'Hỗ trợ & Chat | Travel Bling',
            'account'    => $account,
            'sessionID'  => $sessionID,
            'messages'   => $messages,
            'broadcasts' => $broadcasts,
            'session'    => $session,
            'flash'      => $this->getFlash(),
        ]);
    }

    // ══════════════════════════════════════════════════════
    // SEND MESSAGE (AJAX POST)
    // ══════════════════════════════════════════════════════

    public function send(): void {
        $this->requireAuth();
        if (!$this->isPost()) { $this->json(['error' => 'Method not allowed'], 405); }

        $user    = $this->getCurrentUser();
        $content = trim($this->post('content', ''));
        if ($content === '') { $this->json(['error' => 'Empty message'], 422); }

        $sessionID = $this->chatModel->getOrCreateSession((int) $user['id']);
        $session   = $this->chatModel->getSessionByUser((int) $user['id']);
        $msgID     = $this->chatModel->addMessage($sessionID, (int) $user['id'], 'user', $content, (int) $user['id']);

        if ($session && $session['adminTookover']) {
            $this->json(['status' => 'ok', 'messageID' => $msgID, 'aiReply' => null, 'takeover' => true, 'cards' => []]);
        }

        $history  = $this->chatModel->getMessages($sessionID, 20);
        $aiReply  = $this->callAI($content, $history);
        $aiMsgID  = $this->chatModel->addMessage($sessionID, (int) $user['id'], 'ai', $aiReply, null);

        // Detect intent → build rich cards
        $intent = $this->detectIntent($content);
        $cards  = $this->buildCards($intent, (int) $user['id']);

        $this->json([
            'status'    => 'ok',
            'messageID' => $msgID,
            'aiReply'   => ['messageID' => $aiMsgID, 'content' => $aiReply],
            'cards'     => $cards,
            'intent'    => $intent['type'],
        ]);
    }

    // ══════════════════════════════════════════════════════
    // POLL – long-poll for new messages & broadcasts (AJAX)
    // ══════════════════════════════════════════════════════

    public function poll(): void {
        $this->requireAuth();
        $user      = $this->getCurrentUser();
        $afterMsg  = (int) $this->get('after_msg', 0);
        $afterBcast= (int) $this->get('after_bcast', 0);

        $sessionID = $this->chatModel->getOrCreateSession((int) $user['id']);

        $newMessages   = $this->chatModel->getMessagesSince($sessionID, $afterMsg);
        $newBroadcasts = $this->chatModel->getLatestBroadcastSince($afterBcast);

        $this->json([
            'messages'   => $newMessages,
            'broadcasts' => $newBroadcasts,
        ]);
    }

    // ══════════════════════════════════════════════════════
    // ADMIN DASHBOARD
    // ══════════════════════════════════════════════════════

    public function admin(): void {
        $this->requireAuth();
        $this->requireAdmin();

        $user       = $this->getCurrentUser();
        $account    = $this->userModel->findById($user['id']);
        $sessions   = $this->chatModel->getAllActiveSessions();
        $broadcasts = $this->chatModel->getRecentBroadcasts(20);

        // If viewing a specific user session
        $viewUserID  = (int) $this->get('view_user', 0);
        $viewSession = null;
        $viewMessages= [];
        if ($viewUserID > 0) {
            $viewSession = $this->chatModel->getSessionByUser($viewUserID);
            if ($viewSession) {
                $viewMessages = $this->chatModel->getMessages($viewSession['sessionID'], 80);
            }
        }

        $this->view('chat/admin', [
            'title'        => 'Admin Chat Dashboard | Travel Bling',
            'layout'       => 'layouts/main',
            'account'      => $account,
            'sessions'     => $sessions,
            'broadcasts'   => $broadcasts,
            'viewUserID'   => $viewUserID,
            'viewSession'  => $viewSession,
            'viewMessages' => $viewMessages,
            'flash'        => $this->getFlash(),
        ]);
    }

    // ══════════════════════════════════════════════════════
    // BROADCAST (Admin AJAX POST)
    // ══════════════════════════════════════════════════════

    public function broadcast(): void {
        $this->requireAuth();
        $this->requireAdmin();
        if (!$this->isPost()) { $this->json(['error' => 'Method not allowed'], 405); }

        $user    = $this->getCurrentUser();
        $raw     = trim($this->post('message', ''));
        if ($raw === '') { $this->json(['error' => 'Empty message'], 422); }

        // Extract tag
        $tag = '';
        if (str_contains($raw, '[ADMIN_BROADCAST]')) $tag = 'ADMIN_BROADCAST';
        elseif (str_contains($raw, '[PROMO]'))        $tag = 'PROMO';

        $formatted = $this->formatBroadcast($raw, $tag);
        $id = $this->chatModel->addBroadcast((int) $user['id'], $raw, $formatted, $tag);

        $this->json(['status' => 'ok', 'broadcastID' => $id, 'formatted' => $formatted]);
    }

    // ══════════════════════════════════════════════════════
    // ADMIN TAKEOVER (AJAX POST)
    // ══════════════════════════════════════════════════════

    public function takeover(): void {
        $this->requireAuth();
        $this->requireAdmin();
        if (!$this->isPost()) { $this->json(['error' => 'Method not allowed'], 405); }

        $user      = $this->getCurrentUser();
        $targetUID = (int) $this->post('usersID', 0);
        $active    = (bool) $this->post('active', 1);
        $content   = trim($this->post('content', ''));

        $session = $this->chatModel->getSessionByUser($targetUID);
        if (!$session) { $this->json(['error' => 'Session not found'], 404); }

        $this->chatModel->setAdminTakeover($session['sessionID'], $active);

        if ($content !== '') {
            $this->chatModel->addMessage(
                $session['sessionID'], $targetUID, 'admin', $content, (int) $user['id']
            );
        }

        $this->json(['status' => 'ok', 'takeover' => $active]);
    }

    // ══════════════════════════════════════════════════════
    // POLL for ADMIN (specific session)
    // ══════════════════════════════════════════════════════

    public function adminPoll(): void {
        $this->requireAuth();
        $this->requireAdmin();

        $targetUID = (int) $this->get('usersID', 0);
        $afterMsg  = (int) $this->get('after_msg', 0);

        $session = $this->chatModel->getSessionByUser($targetUID);
        if (!$session) { $this->json(['messages' => []]); }

        $newMessages = $this->chatModel->getMessagesSince($session['sessionID'], $afterMsg);
        $this->json(['messages' => $newMessages, 'takeover' => (bool) $session['adminTookover']]);
    }

    // ══════════════════════════════════════════════════════
    // HISTORY – widget loads recent messages on open (AJAX)
    // ══════════════════════════════════════════════════════

    public function history(): void {
        $this->requireAuth();
        $user      = $this->getCurrentUser();
        $sessionID = $this->chatModel->getOrCreateSession((int) $user['id']);
        $messages  = $this->chatModel->getMessages($sessionID, 40);
        $this->json(['messages' => $messages]);
    }

    // ══════════════════════════════════════════════════════
    // BROADCASTS – widget loads recent broadcasts on open
    // ══════════════════════════════════════════════════════

    public function broadcasts(): void {
        $this->requireAuth();
        $list = $this->chatModel->getRecentBroadcasts(15);
        $this->json(['broadcasts' => $list]);
    }

    // ══════════════════════════════════════════════════════
    // TOUR SUGGEST (AJAX GET)
    // ══════════════════════════════════════════════════════

    public function tourSuggest(): void {
        $this->requireAuth();
        require_once __DIR__ . '/../models/TourModel.php';
        $region = trim($this->get('region', ''));
        $tm = new TourModel();

        if ($region) {
            $tours = $tm->getToursByDomesticRegion($region, 1, 6);
            if (empty($tours)) $tours = $tm->getToursByContinent($region, 1, 6);
        } else {
            $tours = $tm->getFeaturedTours(6);
        }

        $cards = array_map(fn($t) => [
            'tourID'      => $t['tourID'],
            'title'       => $t['title'] ?? $t['tour_name'] ?? 'Tour',
            'destination' => $t['destination'] ?? '',
            'duration'    => $t['duration'] ?? '',
            'priceAdult'  => (float)($t['priceAdult'] ?? 0),
            'heroImage'   => $t['heroImage'] ?? $t['imageURL'] ?? '',
        ], $tours);

        $this->json(['tours' => $cards]);
    }

    // ══════════════════════════════════════════════════════
    // MY BOOKINGS (AJAX GET)
    // ══════════════════════════════════════════════════════

    public function myBookings(): void {
        $this->requireAuth();
        $user = $this->getCurrentUser();
        $db   = Database::getInstance()->getConnection();

        $stmt = $db->prepare(
            'SELECT b.bookingID, b.bookingDate, b.numAdults, b.numChildren,
                    b.totalPrice, b.paymentStatus, b.bookingStatus,
                    t.title, t.destination, t.heroImage
             FROM Booking b
             LEFT JOIN Tour t ON t.tourID = b.tourID
             WHERE b.usersID = :uid
             ORDER BY b.bookingDate DESC LIMIT 5'
        );
        $stmt->execute(['uid' => $user['id']]);
        $this->json(['bookings' => $stmt->fetchAll()]);
    }

    // ══════════════════════════════════════════════════════
    // ACCOUNT INFO (AJAX GET)
    // ══════════════════════════════════════════════════════

    public function accountInfo(): void {
        $this->requireAuth();
        $user    = $this->getCurrentUser();
        $account = $this->userModel->findById($user['id']);
        $this->json([
            'name'    => $account['usersname'] ?? $account['username'] ?? '-',
            'email'   => $account['email'] ?? '-',
            'phone'   => $account['phoneNumber'] ?? '-',
            'address' => $account['address'] ?? 'Chưa cập nhật',
        ]);
    }

    // ══════════════════════════════════════════════════════
    // PRIVATE HELPERS
    // ══════════════════════════════════════════════════════

    private function detectIntent(string $msg): array {
        $s = mb_strtolower($msg);
        $regionMap = [
            'north'   => ['miền bắc','hà nội','sapa','hạ long','ninh bình','hà giang'],
            'central' => ['miền trung','đà nẵng','hội an','huế','nha trang','đà lạt'],
            'south'   => ['miền nam','sài gòn','hồ chí minh','vũng tàu','tây ninh'],
            'mekong'  => ['miền tây','mekong','cần thơ','bến tre','an giang'],
            'islands' => ['hải đảo','phú quốc','côn đảo','lý sơn','đảo'],
            'asia'    => ['châu á','nhật bản','hàn quốc','thái lan','singapore','dubai'],
            'europe'  => ['châu âu','pháp','ý','italy','đức','thụy sĩ','tây ban nha'],
            'america' => ['châu mỹ','mỹ','canada','new york','brazil'],
        ];
        foreach ($regionMap as $region => $kws) {
            foreach ($kws as $kw) {
                if (str_contains($s, $kw)) return ['type' => 'tours', 'region' => $region];
            }
        }
        if (str_contains($s, 'tài khoản') || str_contains($s, 'thông tin cá nhân'))
            return ['type' => 'account'];
        if (str_contains($s, 'thanh toán') || str_contains($s, 'hóa đơn') || str_contains($s, 'bill') || str_contains($s, 'đã đặt'))
            return ['type' => 'bookings'];
        if (str_contains($s, 'gợi ý') || str_contains($s, 'tour nào') || str_contains($s, 'muốn đi'))
            return ['type' => 'tours', 'region' => ''];
        return ['type' => null];
    }

    private function buildCards(array $intent, int $userId): array {
        if ($intent['type'] === 'tours') {
            require_once __DIR__ . '/../models/TourModel.php';
            $tm     = new TourModel();
            $region = $intent['region'] ?? '';
            $tours  = $region
                ? ($tm->getToursByDomesticRegion($region,1,4) ?: $tm->getToursByContinent($region,1,4))
                : $tm->getFeaturedTours(4);
            return array_map(fn($t) => [
                'type'        => 'tour',
                'tourID'      => $t['tourID'],
                'title'       => $t['title'] ?? $t['tour_name'] ?? 'Tour',
                'destination' => $t['destination'] ?? '',
                'duration'    => $t['duration'] ?? '',
                'priceAdult'  => (float)($t['priceAdult'] ?? 0),
                'heroImage'   => $t['heroImage'] ?? $t['imageURL'] ?? '',
            ], $tours);
        }
        if ($intent['type'] === 'bookings') {
            $db   = Database::getInstance()->getConnection();
            $stmt = $db->prepare(
                'SELECT b.bookingID, b.bookingDate, b.numAdults, b.numChildren,
                        b.totalPrice, b.paymentStatus, b.bookingStatus, t.title
                 FROM Booking b LEFT JOIN Tour t ON t.tourID=b.tourID
                 WHERE b.usersID=:uid ORDER BY b.bookingDate DESC LIMIT 3'
            );
            $stmt->execute(['uid' => $userId]);
            return array_map(fn($b) => array_merge(['type' => 'booking'], $b), $stmt->fetchAll());
        }
        if ($intent['type'] === 'account') {
            return [['type' => 'action', 'label' => '👤 Xem trang tài khoản', 'url' => 'index.php?controller=account']];
        }
        return [];
    }


    /**
     * Call AI endpoint. Falls back to built-in rule-based responses
     * if no API key is configured so the feature works offline.
     */
    private function callAI(string $userMessage, array $history): string {
        // ── API Keys – thêm key mới vào mảng này nếu key cũ hết quota ──
        $apiKeys = array_values(array_filter([
            defined('GEMINI_API_KEY') ? GEMINI_API_KEY : null,
            getenv('GEMINI_API_KEY') ?: null,
            'AIzaSyCz1YwYcBzOByeOR21HsqDMJ5efEgxb_Nk', // key mới (ưu tiên)
            'AIzaSyB73y2Mv_4Ld0h1COfZIco1E0nYaVhZNW4', // key cũ (backup)
            // 'AIza...THEM_KEY_MOI_VAO_DAY...',
        ]));

        if (empty($apiKeys)) {
            return $this->ruleBasedReply($userMessage);
        }

        // ── Models thử theo thứ tự (khi model trước hết quota thì thử tiếp) ──
        $models = [
            'gemini-2.0-flash',
            'gemini-1.5-flash',
            'gemini-1.5-flash-8b',
        ];

        // Build conversation history (last 10 turns)
        $recent = array_slice($history, -10);
        $builtContents = [];
        foreach ($recent as $m) {
            $role = $m['senderType'] === 'user' ? 'user' : 'model';
            $builtContents[] = ['role' => $role, 'parts' => [['text' => $m['content']]]];
        }
        $builtContents[] = ['role' => 'user', 'parts' => [['text' => $userMessage]]];

        foreach ($apiKeys as $apiKey) {
            foreach ($models as $model) {
                $payload = json_encode([
                    'system_instruction' => ['parts' => [['text' => self::SYSTEM_PROMPT]]],
                    'contents'           => $builtContents,
                    'generationConfig'   => [
                        'temperature'     => 0.9,
                        'topP'            => 0.95,
                        'maxOutputTokens' => 1024,
                    ],
                ], JSON_UNESCAPED_UNICODE);

                $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";
                $ch  = curl_init($url);
                curl_setopt_array($ch, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST           => true,
                    CURLOPT_POSTFIELDS     => $payload,
                    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
                    CURLOPT_TIMEOUT        => 20,
                    CURLOPT_CONNECTTIMEOUT => 8,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                ]);
                $response = curl_exec($ch);
                curl_close($ch);

                if ($response) {
                    $data    = json_decode($response, true);
                    $text    = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                    $errCode = $data['error']['code'] ?? 0;
                    $errMsg  = $data['error']['message'] ?? '';

                    if ($text) return trim($text);

                    // Quota exceeded or model unavailable → try next model/key
                    if ($errCode === 429 || str_contains($errMsg, 'quota') || str_contains($errMsg, 'RESOURCE_EXHAUSTED')) {
                        continue;
                    }
                }
            }
        }

        // ── Fallback: rule-based responses (offline mode) ────
        return $this->ruleBasedReply($userMessage);
    }

    private function ruleBasedReply(string $msg): string {
        $lower = mb_strtolower($msg);

        if (str_contains($lower, 'prompt') && (str_contains($lower, 'midjourney') || str_contains($lower, 'ảnh') || str_contains($lower, 'image'))) {
            return "Dạ, đây là cấu trúc prompt chuẩn cho Midjourney:\n\n`[Subject], [Style], [Lighting], [Camera angle], [Details], --ar 16:9 --v 6.0`\n\nBạn hãy mô tả cụ thể hơn về chủ đề bạn muốn tạo, hệ thống sẽ viết prompt chi tiết ngay nhé! 🎨";
        }

        if (str_contains($lower, 'nghỉ phép') || str_contains($lower, 'xin nghỉ')) {
            return "Dạ, đây là mẫu tin nhắn xin nghỉ phép:\n\n*\"Dạ em chào anh/chị [Tên sếp], hiện tại sức khỏe của em đang không được tốt, em xin phép nghỉ ngày [Ngày/Tháng] để đi khám bệnh ạ. Em đã sắp xếp bàn giao công việc cho [Tên đồng nghiệp]. Em mong anh/chị thông cảm và cho phép ạ. Em cảm ơn!\"*\n\nBạn có muốn tùy chỉnh thêm không? 😊";
        }

        if (str_contains($lower, 'tour') || str_contains($lower, 'đặt') || str_contains($lower, 'booking')) {
            return "Chào bạn! Để xem và đặt tour, bạn có thể vào **[Trang Tour](/travel.bling/user/index.php?controller=tour)** để khám phá các hành trình hấp dẫn của Travel Bling nhé! 🌏\n\nBạn cần hỗ trợ thêm gì không?";
        }

        if (str_contains($lower, 'giá') || str_contains($lower, 'price') || str_contains($lower, 'phí')) {
            return "Dạ, giá tour của Travel Bling đa dạng tùy theo điểm đến và thời gian. Bạn vui lòng xem chi tiết tại trang **Tour** để có thông tin chính xác nhất nhé! Hệ thống không thể báo giá tùy tiện để tránh nhầm lẫn. 😊";
        }

        if (str_contains($lower, 'tỏ tình') || str_contains($lower, 'yêu') || str_contains($lower, 'confession')) {
            return "Ôi thật lãng mạn! 💕 Đây là mẫu tin nhắn tỏ tình:\n\n*\"[Tên người ấy] ơi, có những điều mình đã muốn nói từ rất lâu rồi... Mình thích cậu, thật sự. Cậu có muốn cho mình một cơ hội không?\"* 💌\n\nBạn muốn thêm chi tiết nào đặc biệt không?";
        }

        return "Chào bạn! Hệ thống sẵn sàng hỗ trợ bạn. Bạn có thể nhờ hệ thống:\n- 📝 Soạn tin nhắn (xin nghỉ, xin lỗi, tỏ tình...)\n- 🎨 Viết prompt cho Midjourney/DALL-E\n- ✈️ Tư vấn về tour Travel Bling\n\nBạn cần gì cứ nhắn nhé!";
    }

    /**
     * Format admin broadcast message with emoji and structure.
     */
    private function formatBroadcast(string $raw, string $tag): string {
        $clean = str_replace(['[ADMIN_BROADCAST]', '[PROMO]'], '', $raw);
        $clean = trim($clean);
        $date  = date('d/m/Y');

        if ($tag === 'PROMO') {
            return "🎉 **TIN HOT: KHUYẾN MÃI ĐẶC BIỆT!** 🎉\n\nChào bạn, đây là thông báo ưu đãi từ Travel Bling:\n\n✨ {$clean}\n\n⏰ Thời gian áp dụng: Từ ngày {$date}.\n👉 Nhắn tin ngay cho hệ thống để biết thêm chi tiết và nhận ưu đãi!";
        }

        return "📢 **THÔNG BÁO CHÍNH THỨC** 📢\n\nKính gửi quý khách hàng,\n\n{$clean}\n\n— *Travel Bling Administration*\n📅 {$date}";
    }

    private function requireAdmin(): void {
        $user = $this->getCurrentUser();
        $account = $this->userModel->findById($user['id']);
        if (empty($account['role']) || $account['role'] !== 'admin') {
            $this->json(['error' => 'Forbidden'], 403);
        }
    }

    public function isAdmin(): bool {
        if (!$this->isLoggedIn()) return false;
        $user = $this->getCurrentUser();
        $account = $this->userModel->findById($user['id']);
        return !empty($account['role']) && $account['role'] === 'admin';
    }
}
