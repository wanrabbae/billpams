#!/bin/bash
# ==============================================================================
# Script Instalasi LEMP Stack Otomatis (Ubuntu 24.04 LTS) untuk Laravel 11
# Domain: billpam.com
# ==============================================================================

DOMAIN="billpam.com"
DB_NAME="billpam_db"
DB_USER="billpam_user"
DB_PASS="BillpamSaaS2026!Secret"

echo "================================================="
echo "Mulai instalasi LEMP Stack untuk $DOMAIN..."
echo "================================================="

# 1. Update OS & Install Dependencies
echo "[1/7] Update sistem dan instal modul dasar..."
sudo apt update && sudo apt upgrade -y
sudo apt install -y curl wget git unzip software-properties-common

# 2. Install Nginx
echo "[2/7] Instalasi Nginx..."
sudo apt install -y nginx
sudo systemctl enable nginx
sudo systemctl start nginx

# 3. Install MariaDB
echo "[3/7] Instalasi MariaDB (Database)..."
sudo apt install -y mariadb-server
sudo systemctl enable mariadb
sudo systemctl start mariadb

# Konfigurasi Database untuk Laravel
echo "Membuat database dan user..."
sudo mysql -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME};"
sudo mysql -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';"
sudo mysql -e "GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

# 4. Install PHP 8.3 (Bawaan Ubuntu 24.04) dan Ekstensinya
echo "[4/7] Instalasi PHP 8.3..."
sudo apt install -y php8.3-fpm php8.3-mysql php8.3-mbstring php8.3-xml php8.3-bcmath php8.3-curl php8.3-zip php8.3-gd php8.3-intl

# 5. Install Composer & Node.js
echo "[5/7] Instalasi Composer & Node.js..."
# Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
# Node.js (V20 LTS)
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt-get install -y nodejs

# 6. Setup Direktori Aplikasi
echo "[6/7] Menyiapkan direktori aplikasi..."
sudo mkdir -p /var/www/$DOMAIN
sudo chown -R $USER:$USER /var/www/$DOMAIN

# 7. Konfigurasi Nginx (Virtual Host)
echo "[7/7] Membuat Nginx Server Block..."
cat <<EOF | sudo tee /etc/nginx/sites-available/$DOMAIN
server {
    listen 80;
    listen [::]:80;
    server_name $DOMAIN www.$DOMAIN;
    root /var/www/$DOMAIN/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php index.html;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

sudo ln -s /etc/nginx/sites-available/$DOMAIN /etc/nginx/sites-enabled/
# Hapus default nginx jika masih ada
sudo rm -f /etc/nginx/sites-enabled/default
sudo systemctl reload nginx

echo "================================================="
echo "Instalasi Selesai! 🎉"
echo "Direktori Aplikasi : /var/www/$DOMAIN"
echo "Database Name      : $DB_NAME"
echo "Database User      : $DB_USER"
echo "Database Password  : $DB_PASS"
echo "================================================="
echo "LANGKAH BERIKUTNYA UNTUK ANDA (JALANKAN MANUAL):"
echo "1. Upload source code zip atau clone git ke dalam /var/www/$DOMAIN"
echo "2. Masuk ke folder aplikasi (cd /var/www/$DOMAIN)"
echo "3. Lakukan instalasi dependensi:"
echo "   - cp .env.example .env"
echo "   - (Edit .env, masukkan info database di atas)"
echo "   - composer install --optimize-autoloader --no-dev"
echo "   - php artisan key:generate"
echo "   - php artisan migrate:fresh --seed"
echo "   - php artisan storage:link"
echo "   - npm install && npm run build"
echo "4. Terakhir, set permission:"
echo "   - sudo chown -R www-data:www-data /var/www/$DOMAIN/storage /var/www/$DOMAIN/bootstrap/cache"
echo "   - sudo chmod -R 775 /var/www/$DOMAIN/storage /var/www/$DOMAIN/bootstrap/cache"
echo "================================================="
