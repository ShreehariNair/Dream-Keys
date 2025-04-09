# Use the official PHP image
FROM php:7.4-apache

# Install required extensions (e.g., mysqli, pdo, pdo_mysql)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy all files from the current directory into the container
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
RUN echo "DirectoryIndex home.php" >> /etc/apache2/sites-available/000-default.conf
# Command to run Apache in the foreground
CMD ["apache2-foreground"]
