#!/bin/bash

set -e

COMMAND=$1
ENV=$2

COMPOSE_FILE="./provisioning/$ENV/docker-compose.yml"

if [ ! -f "$COMPOSE_FILE" ]; then
  echo "Fehler: Compose-File '$COMPOSE_FILE' nicht gefunden."
  exit 1
fi

case $COMMAND in
  up)
    docker compose -f "$COMPOSE_FILE" up -d --build --remove-orphans
    sleep 3
    docker compose -f "$COMPOSE_FILE" exec telemedizin-api-service vendor/bin/phinx migrate
    docker compose -f "$COMPOSE_FILE" exec telemedizin-api-service vendor/bin/phinx seed:run
  ;;
  down)
    docker compose -f "$COMPOSE_FILE" down
  ;;
  restart)
    docker compose -f "$COMPOSE_FILE" down && docker compose -f "$COMPOSE_FILE" up -d --build --remove-orphans
    sleep 3
    docker compose -f "$COMPOSE_FILE" exec telemedizin-api-service vendor/bin/phinx migrate
    docker compose -f "$COMPOSE_FILE" exec telemedizin-api-service vendor/bin/phinx seed:run
  ;;
  logs)
    docker compose -f "$COMPOSE_FILE" logs -f
  ;;
  migrate)
    docker compose -f "$COMPOSE_FILE" exec telemedizin-api-service vendor/bin/phinx migrate
  ;;
  seed)
    docker compose -f "$COMPOSE_FILE" exec telemedizin-api-service vendor/bin/phinx seed:run
  ;;
  check)
    docker exec telemedizin-php-container vendor/bin/phinx status -e development
    echo "Timeslots"
    docker exec -it telemedizin-db-container psql -U fuchs -d telemedizin -c "SELECT * FROM timeslots LIMIT 5;"
    echo "Appointments"
    docker exec -it telemedizin-db-container psql -U fuchs -d telemedizin -c "SELECT * FROM appointments LIMIT 5;"
  ;;
  test)
    docker compose -f "$COMPOSE_FILE" exec telemedizin-api-service vendor/bin/phpunit
  ;;
  *)
    echo "Usage: ./dev.sh {up|down|restart|logs|migrate|seed|check|test} {development|stage|prod}"
    exit 1
    ;;
esac
