# php-rest-api-router
# required php version 7.4 and higher
## This is not the final version of the router, there are no endpoints for post requests and most likely a lot more

# Instruction manual

## for those with apache , we create a file .htaccess with this code

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.+)$ index.php?q=$1 [L,QSA]

## accordingly, for those who use nginx

try_files $uri $uri/ /index.php?q=$args;