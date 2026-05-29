#PHP Apache setup
FROM php:8.2-apache

#Install and update system dependencies
RUN apt update -y 
     apt install -y supervisor apache2 
     docker-php-ext-install mysqli 
     docker-php-ext-enable mysqli

#Prepare and setup the working directory
WORKDIR /var/www/html/
COPY vsnippet .

#Copy configs
COPY config/supervisord.conf /etc/supervisord.conf
COPY config/apache.conf /etc/apache2/sites-enabled/apache.conf

EXPOSE 1337

# Modified by Rezilant AI, 2026-01-20 12:05:23 GMT, Add non