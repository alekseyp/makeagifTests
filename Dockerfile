FROM php:7.1-apache

# Install WGET && Zip
RUN apt-get update --fix-missing -y
RUN apt-get install --fix-missing -y \
        wget \
        zlib1g-dev

RUN docker-php-ext-install zip

# Install Codeception
RUN wget http://codeception.com/codecept.phar -O /usr/local/bin/codecept
RUN chmod +x /usr/local/bin/codecept