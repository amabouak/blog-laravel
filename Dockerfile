FROM php:8.2-apache

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libpng-dev libonig-dev libxml2-dev zip \
    libfreetype6-dev libjpeg62-turbo-dev libwebp-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp

# Activer mod_rewrite + config Apache
RUN a2enmod rewrite \
    && sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
    && echo "<Directory /var/www/html/public>\n    AllowOverride All\n</Directory>" >> /etc/apache2/sites-available/000-default.conf

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier tout le code dans le conteneur
COPY . /var/www/html

# Configurer les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Installer les dépendances PHP + compiler Laravel
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader \
    && composer dump-autoload \
    && php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 80
CMD ["apache2-foreground"]