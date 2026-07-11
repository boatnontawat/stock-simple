# ใช้ PHP 8.2 พร้อม Apache เป็น Base Image
FROM php:8.2-apache

# ติดตั้ง System Dependencies ที่จำเป็นสำหรับ Laravel และ Node.js (สำหรับ Vite)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# ล้างแคชของ apt เพื่อลดขนาด Image
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# ติดตั้ง PHP Extensions ที่ Laravel ต้องใช้
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# เปิดใช้งาน Apache mod_rewrite เพื่อให้ Routing ของ Laravel ทำงานได้
RUN a2enmod rewrite

# กำหนดโฟลเดอร์ทำงานหลัก
WORKDIR /var/www/html

# ดึง Composer มาจาก Official Image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# คัดลอกไฟล์โปรเจคทั้งหมดเข้าไปใน Container
COPY . /var/www/html

# เปลี่ยน DocumentRoot ของ Apache ให้ชี้ไปที่โฟลเดอร์ public ของ Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# ติดตั้ง PHP Dependencies (ไม่รวม dev packages เพื่อใช้สำหรับ Production)
RUN composer install --no-dev --optimize-autoloader

# ติดตั้ง Node Dependencies และ Build Frontend Assets (Vite)
RUN npm install
RUN npm run build

# ตั้งค่าสิทธิ์การเข้าถึงไฟล์ให้ Apache (www-data) สามารถเขียนไฟล์ลง storage และ cache ได้
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# เปิดพอร์ต 80
EXPOSE 80