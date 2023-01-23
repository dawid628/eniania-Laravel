# E-niania

<p>Instrukcja uruchomienia:</p>
<ul>
    <li>W terminalu środowiska, w folderze docelowym klonujemy repozytorium za pomocą komendy 'git clone https://github.com/dawid628/ProjektZPO.git'</li>
    <li>Konfigurujemy połączenie z bazą danych w pliku .env podłączając pustą, stworzoną przez nas bazę (np. w środowisku xampp)</li>
    <li>Wprowadzamy komendy uzupełniające projekt:</li>
    <ol>
        <li>'composer install'</li>
        <li>'php artisan migrate'</li>
    <li>'php artisan db:seed'</li>
    </ol>
    <li>Uruchamiamy projekt korzystając z komendy 'php artisan serve' (wymagane uruchomione środowisko zarządzania bazą danych np. xampp)</li>
</ul>

Projekt został stworzony w celu ułatwienia świadczenia usług opieki nad dziećmi. Jest to aplikacja internetowa, która ułatwia szukanie opiekunów do dzieci. Serwis zawiera przestrzeń na zamieszczanie i przeglądanie ogłoszeń, wystawianie opinii, korespondencję między użytkownikami, kontakt z administracją i zarządzanie treścią poprzez panel administratora.
Oprogramowanie zostało stworzone za pomocą frameworka Laravel. Backend oparty jest na języku PHP, wszystkie dane przechowuje w połączonej bazie danych. Frontend został stworzony z pomocą systemu Blade, wykorzystane w tym celu zostały języki HTML, CSS i w niewielkiej mierze Javascript.

## Studium przypadku
<b>Użytkownik niezalogowany</b>
<ul>
	<li>rejestracja</li>
	<li>logowanie</li>
	<li>odwiedzenie strony głównej</li>
</ul>
<b>Użytkownik zalogowany</b>
<ul>
	<li>wylogowanie</li>
	<li>edycja danych konta</li>
	<li>założenie ogłoszenia</li>
	<li>edycja ogłoszenia</li>
	<li>usunięcie ogłoszenia</li>
	<li>przeglądanie ogłoszeń</li>
	<li>komentowanie ogłoszeń</li>
	<li>wysyłanie wiadomości do innych użytkowników</li>
	<li>kontakt z administracją</li>
</ul>
<b>Moderator</b>
<ul>
	<li>akceptowanie ogłoszeń</li>
	<li>wyłączanie ogłoszeń</li>
	<li>usuwanie ogłoszeń</li>
	<li>usuwanie użytkowników</li>
	<li>odpowiadanie na zgłoszenia</li>
	<li>zmiana statusu zgłoszenia</li>
</ul>
<b>Administrator</b>
<ul>
	<li>nadawanie uprawnień moderatora</li>
	<li>zabieranie uprawnień moderatora</li>
	<li>przekazanie uprawnień administratora</li>
</ul>

## Diagram przypadków użycia
<img src="https://www.facebook.com/messenger_media/?attachment_id=6142489839103035&message_id=mid.%24cAABa89GDl6qMEEmW52F3wRKZK3Z7&thread_id=100003238614954"  width="400" height="400" alt="error" />

## Baza danych
<img src="/bazdanych.png"  width="400" height="400" alt="error" />

## Interfejs użytkownika
