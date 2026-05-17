-- Tạo Database mới (Bỏ comment 2 dòng dưới nếu bạn chưa tạo database)
-- CREATE DATABASE travel_bling;
-- GO
-- USE travel_bling;
-- GO

-- =========================================
-- PHẦN 1: TẠO CÁC BẢNG ĐỘC LẬP (KHÔNG CÓ KHÓA NGOẠI)
-- =========================================

CREATE TABLE [admin] (
  [adminID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [usersname] NVARCHAR(50) NOT NULL,
  [password] NVARCHAR(255) NOT NULL,
  [email] NVARCHAR(100) NOT NULL,
  [avatar] NVARCHAR(255) NULL,
  [role] NVARCHAR(50) DEFAULT 'moderator',
  [page_permissions] NVARCHAR(MAX) NULL,
  [createdDate] DATETIME DEFAULT GETDATE()
);

CREATE TABLE [users] (
  [usersID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [usersname] NVARCHAR(50) NOT NULL,
  [password] NVARCHAR(255) NOT NULL,
  [email] NVARCHAR(100) NOT NULL UNIQUE,
  [phoneNumber] NVARCHAR(20) NULL,
  [address] NVARCHAR(200) NULL,
  [ipAddress] NVARCHAR(50) NULL,
  [isActive] BIT DEFAULT 1,
  [status] NVARCHAR(20) DEFAULT 'active',
  [role] NVARCHAR(10) NOT NULL DEFAULT 'user' CHECK ([role] IN ('user','admin'))
);

CREATE TABLE [tour] (
  [tourID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [title] NVARCHAR(100) NOT NULL,
  [description] NVARCHAR(MAX) NULL,
  [quantity] INT DEFAULT 0,
  [priceAdult] DECIMAL(10,2) NOT NULL,
  [priceChild] DECIMAL(10,2) NOT NULL,
  [duration] NVARCHAR(50) NULL,
  [destination] NVARCHAR(100) NULL,
  [availability] BIT DEFAULT 1,
  [departureDate] DATE NULL,
  [imageURL] NVARCHAR(255) NULL
);

CREATE TABLE [chatbroadcast] (
  [broadcastID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [adminID] INT NOT NULL,
  [rawMessage] NVARCHAR(MAX) NOT NULL,
  [formatted] NVARCHAR(MAX) NOT NULL,
  [tag] NVARCHAR(50) NULL,
  [createdAt] DATETIME DEFAULT GETDATE()
);

CREATE TABLE [chatsession] (
  [sessionID] NVARCHAR(64) NOT NULL PRIMARY KEY,
  [usersID] INT NOT NULL UNIQUE,
  [adminTookover] BIT NOT NULL DEFAULT 0,
  [lastActivity] DATETIME DEFAULT GETDATE()
);

CREATE TABLE [chatmessage] (
  [messageID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [sessionID] NVARCHAR(64) NOT NULL,
  [usersID] INT NOT NULL,
  [senderType] NVARCHAR(10) NOT NULL DEFAULT 'user' CHECK ([senderType] IN ('user','ai','admin')),
  [senderID] INT NULL,
  [content] NVARCHAR(MAX) NOT NULL,
  [createdAt] DATETIME DEFAULT GETDATE()
);

-- =========================================
-- PHẦN 2: TẠO CÁC BẢNG PHỤ THUỘC (CÓ KHÓA NGOẠI)
-- =========================================

CREATE TABLE [adminremembertokens] (
  [tokenID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [adminID] INT NOT NULL,
  [tokenHash] NVARCHAR(64) NOT NULL UNIQUE,
  [createdAt] DATETIME DEFAULT GETDATE(),
  [expiresAt] DATETIME NOT NULL,
  CONSTRAINT [fk_admin_remember_admin] FOREIGN KEY ([adminID]) REFERENCES [admin] ([adminID]) ON DELETE CASCADE
);

CREATE TABLE [userremembertokens] (
  [tokenID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [usersID] INT NOT NULL,
  [tokenHash] NVARCHAR(64) NOT NULL UNIQUE,
  [createdAt] DATETIME DEFAULT GETDATE(),
  [expiresAt] DATETIME NOT NULL,
  CONSTRAINT [fk_user_remember_user] FOREIGN KEY ([usersID]) REFERENCES [users] ([usersID]) ON DELETE CASCADE
);

CREATE TABLE [booking] (
  [bookingID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [tourID] INT NOT NULL,
  [usersID] INT NOT NULL,
  [bookingDate] DATETIME DEFAULT GETDATE(),
  [numAdults] INT DEFAULT 1,
  [numChildren] INT DEFAULT 0,
  [totalPrice] DECIMAL(10,2) NULL,
  [paymentStatus] NVARCHAR(50) DEFAULT 'Unpaid',
  [bookingStatus] NVARCHAR(50) DEFAULT 'Pending',
  [specialRequests] NVARCHAR(MAX) NULL,
  CONSTRAINT [booking_ibfk_1] FOREIGN KEY ([tourID]) REFERENCES [tour] ([tourID]),
  CONSTRAINT [booking_ibfk_2] FOREIGN KEY ([usersID]) REFERENCES [users] ([usersID])
);

CREATE TABLE [chat] (
  [chatID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [usersID] INT NULL,
  [adminID] INT NULL,
  [messages] NVARCHAR(MAX) NULL,
  [readStatus] BIT DEFAULT 0,
  [createdDate] DATETIME DEFAULT GETDATE(),
  [ipAddress] NVARCHAR(50) NULL,
  CONSTRAINT [chat_ibfk_1] FOREIGN KEY ([usersID]) REFERENCES [users] ([usersID]),
  CONSTRAINT [chat_ibfk_2] FOREIGN KEY ([adminID]) REFERENCES [admin] ([adminID])
);

CREATE TABLE [fashion] (
  [fashionID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [tourID] INT NULL,
  [title] NVARCHAR(150) NOT NULL,
  [price] DECIMAL(10,2) NULL,
  [imageURL] NVARCHAR(MAX) NULL,
  [affiliateLink] NVARCHAR(MAX) NULL,
  [description] NVARCHAR(MAX) NULL,
  [created_at] DATETIME DEFAULT GETDATE(),
  CONSTRAINT [FK_TourFashion] FOREIGN KEY ([tourID]) REFERENCES [tour] ([tourID]) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE [history] (
  [historyID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [usersID] INT NULL,
  [adminID] INT NULL,
  [tourID] INT NULL,
  [actionType] NVARCHAR(50) NULL,
  [loginIP] NVARCHAR(45) NULL,
  [userAgent] NVARCHAR(255) NULL,
  [timestamp] DATETIME DEFAULT GETDATE(),
  CONSTRAINT [history_ibfk_1] FOREIGN KEY ([usersID]) REFERENCES [users] ([usersID]),
  CONSTRAINT [history_ibfk_2] FOREIGN KEY ([tourID]) REFERENCES [tour] ([tourID]),
  CONSTRAINT [history_ibfk_3] FOREIGN KEY ([adminID]) REFERENCES [admin] ([adminID])
);

CREATE TABLE [images] (
  [imageID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [tourID] INT NOT NULL,
  [imageURL] NVARCHAR(MAX) NULL,
  [description] NVARCHAR(MAX) NULL,
  CONSTRAINT [images_ibfk_1] FOREIGN KEY ([tourID]) REFERENCES [tour] ([tourID])
);

CREATE TABLE [promotion] (
  [promotionID] NVARCHAR(50) NOT NULL PRIMARY KEY,
  [description] NVARCHAR(MAX) NULL,
  [discount] DECIMAL(10,2) NULL,
  [startDate] DATETIME NULL,
  [endDate] DATETIME NULL,
  [quantity] INT NULL,
  [tourID] INT NULL,
  CONSTRAINT [promotion_ibfk_1] FOREIGN KEY ([tourID]) REFERENCES [tour] ([tourID])
);

CREATE TABLE [review] (
  [reviewID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [tourID] INT NOT NULL,
  [usersID] INT NOT NULL,
  [rating] INT NULL CHECK ([rating] >= 1 AND [rating] <= 5),
  [comment] NVARCHAR(MAX) NULL,
  [timestamp] DATETIME DEFAULT GETDATE(),
  CONSTRAINT [review_ibfk_1] FOREIGN KEY ([tourID]) REFERENCES [tour] ([tourID]),
  CONSTRAINT [review_ibfk_2] FOREIGN KEY ([usersID]) REFERENCES [users] ([usersID])
);

CREATE TABLE [touritinerary] (
  [itineraryID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [tourID] INT NOT NULL,
  [dayNumber] INT NOT NULL DEFAULT 1,
  [title] NVARCHAR(255) NOT NULL,
  [description] NVARCHAR(MAX) NULL,
  [time] TIME NULL,
  [location] NVARCHAR(255) NULL,
  [sortOrder] INT DEFAULT 0,
  [createdAt] DATETIME DEFAULT GETDATE(),
  [imageURL] NVARCHAR(255) NULL,
  CONSTRAINT [touritinerary_ibfk_1] FOREIGN KEY ([tourID]) REFERENCES [tour] ([tourID]) ON DELETE CASCADE
);

-- =========================================
-- PHẦN 3: TẠO CÁC BẢNG PHỤ THUỘC BẬC 2
-- =========================================

CREATE TABLE [bill] (
  [billID] NVARCHAR(50) NOT NULL PRIMARY KEY,
  [bookingID] INT NOT NULL,
  [amount] DECIMAL(10,2) NULL,
  [dateIssued] DATETIME DEFAULT GETDATE(),
  [details] NVARCHAR(MAX) NULL,
  CONSTRAINT [bill_ibfk_1] FOREIGN KEY ([bookingID]) REFERENCES [booking] ([bookingID])
);

CREATE TABLE [checkout] (
  [checkoutID] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [bookingID] INT NOT NULL,
  [paymentMethod] NVARCHAR(50) NULL,
  [paymentDate] DATETIME DEFAULT GETDATE(),
  [amount] DECIMAL(10,2) NULL,
  [transactionID] NVARCHAR(100) NULL,
  [paymentStatus] NVARCHAR(50) NULL,
  CONSTRAINT [checkout_ibfk_1] FOREIGN KEY ([bookingID]) REFERENCES [booking] ([bookingID])
);