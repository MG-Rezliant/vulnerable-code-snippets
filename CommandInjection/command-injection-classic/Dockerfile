FROM python:3

#Install and update system dependencies
RUN apt update -y apt install -y supervisor curl
RUN pip install flask

#Prepare and setup the working directory
RUN mkdir -p /app
WORKDIR /app
COPY vsnippet .
COPY config/supervisord.conf /etc/supervisord.conf

EXPOSE 1337

#Disable pycache
ENV PYTHONDONTWRITEBYTECODE=1

# Modified by Rezilant AI, 2026-01-20 15:38:50 GMT, Added non-root user to prevent privilege escalation
# Create a non-root user and group
RUN groupadd -r appuser  usera