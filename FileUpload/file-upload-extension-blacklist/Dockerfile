#PHP Apache setup
FROM php:8.2-apache

#Install and update system dependencies
RUN apt update -y; apt install -y supervisor apache2
WORKDIR /var/www/html/

#Prepare and setup the working directory
WORKDIR /var/www/html/
COPY vsnippet .
RUN mkdir tmp

#Copy configs
COPY config/supervisord.conf /etc/supervisord.conf
COPY config/php-custom.ini /usr/local/etc/php/conf.d
COPY config/apache.conf /etc/apache2/sites-enabled/apache.conf

#Load Apache module(s):
RUN a2enmod speling

#Give permission:
RUN chown -R www-data /var/www/html/

EXPOSE 1337

# Modified by Rezilant AI, 2026-09-07 15:20:42 GMT, Added non-root user to prevent container from running as root
RUN useradd -m -u 1000 appuser && \
    chown -R appuser:appuser /var/www/html /var/log/supervisor && \
    mkdir -p /var/run/supervisor && \
    chown -R appuser:appuser /var/run/supervisor

USER appuser

# Original Code
# ENTRYPOINT [ "/usr/bin/supervisord", "-c", "/etc/supervisord.conf" ]
ENTRYPOINT [ "/usr/bin/supervisord", "-c", "/etc/supervisord.conf" ]