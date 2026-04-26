# Stage 1 - Build Frontend (Vite)
FROM node:18-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2 - Backend (Laravel + PHP + Apache)
FROM php:8.2-apache-bullseye AS backend

# Cài đặt các thư viện hệ thống và PHP Extensions
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip gd bcmath intl exif opcache

# Enable Apache modules (Cần thiết cho Laravel)
RUN a2enmod rewrite

# Cấu hình Apache cho Laravel
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Cài đặt Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy file composer trước để tối ưu build
COPY composer.json composer.lock* ./
RUN composer install --no-dev --no-scripts --no-autoloader

# Copy toàn bộ source code
COPY . .

# Copy frontend assets đã build từ Stage 1
COPY --from=frontend /app/public/build ./public/build

# Optimizing composer
RUN composer dump-autoload --optimize

# Thiết lập quyền hạn cho Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copy và thiết lập quyền cho script entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Render sử dụng biến môi trường PORT, Apache mặc định là 80. 
# Ta có thể ép Apache nghe đúng cổng của Render hoặc cấu hình Render dùng cổng 80.
EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]