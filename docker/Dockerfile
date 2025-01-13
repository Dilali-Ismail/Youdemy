# Use official PHP image with Apache
FROM php:8.2-apache

# Install MySQL PDO extensions (mysqli, pdo, pdo_mysql)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite to support .htaccess
RUN a2enmod rewrite

# Allow .htaccess to override Apache configurations (e.g., DocumentRoot)
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Optional: Set the working directory to /var/www/html (for consistency)
WORKDIR /var/www/html

# Expose Apache's port 80 (default for HTTP)
EXPOSE 80

