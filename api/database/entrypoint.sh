#!/bin/bash

# Inicia cron
cron

# Remove tudo que tem na pasta initdb para garantir limpeza
rm -f /docker-entrypoint-initdb.d/*.sql

# Copia apenas o arquivo mais recente da pasta backups
latest_backup=$(ls -t /api/database/backups/*.sql | head -n 1)
if [ -n "$latest_backup" ]; then
  cp "$latest_backup" /docker-entrypoint-initdb.d/
fi

exec docker-entrypoint.sh postgres