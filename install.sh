#!/bin/bash
cd /home/uquicklh4x/public_html/quickly.net.co/
composer install
php artisan migrate --force
php artisan db:seed
php artisan voyager:install