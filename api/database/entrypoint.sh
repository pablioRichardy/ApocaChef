#!/bin/bash

# Inicia cron
cron

# Chama o entrypoint oficial do Postgres (isso cuida do initdb e restaura backups do /docker-entrypoint-initdb.d)
exec docker-entrypoint.sh postgres
