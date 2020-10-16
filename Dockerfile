FROM quay.io/alexcheng1982/apache2-php7:7.3.12

LABEL maintainer="randy.esplin@gmail.com"
LABEL php_version="7.3.12"
LABEL magento_version="2.3.5-p1"
LABEL description="Magento 2.3.5-p1 with PHP 7.3.12"

ENV MAGENTO_VERSION 2.3.5-p1
ENV INSTALL_DIR /var/www/html
ENV COMPOSER_HOME /var/www/.composer/

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer
COPY ./auth.json $COMPOSER_HOME

RUN requirements="libpng++-dev libzip-dev libmcrypt-dev libmcrypt4 libcurl3-dev libfreetype6 libjpeg-turbo8 libjpeg-turbo8-dev libfreetype6-dev libicu-dev libxslt1-dev unzip" \
    && apt-get update \
    && apt-get install -y $requirements \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl \
    && docker-php-ext-install xsl \
    && docker-php-ext-install soap \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install sockets

# Install and configure XDebug.
# Eventually we can refactor this to COPY or ADD a local xdebug.ini file.
RUN pecl install xdebug; \
        docker-php-ext-enable xdebug; \
        echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xxdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.idekey=docker" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini;

RUN yes '' | pecl install mcrypt-1.0.3 \
    && echo 'extension=mcrypt.so' > /usr/local/etc/php/conf.d/mcrypt.ini

RUN chsh -s /bin/bash www-data

RUN chown -R www-data:www-data /var/www

# Add php flag to ensure composer doesn't run out of memory - https://stackoverflow.com/a/49212550
RUN su www-data -c "php -d memory_limit=-1 /usr/local/bin/composer create-project --repository-url=https://repo.magento.com/ magento/project-community-edition $INSTALL_DIR $MAGENTO_VERSION"

#COPY ./dev/composer.json /var/www/html
#RUN su www-data -c "php -d memory_limit=-1 /usr/local/bin/composer update"

# Fix permissions on folders and files.
# Make 'bin/magento' executable.
# Can take a while.
RUN cd $INSTALL_DIR \
    && find . -type d -exec chmod 770 {} \; \
    && find . -type f -exec chmod 660 {} \; \
    && chmod u+x bin/magento

# Copy over Magento install script and make it executable.
COPY ./install-magento /usr/local/bin/install-magento
RUN chmod +x /usr/local/bin/install-magento

#COPY ./install-sampledata /usr/local/bin/install-sampledata
#RUN chmod +x /usr/local/bin/install-sampledata

# Fix permissions
RUN usermod -u 1000 www-data

RUN a2enmod rewrite
RUN echo "memory_limit=2048M" > /usr/local/etc/php/conf.d/memory-limit.ini

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

WORKDIR $INSTALL_DIR

# Add cron job
ADD crontab /etc/cron.d/magento2-cron
RUN chmod 0644 /etc/cron.d/magento2-cron \
    && crontab -u www-data /etc/cron.d/magento2-cron

VOLUME $INSTALL_DIR
