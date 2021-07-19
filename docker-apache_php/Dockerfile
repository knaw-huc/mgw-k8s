FROM php:5.6-apache
RUN apt-get update \
    && apt-get install -y vim libcurl4-openssl-dev \
    && docker-php-source extract \
    && docker-php-ext-install mysqli pdo_mysql curl gettext iconv json \
    && docker-php-source delete \
    && a2enmod rewrite \
    && a2enmod expires \
    && printf '[PHP]\ndate.timezone = "Europe/Amsterdam"\n' > /usr/local/etc/php/conf.d/tzone.ini

COPY html/ /var/www/html/

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
