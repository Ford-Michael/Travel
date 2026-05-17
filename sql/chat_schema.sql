-- ═══════════════════════════════════════════════════════════
-- Travel Bling Chat System - Database Schema
-- Run this once in phpMyAdmin or MySQL CLI
-- ═══════════════════════════════════════════════════════════

USE travel_bling;

-- 1. Add role column to Users table (if not exists)
ALTER TABLE Users ADD COLUMN IF NOT EXISTS `role` ENUM('user','admin') NOT NULL DEFAULT 'user';

-- 2. Broadcasts table (Admin → All Users)
CREATE TABLE IF NOT EXISTS `ChatBroadcast` (
    `broadcastID`  INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `adminID`      INT UNSIGNED NOT NULL,
    `rawMessage`   TEXT NOT NULL,
    `formatted`    TEXT NOT NULL,
    `tag`          VARCHAR(50) DEFAULT NULL COMMENT 'PROMO, ADMIN_BROADCAST, etc.',
    `createdAt`    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_createdAt` (`createdAt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Private Chat Messages (User ↔ AI, Admin can read/takeover)
CREATE TABLE IF NOT EXISTS `ChatMessage` (
    `messageID`    INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `sessionID`    VARCHAR(64) NOT NULL COMMENT 'Chat session UUID',
    `usersID`      INT UNSIGNED NOT NULL COMMENT 'Belongs to this user',
    `senderType`   ENUM('user','ai','admin') NOT NULL DEFAULT 'user',
    `senderID`     INT UNSIGNED DEFAULT NULL COMMENT 'NULL if AI',
    `content`      TEXT NOT NULL,
    `createdAt`    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_session` (`sessionID`),
    INDEX `idx_user`    (`usersID`),
    INDEX `idx_created` (`createdAt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Chat Sessions (one active session per user)
CREATE TABLE IF NOT EXISTS `ChatSession` (
    `sessionID`    VARCHAR(64) PRIMARY KEY,
    `usersID`      INT UNSIGNED NOT NULL UNIQUE,
    `adminTookover` TINYINT(1) NOT NULL DEFAULT 0,
    `lastActivity` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_user` (`usersID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
