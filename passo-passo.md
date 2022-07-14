# Passo passo progetto di team - Boolbnb:

## 14/07:
1. Installare laravel:
- composer create-project --prefer-dist laravel/laravel:^7.0 (nomeFile);

2. Installare dipendenze:
- npm i;

3. Installare Bootstrap:
- npm i bootstrap;

4. Installare laravel UI (per log-in e signin):
- composer require laravel/ui:^2.4;
- php artisan ui vue --auth;
- npm i && npm run dev;

5. Lanciare il programma e watch:
- php artisan serve;
- npm run watch;

6. Per usare Bootstrap 5 invece di 4 controllare => "devDependencies" in package.json:
- cambiare "bootstrap": "^4.0.0" in "bootstrap": "^5.0.0". 
- rilanciare npm i;
- php artisan serve;
- npm run watch;
(Prova del nove => Public->css->app.css deve esserci scritto: Bootstrap v5.1.3 (https://getbootstrap.com/)).

## Inizializzazione per chi clona
1. Clonare il progetto e installare:
- crea .env e sitstema il db
- npm i
- composer i
- nmp install vue-router@3
- npm run watch
- php artisan serve;

## Nuovo DB:
1. Lanciare mysql:
- mysql -uroot -proot;

2. Creare database:
- create database (nomeDatabase);

3. Imposta dati per mysql in .env

