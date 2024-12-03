FROM php:8.3-fpm

# 作業ディレクトリを設定
WORKDIR /var/www/html

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
	&& apt-get install -y wget libjpeg-dev libfreetype6-dev \
	&& apt-get update \
	&& apt-get upgrade -y \
	&& apt-get install -y libzip-dev libwebp-dev libjpeg-dev libpng-dev libicu-dev libxml2-dev libxslt1-dev zlib1g-dev g++ zip unzip libonig-dev \
	&& apt-get remove cmdtest \
	&& apt-get install -y libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install bcmath calendar exif zip gd gettext intl mysqli pcntl pdo_mysql soap sockets xsl opcache