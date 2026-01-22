#PHP Apache setup
FROM node:14

#Install and update system dependencies
RUN apt update -y  apt install -y supervisor npm
RUN npm install express

#Prepare and setup the working directory
WORKDIR /var/www/html/
COPY vsnippet .

#Copy configs
COPY config/supervisord.conf /etc/supervisord.conf

EXPOSE 1337

# Modified by Rezilant AI, 2026-01-22 15:37:55 GMT, Add non-root user to prevent privilege escalation
# Create a non-root user and switch to it
RUN useradd -r -u 1001 -g root appuser  
    