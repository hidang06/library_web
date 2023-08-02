# Use the official PHP with Apache base image
FROM php:8.0-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy your PHP application files to the container's web server directory
COPY . .

# Set proper ownership for the files inside the container
RUN chown -R www-data:www-data /var/www/html
