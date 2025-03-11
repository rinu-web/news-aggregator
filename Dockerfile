# Use official PHP image
FROM php:8.2-cli

# Set working directory
WORKDIR /var/www

# Install required extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy project files into container
COPY . .

# Expose port 8000
EXPOSE 8000

# Start Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
