# WordPress version can be any of the listed tags from https://hub.docker.com/_/wordpress/tags
# E.g. latest, 6.2, ...
ARG WORDPRESS_VERSION=latest

# PHP Variant can be any of the listed tags from https://mcr.microsoft.com/v2/devcontainers/php/tags/list
ARG PHP_VARIANT=8.2-bullseye

FROM wordpress:${WORDPRESS_VERSION}
FROM mcr.microsoft.com/vscode/devcontainers/php:${PHP_VARIANT}

# Copy WordPress files from wordpress container.
COPY --from=0 /usr/src/wordpress/ /var/www/html/

# Make vscode owner of all WordPress files.
RUN chown -R vscode:vscode /var/www/html

# Install php-mysql driver
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable apache mods
RUN a2enmod rewrite expires

# Install wp cli
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && chmod +x wp-cli.phar && sudo mv wp-cli.phar /usr/local/bin/wp
