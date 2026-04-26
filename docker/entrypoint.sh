#!/bin/bash

# Chờ database sẵn sàng (tùy chọn, nhưng nên có nếu db nằm ở server khác)
echo "Waiting for database..."

# Chạy migrations tự động khi deploy
echo "Running migrations..."
php artisan migrate --force

# Xóa và tạo lại cache để tối ưu hiệu năng
echo "Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Khởi động Apache ở chế độ foreground
echo "Starting Apache..."
apache2-foreground
