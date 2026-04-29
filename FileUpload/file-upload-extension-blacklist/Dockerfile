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

# Modified by Rezilant AI, 2026-04-29 10:00:13 GMT, Create non-root user and switch to it for security
# Create a non-root user and switch to it
RUN useradd -r -u 1001 -g root appuser && \
    chown -R appuser:root /var/www/html/ && \
    chmod -R g=u /var/www/html/ && \
    chown appuser:root /etc/supervisord.conf && \
    chmod g=u /etc/supervisord.conf

USER appuser

# Original Code
#ENTRYPOINT [ "/usr/bin/supervisord", "-c", "/etc/supervisord.conf" ]

ENTRYPOINT [ "/usr/bin/supervisord", "-c", "/etc/supervisord.conf" ]