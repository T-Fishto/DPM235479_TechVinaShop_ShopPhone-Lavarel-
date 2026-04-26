#!/bin/bash

# Chờ database sẵn sàng (tùy chọn, nhưng nên có nếu db nằm ở server khác)
echo "Waiting for database..."

# Sửa quyền hạn ngay khi khởi động (Đảm bảo không bị Permission denied)
echo "Fixing permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Chạy migrations tự động khi deploy (Tạm thời thêm || true để tránh sập container nếu chưa có DB)
echo "Running migrations..."
php artisan migrate --force || true

# Xóa và tạo lại cache để tối ưu hiệu năng
echo "Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Khởi động Apache ở chế độ foreground
echo "Starting Apache..."
apache2-foreground
