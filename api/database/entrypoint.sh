#!/bin/bash
# Inicia PostgreSQL em background
/usr/local/bin/docker-entrypoint.sh postgres &

BACKUP_DIR="/api/database/backups"
# Pega o arquivo .sql mais recente
ARQUIVO_MAIS_RECENTE=$(ls -t "$BACKUP_DIR"/*.sql 2>/dev/null | head -n 1)
# Verifica se encontrou algum arquivo
if [ -f "$ARQUIVO_MAIS_RECENTE" ]; then
    echo "Importando arquivo: $ARQUIVO_MAIS_RECENTE"

    # Executa a importação
    psql -h localhost -p 5432 -U user -d receitas_apocalipticas -f "$ARQUIVO_MAIS_RECENTE"

    echo "Importação concluída."
fi

# Inicia cron
cron -f