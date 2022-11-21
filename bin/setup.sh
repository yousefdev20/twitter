#!/bin/bash

UNAMEOUT="$(uname -s)"

case "${UNAMEOUT}" in
Linux*) MACHINE=linux ;;
Darwin*) MACHINE=mac ;;
*) MACHINE="UNKNOWN" ;;
esac

if [ "$MACHINE" == "UNKNOWN" ]; then
    echo "Unsupported operating system [$(uname -s)]. MAf command supports macOS, Linux" >&2

    exit 1
fi
cp .env.example .env
sudo docker-compose down && docker-compose up -d --build
docker exec -it twitter composer install && docker exec -it twitter php artisan key:generate &&
    docker exec -it twitter php artisan migrate && docker exec -it twitter php artisan db:seed &&
    docker exec -it twitter php artisan storage:link
sudo docker-compose down && docker-compose up -d --build
