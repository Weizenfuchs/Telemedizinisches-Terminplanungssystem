# Telemedizinisches Terminplanungssystem

Dieses Projekt ist ein Backend-Service zur Verwaltung von Ärzten und Terminen im Rahmen eines telemedizinischen Terminplanungssystems. Es basiert auf PHP mit Domain-Driven Design (DDD) und nutzt Laminas Mezzio, Phinx für Migrationen und einen PostgreSQL-Datenbank-Backend.

Zur Trennung der Umgebungen nutzt dieses Projekt Docker Container und ein dev.sh script setup um diese zu orchestrieren.

Die API-Dokumentation ist zu finden unter `/docs/openapi.yml`. Zum Einsehen dieser kann https://editor.swagger.io/ benutzt werden.


Eine projektbezogene Postman Collection ist zu finden unter `https://jotility.postman.co/workspace/Telemedizinisches-Terminplanung~ed31eddb-0e5b-4deb-9df8-21b27e96f039/collection/9973932-34725a98-2fef-4389-80d9-165d784feefd?action=share&creator=9973932`

---

# Endpunktbeschreibung

- Endpunkt für das Abrufen eines Termins:
    - `GET appointment/:appointment_id`
- Endpunkt für das Stornieren eines Termins:
    - `DELETE /appointments/:appointment_id`
- Endpunkt für das Buchen eines Termins:
  - `POST /appointments`
- Endpunkt für das Abrufen der Verfügbarkeiten eines Doktors:
  - `GET /doctors/:doctorId/timeslots`
  - Liefert die Verfügbarkeiten des Doktors für die nächsten 7 Tage
- Endpunkt für das Abrufen sämtlicher Doktoren und Ihrer Fachgebiete:
  - `GET /doctors`

---

# Architektur & Design

- Domain-Driven Design (DDD) als Architektur-Pattern.
- Verwendung von Hydratoren und Extractoren zum Umwandeln von Datenbankdaten in Domain-Objekte.
- Nutzung von Services und Repositories zur Datenbankabstraktion.
- JSON-Antworten werden über PSR-7-konforme HTTP-Handler zurückgegeben.
- Datenbankzugriff via PDO mit PostgreSQL.

---

# Voraussetzungen

- PHP 8.1+
- Composer
- Docker & Docker Compose
- Git

**Empfohlen:**
- Postman
- Swagger

---

# Installation

1. Repository klonen

```bash
git clone https://github.com/Weizenfuchs/Telemedizinisches-Terminplanungssystem.git
cd telemedizinisches-terminplanungssystem
```

2. Abhängigkeiten installieren

```bash
composer install
```

3. Docker-Container, Phinx Migration und Seed starten

```bash
./dev.sh up development
```

---

# Verwendung von `./dev.sh`

Das Skript `./dev.sh` dient zur einfachen Verwaltung der Docker-Entwicklungsumgebung. Es erwartet zwei Parameter:

```bash
./dev.sh <Befehl> <Umgebung>
```

`<Befehl>` kann sein:

- `up` - Startet alle Container im Hintergrund, führt Migrationen und Seeder aus.
- `down` - Stoppt und entfernt alle Container der angegebenen Umgebung.
- `restart` - Führt down und anschließend up aus.
- `logs` - Zeigt die Logs der Container in Echtzeit an.
- `migrate` - Führt nur die Datenbankmigrationen aus.
- `seed` - Führt nur die Seeder-Skripte aus.
- `kill_everything` - VORSICHT! Bereinigt Docker vollständig (Entfernt sämtliche Container, Images, Volumes und Netzwerke).
- `check` - Zeigt den Status der Migrationen an.
- `test` - Führt PHPUnit Tests aus.

`<Umgebung>` bestimmt die Docker-Compose-Datei, z.B.:
- `development`
- `stage`
- `prod`

Die jeweiligen Compose-Dateien liegen unter `./provisioning/<Umgebung>/docker-compose.yml`.
