Předpoklady:
Composer version 2.7.1 
Laravel Framework 10.14.1
"php": "^8.1"

Návod:
Nainstalovat php
Ověřit, že funguje příkaz:
php -v

Nainstalovat Composer
Ověřit instalaci:
composer -V

Klonovat projekt
git clone https://github.com/volodkaly/todo-app.git

Vytvořit .env soubor v kořenu projektu
Zkopírovat šablonu:
cp .env.example .env
Upravit připojení k databázi (DB_CONNECTION, DB_DATABASE, DB_USERNAME, DB_PASSWORD).

Přejít do kořene projektu:
cd todo-apps

spustit v terminalu příkazy:
composer install
php artisan key:generate
php artisan migrate
php artisan serve

Ověřit aplikaci lokálně podle toho, kde máte localhost, například
http://127.0.0.1:8000
