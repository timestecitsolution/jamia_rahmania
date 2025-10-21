# Use PHP 5.6 with Apache
FROM php:5.6-apache

# Install required extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (important for CI2/CI3)
RUN a2enmod rewrite

# Copy project files to container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Ensure Apache allows .htaccess overrides
RUN sed -i 's|AllowOverride None|AllowOverride All|g' /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80
