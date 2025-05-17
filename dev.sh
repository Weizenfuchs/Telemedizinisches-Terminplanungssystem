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
    docker compose -f "$COMPOSE_FILE" up -d --build
    ;;
  down)
    docker compose -f "$COMPOSE_FILE" down
    ;;
  restart)
    docker compose -f "$COMPOSE_FILE" down && docker compose -f "$COMPOSE_FILE" up -d --build
    ;;
  logs)
    docker compose -f "$COMPOSE_FILE" logs -f
    ;;
  migrate)
    docker compose -f "$COMPOSE_FILE" exec api vendor/bin/phinx migrate
    ;;
  *)
    echo "Usage: ./dev.sh {up|down|restart|logs|migrate} {dev|test|prod}"
    exit 1
    ;;
esac
