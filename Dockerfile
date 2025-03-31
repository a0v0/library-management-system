FROM php:apache

RUN docker-php-ext-install mysqli 
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
