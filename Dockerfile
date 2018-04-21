FROM php:7.0-apache


#RUN apt-get update && \
#    apt-get install -y php5-mysql && \
#    apt-get clean
RUN apt-get update
RUN apt-get upgrade -y
RUN docker-php-ext-install mysqli

COPY code /var/www/html/
