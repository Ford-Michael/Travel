CREATE DATABASE IF NOT EXISTS travel_bling CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE travel_bling;

-- User table
CREATE TABLE Users (
    usersID INT PRIMARY KEY AUTO_INCREMENT,
    usersname VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL, -- Increased to 255 for secure hashes
    email VARCHAR(100) UNIQUE NOT NULL, -- Emails should be unique
    phoneNumber VARCHAR(20),
    address VARCHAR(200),
    ipAddress VARCHAR(50),
    isActive BOOLEAN DEFAULT TRUE, -- Changed to Boolean
    status VARCHAR(20) DEFAULT 'active'
);

-- Admin table
CREATE TABLE Admin (
    adminID INT PRIMARY KEY AUTO_INCREMENT,
    usersname VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role VARCHAR(50) DEFAULT 'moderator',
    createdDate DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tour table
CREATE TABLE Tour (
    tourID INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    quantity INT DEFAULT 0,
    priceAdult DECIMAL(10, 2) NOT NULL, -- Use DECIMAL for money
    priceChild DECIMAL(10, 2) NOT NULL,
    duration VARCHAR(50),
    destination VARCHAR(100),
    availability BOOLEAN DEFAULT TRUE
);

-- Booking table
CREATE TABLE Booking (
    bookingID INT PRIMARY KEY AUTO_INCREMENT,
    tourID INT NOT NULL,
    usersID INT NOT NULL,
    bookingDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    numAdults INT DEFAULT 1,
    numChildren INT DEFAULT 0,
    totalPrice DECIMAL(10, 2),
    paymentStatus VARCHAR(50) DEFAULT 'Unpaid',
    bookingStatus VARCHAR(50) DEFAULT 'Pending',
    specialRequests TEXT,
    FOREIGN KEY (tourID) REFERENCES Tour(tourID),
    FOREIGN KEY (usersID) REFERENCES users(usersID)
);

-- Bill table (Renamed from 'bill' for consistency)
CREATE TABLE Bill (
    billID VARCHAR(50) PRIMARY KEY, -- Keeping VARCHAR if you use custom invoice codes (e.g. INV-001)
    bookingID INT NOT NULL,
    amount DECIMAL(10, 2),
    dateIssued DATETIME DEFAULT CURRENT_TIMESTAMP,
    details TEXT,
    FOREIGN KEY (bookingID) REFERENCES Booking(bookingID)
);

-- Checkout table
CREATE TABLE Checkout (
    checkoutID INT PRIMARY KEY AUTO_INCREMENT,
    bookingID INT NOT NULL,
    paymentMethod VARCHAR(50),
    paymentDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    amount DECIMAL(10, 2),
    transactionID VARCHAR(100),
    paymentStatus VARCHAR(50),
    FOREIGN KEY (bookingID) REFERENCES Booking(bookingID)
);

-- Review table
CREATE TABLE Review (
    reviewID INT PRIMARY KEY AUTO_INCREMENT,
    tourID INT NOT NULL,
    usersID INT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5), -- Added constraint for 1-5 stars
    comment TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tourID) REFERENCES Tour(tourID),
    FOREIGN KEY (usersID) REFERENCES users(usersID)
);

-- Images table
CREATE TABLE Images (
    imageID INT PRIMARY KEY AUTO_INCREMENT,
    tourID INT NOT NULL,
    imageURL TEXT,
    description TEXT,
    FOREIGN KEY (tourID) REFERENCES Tour(tourID)
);

-- Promotion table
CREATE TABLE Promotion (
    promotionID VARCHAR(50) PRIMARY KEY,
    description TEXT,
    discount DECIMAL(10, 2), -- Can be percentage or flat amount
    startDate DATETIME,
    endDate DATETIME,
    quantity INT,
    tourID INT, -- Nullable if promotion applies to ALL tours
    FOREIGN KEY (tourID) REFERENCES Tour(tourID)
);

-- Chat table
CREATE TABLE Chat (
    chatID INT PRIMARY KEY AUTO_INCREMENT,
    usersID INT,
    adminID INT,
    messages TEXT,
    readStatus BOOLEAN DEFAULT FALSE,
    createdDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    ipAddress VARCHAR(50),
    FOREIGN KEY (usersID) REFERENCES users(usersID),
    FOREIGN KEY (adminID) REFERENCES Admin(adminID)
);

-- History table
CREATE TABLE History (
    historyID INT PRIMARY KEY AUTO_INCREMENT,
    usersID INT,
    tourID INT,
    actionType VARCHAR(50),
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usersID) REFERENCES users(usersID),
    FOREIGN KEY (tourID) REFERENCES Tour(tourID)
);

-- Insert default admin account (username: admin, password: admin123)
INSERT INTO Admin (usersname, password, email, role, createdDate) VALUES
('admin', 'admin123', 'admin@travelbling.com', 'superadmin', NOW());

CREATE TABLE IF NOT EXISTS Tour (
    tourID INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    quantity INT DEFAULT 0,
    priceAdult DECIMAL(10, 2) NOT NULL,
    priceChild DECIMAL(10, 2) NOT NULL,
    duration VARCHAR(50),
    destination VARCHAR(100),
    availability BOOLEAN DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS Fashion (
    fashionID INT PRIMARY KEY AUTO_INCREMENT,
    tourID INT, -- Khóa ngoại liên kết với bảng Tour
    title VARCHAR(150) NOT NULL, -- Tên trang phục (ví dụ: Váy Maxi đi biển)
    price DECIMAL(10, 2), -- Giá tiền hiển thị
    imageURL TEXT, -- Đường dẫn ảnh (có thể là link online hoặc thư mục trong htdocs)
    affiliateLink TEXT, -- Link nhúng các trang web (Shopee, Lazada, Blog thời trang...)
    description TEXT, -- Mô tả ngắn về bộ đồ
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Thiết lập khóa ngoại: Nếu xóa Tour, các gợi ý Fashion sẽ về NULL để tránh lỗi dữ liệu
    CONSTRAINT FK_TourFashion FOREIGN KEY (tourID) 
    REFERENCES Tour(tourID) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
