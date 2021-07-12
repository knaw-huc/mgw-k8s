FROM ubuntu:16.04

RUN apt-get update && apt-get install -y apache2 php php7.0-cli php7.0-mysql php7.0-curl php7.0-fpm libapache2-mod-php curl mysql-client vim
COPY apache2.conf /etc/apache2/
COPY 000-default.conf /etc/apache2/sites-available/
RUN a2enmod rewrite && a2enmod expires
COPY html/ /var/www/html/
RUN rm /var/www/html/index.html

EXPOSE  80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
