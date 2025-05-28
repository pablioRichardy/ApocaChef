#!/bin/bash
export MSYS_NO_PATHCONV=1

echo "==> Executando backup antes do push..."

# Executa o backup dentro do container Docker
docker exec db /usr/local/bin/backup.sh

# Caminho da pasta onde os backups são salvos (no host)
BACKUP_DIR="api/database/backups"

# Adiciona todos os arquivos .sql da pasta de backups
git add "$BACKUP_DIR"/*.sql

# Se houver mudanças, cria um commit
if git diff --cached --quiet; then
    echo "Nenhuma alteração nova no backup para commit."
else
    echo "Commitando backup automático..."
    git commit -m "Backup automático antes do push"
fi

echo "==> Processo de backup concluído. Continuando com git push..."
