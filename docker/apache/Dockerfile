# Create base image
FROM public.ecr.aws/b6l5k5p0/base-image as base

COPY ./docker/phpfpm/local.ini /usr/local/etc/php/conf.d/local.ini

# Install composer dependencies
FROM base as deps
ARG APP_HOME=/var/www/html
RUN rm -rf $APP_HOME && mkdir $APP_HOME
WORKDIR $APP_HOME
COPY . $APP_HOME

RUN php -v
RUN php $APP_HOME/composer.phar install --prefer-dist --no-scripts --no-progress --no-interaction --optimize-autoloader --no-dev --ignore-platform-req=ext-gd $ARGS
RUN php $APP_HOME/composer.phar dump-autoload --classmap-authoritative

# Application Image
FROM base
ARG DOT_ENV
ENV DOT_ENV=$DOT_ENV
ARG APP_HOME=/var/www/html
ENV APP_HOME=$APP_HOME
RUN rm -rf $APP_HOME && mkdir $APP_HOME
WORKDIR $APP_HOME

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
COPY ./docker/apache/apache.conf /etc/apache2/sites-available/000-default.conf
ADD ./docker/apache/start.sh /

# Turn on mod_rewrite otherwise index.php will appear in the URL
RUN a2enmod rewrite
# change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
RUN chown -R www-data:www-data $APP_HOME
USER www-data

# Copy source files
COPY --from=deps --chown=www-data:www-data $APP_HOME $APP_HOME
RUN echo "$DOT_ENV"
RUN echo "$DOT_ENV" > $APP_HOME/.env

EXPOSE 80

# Add crontab script
USER root
# Copy cron file to the cron.d directory
ADD ./docker/scheduler/crontab /etc/cron.d/scheduler-cron
# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/scheduler-cron
# Apply cron job
RUN crontab /etc/cron.d/scheduler-cron

# Change to root otherwise apache won't start
USER root
RUN chmod +x /start.sh

ENTRYPOINT ["/start.sh"]
