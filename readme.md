# Yet Another Multi-auth Starter for Laravel



### nginx config example

```
# user domain, www.myapp.test
server {
    listen 80;

    server_name www.myapp.test;

    root /var/code/laravel-subdomain-multi-auth-starter/public;
    index index.php index.html index.htm;

    access_log /usr/local/var/log/nginx/www.myapp.test-access.log;
    error_log /usr/local/var/log/nginx/www.myapp.test-error.log;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~* \.php$ {
        try_files $uri = 404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}


# admin domain, admin.myapp.test
server {
    listen 80;

    server_name admin.myapp.test;

    root /var/code/laravel-subdomain-multi-auth-starter/public;
    index index.php index.html index.htm;

    access_log /usr/local/var/log/nginx/admin.myapp.test-access.log;
    error_log /usr/local/var/log/nginx/admin.myapp.test-error.log;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~* \.php$ {
        try_files $uri = 404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```