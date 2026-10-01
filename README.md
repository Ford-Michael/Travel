# 🚀 Hướng Dẫn Khởi Động Service eKYC (Travel Bling)


Tài liệu ghi nhớ câu lệnh khởi động và vận hành hệ thống **AI eKYC Microservice** (xác thực CCCD & khuôn mặt) cho dự án Website **Travel Bling**.

---

## ⚡ 1. Khởi Động Nhanh (1-Click)

Bạn có thể double-click trực tiếp vào file script tự động:
- 📁 **[run_ekyc.bat](file:///d:/xampp/htdocs/travel.bling/run_ekyc.bat)** *(Nằm ngay thư mục gốc `travel.bling`)*

---

## 💻 2. Lệnh Chạy Bằng Terminal / PowerShell

Nếu muốn chạy bằng lệnh trong Terminal / PowerShell:

```powershell
# Bước 1: Chuyển vào thư mục eKYC-main
cd d:\xampp\htdocs\travel.bling\eKYC-main

# Bước 2: Khởi động Flask Server API
C:\Users\Legion\AppData\Local\Programs\Python\Python312\python.exe flask_api.py
```

---

## 🌐 3. Các Đường Dẫn Kiểm Tra & Sử Dụng

| Dịch vụ | Đường dẫn (URL) | Mô tả |
| :--- | :--- | :--- |
| **Cổng Tình Nguyện & Hội Viên** | `http://localhost/travel.bling/user/index.php?controller=volunteer` | Cổng thông tin Hội viên & Ma trận đặc quyền |
| **Đăng ký eKYC Tình Nguyện Viên** | `http://localhost/travel.bling/user/index.php?controller=volunteer&action=register` | Xác thực Thẻ SV (đối soát trường) & CCCD Face Match |
| **Dashboard Điểm Hội Viên** | `http://localhost/travel.bling/user/index.php?controller=volunteer&action=dashboard` | Thẻ hội viên, điểm 2 tầng & thăng hạng |
| **Sàn Đổi Voucher Tour** | `http://localhost/travel.bling/user/index.php?controller=volunteer&action=rewards` | Đổi điểm rèn luyện lấy Voucher 14% - 25% (Max 500k) |
| **Ví Vé Tour Điện Tử** | `http://localhost/travel.bling/user/index.php?controller=volunteer&action=tickets` | Vé tour đã xuất kèm ưu đãi cấp bậc |
| **Admin Quản Lý Hội Viên & eKYC** | `http://localhost/travel.bling/admin/index.php?controller=volunteer` | Admin duyệt bằng khen, điểm danh & giảm giá khu vực |
| **Flask API Health Check** | `http://127.0.0.1:5000/api/ekyc/health` | Kiểm tra trạng thái Flask Python Server |
| **API OCR CCCD** | `http://127.0.0.1:5000/api/ekyc/ocr` | Endpoint POST trích xuất thông tin CCCD |
| **API OCR Thẻ Sinh Viên** | `http://127.0.0.1:5000/api/ekyc/ocr-student-card` | Endpoint POST bóc tách Thẻ Sinh Viên |
| **API Face Match** | `http://127.0.0.1:5000/api/ekyc/face-match` | Endpoint POST đối sánh khuôn mặt VGGFace2 |

---

## 🛠️ 4. Xử Lý Khi Gặp Lỗi Cài Đặt Thư Viện

Nếu chạy bị báo thiếu thư viện Python, chạy lệnh nâng cấp / cài lại sau:

```powershell
C:\Users\Legion\AppData\Local\Programs\Python\Python312\python.exe -m pip install flask flask-cors easyocr torch torchvision opencv-python pillow
```

---

## 📁 5. Cấu Trúc Thư Mục Kết Quả Lưu Trữ

- **Ảnh CCCD & Selfie upload:** `travel.bling/img/ekyc/`
- **Kết quả OCR JSON xuất ra:** `travel.bling/eKYC-main/output/`
- **Thư mục tạm thời:** `travel.bling/eKYC-main/uploads/`
