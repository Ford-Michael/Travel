-- Password Reset Tokens Table
-- Run this SQL to add password reset functionality

CREATE TABLE IF NOT EXISTS PasswordResets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    expires_at DATETIME NOT NULL,
    INDEX idx_email (email),
    INDEX idx_token (token)
);
