FROM php:7.4-fpm

WORKDIR /var/www

RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html

WORKDIR /var/www/html

#CMD bash -c "cp docker-entrypoint.sh / && \
#    chmod +x docker-entrypoint.sh \
#    ./docker-entrypoint.sh && \
#    php-fpm"


CMD bash -c "cp docker-entrypoint.sh /usr/local/bin && \
    chmod +x /usr/local/bin/docker-entrypoint.sh && \
    ln -s usr/local/bin/docker-entrypoint.sh && \
    /usr/local/bin/docker-entrypoint.sh && \
    php-fpm"

#ENTRYPOINT ["/bin/sh", "docker-entrypoint.sh"]
