# php-rest-api-router
# required php version 7.4 and higher
# This is not the final version of the router, there are no endpoints for post requests and most likely a lot more

## For Apache add .htaccess
```php
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.+)$ index.php?q=$1 [L,QSA]
```

## For Nginx add in config
```php
    try_files $uri $uri/ /index.php?q=$args;
```
