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
Upravit připojení k databázi (DB_DATABASE, DB_USERNAME, DB_PASSWORD).<br>
<br><br>
Přejít do kořene projektu:<br>
cd todo-app<br>
<br><br>
spustit v terminalu příkazy:<br>
composer install<br>
php artisan key:generate<br>
php artisan migrate<br>
php artisan serve<br>
<br><br>
Ověřit aplikaci lokálně podle toho, kde máte localhost, například<br>
http://127.0.0.1:8000<br>

<h4>Popis:</h4>
Nově vytvořený úkol má status "nesplněno, nedokončeno".<br>
Status lze změnit tlačítkem na hlavní stránce.<br>
Tabulka má adaptivní design: přizpůsobuje se šířce okna.<br>
Je zohledněný případ, že název nebo popis úkolu bude přilíš dlouhý.<br>
To nedokáže zničit vzhled nebo čítelnost tabulky.<br>
V tomto případě se na hlavní stránce zobrazí jen část dlouhého textu.<br>
Zbytek se elegantně ořízne.<br>
<br>
Vnitřní nástroje frameworku Laravel poskytují dostatečnou ochranu před XSS a SQL útoky.<br>
Nicméně na výstupu v zobrazení v šablonách .blade text dříve zadaný uživatelem je navíc opatřen metodou PHP htmlspecialchars()<br> 
(metoda je zde použita pro úkazku, Laravel sám ošetřuje XSS).<br>
Uživatel je informován o chybách při zadávání (prázdné pole, minulé datum).<br>


<img width="1903" height="725" alt="image" src="https://github.com/user-attachments/assets/9141e605-1f55-4d62-857c-d72aeeb9efc2" />
