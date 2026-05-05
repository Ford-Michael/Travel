import cv2
import sys

# Biến toàn cục để lưu tọa độ
current_x, current_y = -1, -1

def mouse_callback(event, x, y, flags, param):
    global current_x, current_y
    img_copy = img.copy()
    height, width = img_copy.shape[:2]

    # Cập nhật tọa độ khi chuột di chuyển
    if event == cv2.EVENT_MOUSEMOVE:
        current_x, current_y = x, y
        
        # Vẽ thanh ngang (màu đỏ)
        cv2.line(img_copy, (0, y), (width, y), (0, 0, 255), 1)
        # Vẽ thanh dọc (màu đỏ)
        cv2.line(img_copy, (x, 0), (x, height), (0, 0, 255), 1)
        
        # Hiển thị text tọa độ
        text = f"X: {x}, Y: {y}"
        cv2.putText(img_copy, text, (x + 10, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 255, 0), 2)
        
        cv2.imshow("Cong Cu Xac Dinh Toa Do (Bam ESC de thoat)", img_copy)

    # In ra console khi click chuột trái
    elif event == cv2.EVENT_LBUTTONDOWN:
        print(f"[*] Đã chọn điểm: X = {x}, Y = {y}")

if __name__ == "__main__":
    # Tên file ảnh cần xác định tọa độ
    image_path = "Screenshot 2026-05-01 150327.png"
    
    # Đọc ảnh
    img = cv2.imread(image_path)
    if img is None:
        print(f"Lỗi: Không thể mở file '{image_path}'. Vui lòng kiểm tra lại tên file.")
        sys.exit()

    # Tạo cửa sổ hiển thị
    window_name = "Cong Cu Xac Dinh Toa Do (Bam ESC de thoat)"
    cv2.namedWindow(window_name, cv2.WINDOW_AUTOSIZE)
    
    # Đăng ký hàm xử lý sự kiện chuột
    cv2.setMouseCallback(window_name, mouse_callback)

    print("--- HƯỚNG DẪN SỬ DỤNG ---")
    print("1. Di chuyển chuột: Hai thanh ngang/dọc màu đỏ sẽ chạy theo để giúp bạn dóng hàng.")
    print("2. Click chuột trái: Lưu và in tọa độ (X, Y) hiện tại ra màn hình console.")
    print("3. Nhấn phím 'ESC' hoặc 'q' để thoát.")

    # Hiển thị ảnh lần đầu
    cv2.imshow(window_name, img)

    # Vòng lặp chờ phím tắt để thoát
    while True:
        key = cv2.waitKey(1) & 0xFF
        if key == 27 or key == ord('q'): # Phím ESC hoặc phím 'q'
            break

    cv2.destroyAllWindows()
