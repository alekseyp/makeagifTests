FROM php:7.1-apache

# Install WGET
RUN apt-get update --fix-missing -y
RUN apt-get install --fix-missing -y wget

RUN wget http://codeception.com/codecept.phar -O /usr/local/bin/codecept
RUN chmod +x /usr/local/bin/codecept