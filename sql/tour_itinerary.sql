-- TourItinerary Table for storing tour schedule/steps
-- Lịch trình tour theo từng ngày

CREATE TABLE IF NOT EXISTS TourItinerary (
    itineraryID INT PRIMARY KEY AUTO_INCREMENT,
    tourID INT NOT NULL,
    dayNumber INT NOT NULL DEFAULT 1,          -- Day number (Ngày 1, Ngày 2, etc.)
    title VARCHAR(255) NOT NULL,               -- Activity title (Tiêu đề hoạt động)
    description TEXT,                          -- Detailed description (Mô tả chi tiết)
    time TIME,                                 -- Time of activity (Thời gian)
    location VARCHAR(255),                     -- Location name (Địa điểm)
    sortOrder INT DEFAULT 0,                   -- Order within the day
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tourID) REFERENCES Tour(tourID) ON DELETE CASCADE
);

-- Add index for faster queries
CREATE INDEX idx_tour_day ON TourItinerary(tourID, dayNumber);

-- Example data (uncomment to insert)
-- INSERT INTO TourItinerary (tourID, dayNumber, title, description, time, location, sortOrder) VALUES
-- (1, 1, 'Đón khách tại sân bay', 'Xe đón khách tại sân bay Nội Bài', '08:00:00', 'Sân bay Nội Bài', 1),
-- (1, 1, 'Ăn trưa tại nhà hàng', 'Thưởng thức đặc sản địa phương', '12:00:00', 'Nhà hàng ABC', 2),
-- (1, 1, 'Tham quan phố cổ', 'Khám phá 36 phố phường Hà Nội', '14:00:00', 'Phố cổ Hà Nội', 3),
-- (1, 2, 'Khởi hành đi Hạ Long', 'Di chuyển bằng xe limousine', '07:00:00', 'Khách sạn', 1),
-- (1, 2, 'Tham quan Vịnh Hạ Long', 'Du thuyền tham quan các hang động', '10:00:00', 'Vịnh Hạ Long', 2);
