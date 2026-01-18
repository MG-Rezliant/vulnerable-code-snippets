FROM golang:latest

#Install and update system dependencies
RUN apt update -y apt install -y supervisor

#Prepare and setup the working directory
RUN mkdir -p /app
WORKDIR /app
COPY vsnippet .
COPY config/supervisord.conf /etc/supervisord.conf

EXPOSE 1337

# Modified by Rezilant AI, 2026-01-07 15:33:59 GMT, Added non-root user to prevent container from running as root
# Create a non-root user and switch to it
RUN useradd -m -u 1000 appuser  
    chown -R appuser:appuser /app
USER appuser

#