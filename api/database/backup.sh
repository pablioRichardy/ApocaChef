#!/bin/bash
NOW=$(date +"%Y%m%d_%H%M%S")
BACKUP_PATH="/api/database/backups/backup_${NOW}.sql"
pg_dump -h localhost -p 5432 -U user -d receitas_apocalipticas > "$BACKUP_PATH"
echo "Backup salvo em: $BACKUP_PATH"