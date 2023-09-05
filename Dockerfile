FROM php:8.2-fpm

# Install necessary dependencies
# Install the development files for the libzip library
# Install the zip utility
# Install the unzip utility
RUN apt-get update && apt-get install -y \
    libzip-dev \  
    zip \         
    unzip         

# Install the PHP zip extension
RUN docker-php-ext-install zip

# Download Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory to /app/
WORKDIR /app/

# Copy the contents of the current directory to the /app/ directory in the container
COPY . /app/

# Install the project dependencies using Composer
RUN composer install

# Install the Xdebug extension
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug


COPY ./conf.d/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  
COPY ./conf.d/error_reporting.ini /usr/local/etc/php/conf.d/error_reporting.ini  
