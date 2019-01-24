<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

Isjeady Youtube Video [Youtube](https://www.youtube.com/channel/UC1fhZ1C2E-UOZjeIvm1XpWw) e [isjeady.com](https://isjeady.com) 

# Corso Laravel e Applicazione Crypto Portfolio
Crea un applicazione per imparare come usare **Laravel**

## Cloniamo il Repository

- Assicurati di avere installato Git sul sistema,scrivendo sulla linea di comando
```
git --version
```
Se il comando risponde hai Git sul tuo Pc altrimenti [Clicca Qui](https://git-scm.com/download/win) per scaricarlo e installarlo.

- Esegui il Comando
```
git clone https://github.com/isjeady/corsoLaravelPortfolioCrypto.git
```
- Ora spostati nel directory del progetto con il seguente comando
```
cd corsoLaravelPortfolioCrypto\
```

## Installiamo le Dipendenze

- Ora sei all'interno della cartella del project lancia il comando
```
composer install
```
per installare tutte le dipendenze,se il non hai composer installalo, [Clicca Qui](https://getcomposer.org/download/).
Per installare tutto avrà bisogno di un po di tempo.

- Esegui il Comando
```
npm install
```
per installare tutte le dipendenze,se il non hai npm installa Node Js, [Clicca Qui](https://nodejs.org/en/download/).
Per installare tutto avrà bisogno di un po di tempo.


## Configuriamo il file di Config di Laravel .env

- Copia o Duplica il file .env.backup in un file rinominandolo .env oppure lancia il seguente comando
```
cp .env.backup .env
```
- Apri il file con un editor di testo e modifica le seguenti righe con i tuoi parametri di connessione al Db Mysql,
Nome Database,Username e Password.Il Database lo devi creare manualmente,puoi utilizzare un tool che utilizzo io
nei video per facilitarti la creazione ovvero  [Heidisql](https://www.heidisql.com/)

```
DB_DATABASE=laravelisjeady
DB_USERNAME=root
DB_PASSWORD=root
```
Salva il file una volta configurato e lancia il comando:
```
php artisan migrate
```
Se hai configurato correttamente la connessione non dovresti avere problemi in questa fase.


## Comandi Laravel

- Importare i dati all'interno del Database Sql,esegui il comando:
```
php artisan db:seed --class=ImportSqlSeeder
```
- Ora possiamo lanciare il server Laravel con il comando

```
php artisan serve
```
- Collegati all'indirizzo [http://localhost:8000](http://localhost:8000)
- Nella Pagina iniziale clicca in alto a destra per effettuare la Login.
```
username: admin@admin.com
password: adminadmin
```
- L'applicazione è pronta, se hai qualche problema durante queste fasi scrivimi pure alla mail **info@isjeady.com**


Git clone repository
```
git clone https://github.com/isjeady/corsoLaravelPortfolioCrypto.git
```
***All code released under the [MIT License](https://opensource.org/licenses/MIT)***