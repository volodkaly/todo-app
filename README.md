<h4>Předpoklady:</h4>
Composer version 2.7.1 <br>
Laravel Framework 10.14.1<br>
"php": "^8.1"<br>
<br><br>
<h4>Návod:</h4>
Nainstalovat php<br>
Ověřit, že funguje příkaz:<br>
php -v<br>
<br><br>
Nainstalovat Composer<br>
Ověřit instalaci:<br>
composer -V<br>
<br><br>
Klonovat projekt<br>
git clone https://github.com/volodkaly/todo-app.git<br>
<br><br>
Vytvořit .env soubor v kořenu projektu<br>
Zkopírovat šablonu:<br>
cp .env.example .env<br>
Upravit připojení k databázi (DB_CONNECTION, DB_DATABASE, DB_USERNAME, DB_PASSWORD).<br>
<br><br>
Přejít do kořene projektu:<br>
cd todo-apps<br>
<br><br>
spustit v terminalu příkazy:<br>
composer install<br>
php artisan key:generate<br>
php artisan migrate<br>
php artisan serve<br>
<br><br>
Ověřit aplikaci lokálně podle toho, kde máte localhost, například<br>
http://127.0.0.1:8000<br>
