# Telemedizinisches Terminplanungssystem

Dieses Projekt ist ein Backend-Service zur Verwaltung von Ärzten und Terminen im Rahmen eines telemedizinischen Terminplanungssystems. Es basiert auf PHP mit Domain-Driven Design (DDD) und nutzt Laminas Mezzio, Phinx für Migrationen und einen PostgreSQL-Datenbank-Backend.

Die API-Dokumentation ist zu finden unter `/docs/openapi.yml`
Eine projektbezogene Postman Collection ist zu finden unter `https://jotility.postman.co/workspace/Telemedizinisches-Terminplanung~ed31eddb-0e5b-4deb-9df8-21b27e96f039/collection/9973932-34725a98-2fef-4389-80d9-165d784feefd?action=share&creator=9973932`

---

# Aktueller Stand

- Basis-API-Endpunkt `/doctors` mit GET-Methode implementiert
- Domain-Modelle für `Doctor` und `Specialization` mit Hydratoren und Repositories
- Datenbankanbindung über PDO mit einem `DatabaseService`
- Nutzung von UUIDs via `ramsey/uuid`
- Migrationen und Seeds mit Phinx

---

# Architektur & Design

- Domain-Driven Design (DDD) als Architektur-Pattern.
- Verwendung von Hydratoren und Extractoren zum Umwandeln von Datenbankdaten in Domain-Objekte.
- Nutzung von Repositories zur Datenbankabstraktion.
- JSON-Antworten werden über PSR-7-konforme HTTP-Handler zurückgegeben.
- Datenbankzugriff via PDO mit PostgreSQL.

---

# Voraussetzungen

- PHP 8.1+
- Composer
- Docker & Docker Compose
- Git

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
- `prune` - Bereinigt Docker komplett (Container, Images, Volumes, Netzwerke).
- `check` - Zeigt den Status der Migrationen an.

`<Umgebung>` bestimmt die Docker-Compose-Datei, z.B.:
- `development`
- `stage`
- `prod`

Die jeweiligen Compose-Dateien liegen unter `./provisioning/<Umgebung>/docker-compose.yml`.
