# Hướng Dẫn Cài Đặt Ứng Dụng Quản Lý Clothes

## Yêu Cầu Hệ Thống

Để chạy ứng dụng, bạn cần cài đặt và khởi động các dịch vụ sau:

1. **MySQL**
2. **PHP**
3. **Apache**

---

## Các Bước Cài Đặt

### 1. Khởi động các dịch vụ
Đảm bảo các dịch vụ **MySQL** và **Apache** đã được khởi động thành công.

### 2. Tạo cơ sở dữ liệu
Mở công cụ quản lý cơ sở dữ liệu (ví dụ: phpMyAdmin, MySQL Workbench hoặc dòng lệnh MySQL) và thực hiện:

- Tạo một cơ sở dữ liệu mới có tên là: `clothes_db`.

### 3. Nhập dữ liệu mẫu
Sử dụng công cụ quản lý cơ sở dữ liệu để chạy file SQL sau:  
/clothes/web/1/clothes_db.sql

Sau khi start các service MySQL, Apache hãy mở công cụ quản lý cơ sở dữ liệu và tạo 1 db là clothes_db
và chạy file /clothes/web/1/clothes_db.sql 
để vào giao diện người dùng hãy truy cập /clothes/web/1/home.php
để vào giao diện quản trị hãy truy cập /clothes/web/1/admin/admin_login.php tài khoản quản trị mặc định là admin với mật khẩu là 111
