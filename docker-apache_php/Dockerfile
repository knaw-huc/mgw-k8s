FROM ubuntu:16.04

RUN apt-get update
RUN apt-get install -y apache2
RUN apt-get install -y php php7.0-cli php7.0-mysql php7.0-curl php7.0-fpm libapache2-mod-php
RUN apt-get install -y curl mysql-client vim
COPY apache2.conf /etc/apache2/
RUN a2enmod rewrite
RUN a2enmod expires
COPY html/ /var/www/html/

EXPOSE  80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
