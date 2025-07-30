# Étape Composer pour installer les deps
FROM composer:2 AS composer_deps
WORKDIR /app
COPY composer.json composer.lock symfony.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Étape build front-end SI tu utilises encore Encore/yarn
FROM node:16 AS frontend
WORKDIR /app
COPY package.json yarn.lock ./
RUN yarn install --frozen-lockfile
COPY assets/ assets/
RUN yarn encore production

# Image finale pour production
FROM php:8.2-fpm-alpine
WORKDIR /app
RUN apk add --no-cache nginx bash
COPY --from=composer_deps /app/vendor /app/vendor
COPY --from=frontend /app/public/build /app/public/build
COPY . /app

# Copie de config nginx/php-fpm si besoin (optionnel, adapte ton projet)
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.conf

EXPOSE 8080
CMD ["nginx", "-g", "daemon off;"]
