#🏋️ JustFit - System Zarządzania Klubem Fitness Projekt fullstackowej aplikacji webowej wspomagającej pracę klubu fitness, umożliwiający zarządzanie bazą członków, karnetami oraz monitorowanie obecności.

🚀 Funkcjonalności Panel Administratora: Dodawanie nowych użytkowników oraz przypisywanie im daty ważności karnetu.

Zarządzanie Baza Danych: Wykorzystanie transakcji SQL do zapewnienia spójności danych między tabelami users i karnety.

Komunikacja Asynchroniczna: Rejestracja użytkowników bez przeładowywania strony dzięki wykorzystaniu AJAX (jQuery).

Bezpieczeństwo: Wykorzystanie mechanizmu PDO Prepared Statements chroniącego przed atakami SQL Injection.

🛠️ Tech Stack Frontend: HTML5, CSS3, JavaScript (jQuery).

Backend: PHP (7.4+).

Baza danych: MySQL.

⚙️ Jak uruchomić projekt lokalnie Sklonuj repozytorium: git clone https://github.com/PolPrzemys/JustFit.git

Skonfiguruj lokalny serwer (np. XAMPP).

Zaimportuj bazę danych (użyj poniższego schematu SQL).

Skonfiguruj dane połączenia w plikach .php (host, dbname, user, password).

📊 Schemat Bazy Danych (SQL) SQL CREATE DATABASE bazafit; USE bazafit;

CREATE TABLE users ( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, membership_number VARCHAR(50) UNIQUE NOT NULL );

CREATE TABLE karnety ( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, expiration_date DATE NOT NULL );
