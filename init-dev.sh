#!/bin/bash
git config --global core.autocrlf false

echo "⏫ Subindo containers..."
docker compose down -v
docker compose build --no-cache
docker compose up -d

echo "⚙️ Configurando Git Hooks..."

git config core.hooksPath .git-hooks
chmod +x .git-hooks/*

echo "✅ Ambiente pronto!"