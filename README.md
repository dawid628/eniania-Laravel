<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Aplikacja e-niania

Tematem projektu jest serwis umożliwiający świadczenie i korzystanie z usług opiekunek do dzieci. Projekt został stworzony we frameworku Laravel.

<p>Instrukcja uruchomienia</p>
<ul>
    <li>W terminalu środowiska, w folderze docelowym klonujemy repozytorium za pomocą komendy git clone https://github.com/dawid628/ProjektZPO.git</li>
    <li>Konfigurujemy połączenie z bazą danych w pliku .env podłączając pustą, stworzoną przez nas bazę (np. w środowisku xampp)</li>
    <li>Wprowadzamy komendy uzupełniające projekt:</li>
    <ol>
        <li>composer install</li>
        <li>php artisan migrate</li>
    <li>php artisan db:seed</li>
    </ol>
    <li>Uruchamiamy projekt korzystając z komendy php artisan serve (wymagane uruchomione środowisko zarządzania bazą danych np. xampp)</li>
</ul>