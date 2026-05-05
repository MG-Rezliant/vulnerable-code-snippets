#PHP Apache setup
FROM php:8.2-apache

#Install and update system dependencies
RUN apt update -y; apt install -y supervisor apache2
WORKDIR /var/www/html/

#Prepare and setup the working directory
WORKDIR /var/www/html/
COPY vsnippet .

#Copy configs
COPY config/supervisord.conf /etc/supervisord.conf
COPY config/apache.conf /etc/apache2/sites-enabled/apache.conf

#Give permission:
#RUN chown -R www-data /var/www/html/

EXPOSE 1337

# Modified by Rezilant AI, 2026-05-05 12:10:19 GMT, Adding non-root user for container security
# Create a non-root user and switch to it
RUN addgroup -S appgroup && adduser -S appuser -G appgroup

# Ensure the user has permissions to necessary directories
RUN chown -R appuser:appgroup /var/log/supervisor /var/run

# Switch to non-root user
USER appuser

# Original Code
#ENTRYPOINT [ "/usr/bin/supervisord", "-c", "/etc/supervisord.conf" ]

ENTRYPOINT [ "/usr/bin/supervisord", "-c", "/etc/supervisord.conf" ]