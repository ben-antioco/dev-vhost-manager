# dev-vhost-manager
Pour les développeur web : Gestion des vhosts dans le localhost

### Installation
```sh
cd dev-vhost-manager && make install
```


Créer une base de données "local_db"
```sh
mysql -h 127.0.0.1 -u root -p local_db
```

Copier le fichier config.php.dist en config.php, renseigner les info de votre base de données
```sh
cp config.php.dist config.php
```

### Apache - vhost.conf
```sh
<VirtualHost *:80>

    ServerAdmin root@email.local
    DocumentRoot "/your/dir/www/dev-vhost-manager"
    ServerName local.local
    ServerAlias local.local
    ErrorLog "/your/dir/www/httpd_logs/local.dom-error_log"
    CustomLog "/your/dir/www/httpd_logs/local.dom-access_log" common

    <Directory "/your/dir/www/dev-vhost-manager">
        AllowOverride All
        Require all granted
        Order allow,deny
        Allow from all
    </Directory>

</VirtualHost>
```

### Développement mode
```sh
cd dev-vhost-manager && make watch
```

### Production mode
```sh
cd dev-vhost-manager && make prod
```
