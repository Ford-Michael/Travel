<?php
/**
 * ChatModel
 * Handles all DB operations for the Chat feature:
 *  - Broadcasts (Admin → All)
 *  - Private chat sessions & messages (User ↔ AI / Admin)
 */

require_once __DIR__ . '/Model.php';

class ChatModel extends Model {
    protected $table = 'ChatMessage';
    protected $primaryKey = 'messageID';

    // ─── SESSION ────────────────────────────────────────────

    public function getOrCreateSession(int $usersID): string {
        $stmt = $this->query(
            'SELECT sessionID FROM ChatSession WHERE usersID = :uid LIMIT 1',
            ['uid' => $usersID]
        );
        $row = $stmt->fetch();

        if ($row) {
            return $row['sessionID'];
        }

        $sessionID = bin2hex(random_bytes(32));
        $this->query(
            'INSERT INTO ChatSession (sessionID, usersID) VALUES (:sid, :uid)',
            ['sid' => $sessionID, 'uid' => $usersID]
        );
        return $sessionID;
    }

    public function getSessionByUser(int $usersID): ?array {
        $stmt = $this->query(
            'SELECT * FROM ChatSession WHERE usersID = :uid LIMIT 1',
            ['uid' => $usersID]
        );
        return $stmt->fetch() ?: null;
    }
    
    public function getSessionByID(string $sessionID): ?array {
        $stmt = $this->query(
            'SELECT cs.*, u.usersname, u.email, u.phoneNumber, u.ipAddress 
             FROM ChatSession cs 
             JOIN Users u ON cs.usersID = u.usersID
             WHERE cs.sessionID = :sid LIMIT 1',
            ['sid' => $sessionID]
        );
        return $stmt->fetch() ?: null;
    }

    public function setAdminTakeover(string $sessionID, bool $active): void {
        $this->query(
            'UPDATE ChatSession SET adminTookover = :v WHERE sessionID = :sid',
            ['v' => (int) $active, 'sid' => $sessionID]
        );
    }

    // ─── MESSAGES ────────────────────────────────────────────

    public function addMessage(string $sessionID, int $usersID, string $senderType, string $content, ?int $senderID = null): int {
        $this->query(
            'INSERT INTO ChatMessage (sessionID, usersID, senderType, senderID, content)
             VALUES (:sid, :uid, :type, :sender, :content)',
            [
                'sid'     => $sessionID,
                'uid'     => $usersID,
                'type'    => $senderType,   // 'user' | 'ai' | 'admin'
                'sender'  => $senderID,
                'content' => $content,
            ]
        );
        return (int) $this->db->lastInsertId();
    }

    public function getMessages(string $sessionID, int $limit = 50): array {
        $stmt = $this->db->prepare(
            'SELECT cm.*, a.usersname as adminName 
             FROM ChatMessage cm
             LEFT JOIN Admin a ON cm.senderID = a.adminID AND cm.senderType = \'admin\'
             WHERE cm.sessionID = :sid ORDER BY cm.createdAt ASC LIMIT ' . (int) $limit
        );
        $stmt->execute(['sid' => $sessionID]);
        return $stmt->fetchAll();
    }

    public function getMessagesSince(string $sessionID, int $afterID): array {
        $stmt = $this->db->prepare(
            'SELECT cm.*, a.usersname as adminName 
             FROM ChatMessage cm
             LEFT JOIN Admin a ON cm.senderID = a.adminID AND cm.senderType = \'admin\'
             WHERE cm.sessionID = :sid AND cm.messageID > :after
             ORDER BY cm.createdAt ASC'
        );
        $stmt->execute(['sid' => $sessionID, 'after' => $afterID]);
        return $stmt->fetchAll();
    }

    // ─── BROADCASTS ─────────────────────────────────────────

    public function addBroadcast(int $adminID, string $raw, string $formatted, string $tag = ''): int {
        $this->query(
            'INSERT INTO ChatBroadcast (adminID, rawMessage, formatted, tag)
             VALUES (:aid, :raw, :fmt, :tag)',
            ['aid' => $adminID, 'raw' => $raw, 'fmt' => $formatted, 'tag' => $tag]
        );
        return (int) $this->db->lastInsertId();
    }

    public function getRecentBroadcasts(int $limit = 10): array {
        $stmt = $this->db->prepare(
            'SELECT b.*, a.usersname AS adminName
             FROM ChatBroadcast b
             JOIN Admin a ON a.adminID = b.adminID
             ORDER BY b.createdAt DESC LIMIT ' . (int) $limit
        );
        $stmt->execute();
        return array_reverse($stmt->fetchAll());
    }

    public function getLatestBroadcastSince(int $afterID): array {
        $stmt = $this->db->prepare(
            'SELECT b.*, a.usersname AS adminName
             FROM ChatBroadcast b
             JOIN Admin a ON a.adminID = b.adminID
             WHERE b.broadcastID > :after
             ORDER BY b.createdAt ASC'
        );
        $stmt->execute(['after' => $afterID]);
        return $stmt->fetchAll();
    }

    // ─── ADMIN VIEW ─────────────────────────────────────────

    public function getAllActiveSessions(): array {
        $stmt = $this->db->prepare(
            'SELECT cs.*, u.usersname, u.email,
                    (SELECT content FROM ChatMessage cm
                     WHERE cm.sessionID = cs.sessionID
                     ORDER BY cm.createdAt DESC LIMIT 1) AS lastMessage,
                    (SELECT createdAt FROM ChatMessage cm2
                     WHERE cm2.sessionID = cs.sessionID
                     ORDER BY cm2.createdAt DESC LIMIT 1) AS lastAt,
                    (SELECT COUNT(*) FROM ChatMessage cm3
                     WHERE cm3.sessionID = cs.sessionID AND cm3.senderType = \'user\') AS messageCount
             FROM ChatSession cs
             JOIN Users u ON u.usersID = cs.usersID
             ORDER BY lastAt DESC'
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
