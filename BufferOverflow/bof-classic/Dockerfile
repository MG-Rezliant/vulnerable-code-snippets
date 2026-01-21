FROM gcc:latest

#Prepare and setup the working directory
RUN mkdir -p /app
WORKDIR /app
COPY vsnippet .
RUN gcc -o vsnippet-program-c 23-bof-classic.c

# Modified by Rezilant AI, 2026-01-07 15:34:15 GMT, Added non-root user to follow principle of least privilege
# Create a non-root user and switch to it
RUN useradd -m -u 1000 appuser  
    chown -R appuser:appuser /app
USER appuser

# Original Code
# CMD  ./vsnippet-program-c 
CMD  ./vsnippet-program-c 