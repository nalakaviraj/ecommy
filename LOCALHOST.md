# Run Ecommy on localhost

## Requirements
- PHP 8.2+ and Composer
- A MySQL/MariaDB database (or use Docker below)
- PHP extensions: `pdo_mysql`, `mysqli`, `curl`, `mbstring`, `openssl`, `zip` (and `gd` recommended)

## Install dependencies
```bash
composer install
```

If your PHP is missing `ext-gd`, install it (recommended). As a workaround you can run:
```bash
composer install --ignore-platform-req=ext-gd
```

## Configure env
```bash
cp .env.example .env
php artisan key:generate
```

## Start the app
Start the built-in dev server from the project root:
```bash
php artisan serve --host=127.0.0.1 --port=8000
# or: php -S 127.0.0.1:8000 -t public server.php
```

Open:
- `http://127.0.0.1:8000/` (redirects to installer until DB is ready)

If `php artisan` cannot connect to MySQL due to an overridden shell env var, run:
```bash
unset DB_PASSWORD
```
Or prefix commands with the correct value, for example:
```bash
DB_PASSWORD=root php artisan serve --host=127.0.0.1 --port=8000
```

## Database (Docker option)
```bash
docker run --name ecommy-mysql -d \
  -e MYSQL_ROOT_PASSWORD=root \
  -e MYSQL_DATABASE=ecommy \
  -p 3306:3306 \
  mysql:8.0
```

Installer values:
- `DB_HOST`: `127.0.0.1`
- `DB_DATABASE`: `ecommy`
- `DB_USERNAME`: `root`
- `DB_PASSWORD`: `root`

## Installer SQL
The installer imports a base database dump from `shop.sql` in the project root. If you don’t have it yet, add it before running the “Import SQL” step.
