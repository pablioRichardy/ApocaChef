# ApocaChef

Projeto para gerenciamento de receitas apocalípticas, com backend em PHP (API), frontend em PHP e banco de dados PostgreSQL, tudo orquestrado via Docker.

## Estrutura do Projeto

```
.
├── .git-hooks/                # Hooks personalizados do Git (ex: backup automático antes do push)
│   └── pre-push.sh
├── .swp                       # Arquivo swap temporário
├── api/                       # Backend (API REST em PHP)
│   ├── .htaccess
│   ├── Dockerfile
│   ├── index.php              # Ponto de entrada da API
│   ├── controllers/           # Controllers da API
│   │   ├── IngredienteController.php
│   │   ├── ReceitaController.php
│   │   └── ReceitaIngredienteController.php
│   ├── dao/                   # Data Access Objects (DAO)
│   │   ├── IngredienteDAO.php
│   │   ├── ReceitaDAO.php
│   │   └── ReceitaIngredienteDAO.php
│   ├── database/              # Scripts e backups do banco de dados
│   │   ├── Dockerfile
│   │   ├── backup.sh
│   │   ├── crontab.txt
│   │   ├── entrypoint.sh
│   │   └── backups/           # Backups automáticos do banco (.sql)
│   ├── generic/               # Código genérico/utilitário
│   ├── middlewares/           # Middlewares da API
│   └── service/               # Camada de serviço (regras de negócio)
├── docker-compose.yml         # Orquestração dos containers (API, frontend, banco)
├── env/
│   └── .env                   # Variáveis de ambiente (ex: API_BASE_URL)
├── framework/                 # Framework próprio (autoload, router, etc)
│   ├── autoload.php
│   ├── config/
│   ├── handlers/
│   └── services/
├── frontend/                  # Frontend em PHP
│   ├── .htaccess
│   ├── Dockerfile
│   ├── index.php              # Ponto de entrada do frontend
│   ├── controllers/
│   │   └── HomeController.php
│   └── views/
│       └── templates/
│           └── Template.php
├── init-dev.sh                # Script para inicializar ambiente de desenvolvimento
├── receitas_apocalipticas     # Script SQL de criação do banco (MySQL/Postgres)
```

## Principais Componentes

- **API**: Backend RESTful em PHP, organizado em controllers, DAOs e services.
- **Frontend**: Interface web em PHP, usando templates simples.
- **Database**: PostgreSQL, com scripts de inicialização, backups automáticos e restauração.
- **Framework**: Código de infraestrutura para roteamento, autoload, middlewares, etc.
- **Docker**: Containers para API, frontend e banco de dados, facilitando o desenvolvimento e deploy.
- **Git Hooks**: Backup automático do banco antes de cada push.

## Como rodar o projeto

1. Configure o arquivo `.env` em `env/.env` conforme necessário.
2. Execute o script de inicialização:
   ```sh
   ./init-dev.sh
   ```
3. Acesse:
   - API: http://localhost:5000
   - Frontend: http://localhost:3000

## Observações

- Os backups do banco são feitos automaticamente e salvos em `api/database/backups/`.
- O banco de dados é restaurado automaticamente ao subir o container, caso haja scripts `.sql` em `api/database/backups/`.

---

## Documentação da API

### Rotas de Receitas

| Método | Rota                         | Parâmetros na URL    | Parâmetros no Body (JSON)                                   | Descrição                        |
|--------|------------------------------|----------------------|-------------------------------------------------------------|----------------------------------|
| GET    | /receitas/listar             | -                    | -                                                           | Lista todas as receitas          |
| GET    | /receitas/listar/{id}        | id                   | -                                                           | Busca uma receita pelo ID        |
| POST   | /receitas/cadastrar          | -                    | titulo, descricao, imagem, dificuldade, tempo_preparo       | Cadastra uma nova receita        |
| PUT    | /receitas/atualizar/{id}     | id                   | titulo, descricao, imagem, dificuldade, tempo_preparo       | Atualiza uma receita existente   |
| DELETE | /receitas/deletar/{id}       | id                   | -                                                           | Deleta uma receita               |

### Rotas de Ingredientes

| Método | Rota                              | Parâmetros na URL | Parâmetros no Body (JSON) | Descrição                        |
|--------|-----------------------------------|-------------------|---------------------------|----------------------------------|
| GET    | /ingredientes/listar              | -                 | -                         | Lista todos os ingredientes      |
| GET    | /ingredientes/listar/{id}         | id                | -                         | Busca ingrediente pelo ID        |
| POST   | /ingredientes/cadastrar           | -                 | nome                      | Cadastra um novo ingrediente     |
| PUT    | /ingredientes/atualizar/{id}      | id                | nome                      | Atualiza um ingrediente          |
| DELETE | /ingredientes/deletar/{id}        | id                | -                         | Deleta um ingrediente            |

### Rotas de Relação Receita-Ingrediente

| Método | Rota                                         | Parâmetros na URL         | Parâmetros no Body (JSON) | Descrição                                      |
|--------|----------------------------------------------|---------------------------|---------------------------|------------------------------------------------|
| POST   | /receita/{id}/ingrediente                    | id                        | ingrediente_id            | Adiciona ingrediente à receita                  |
| GET    | /receitas/{id}/ingredientes                  | id                        | -                         | Lista ingredientes de uma receita               |
| DELETE | /receitas/{id}/ingredientes/{ingrediente_id} | id, ingrediente_id        | -                         | Remove ingrediente de uma receita               |

**Observações:**
- Todos os endpoints requerem autenticação (`authorization: true`).
- Parâmetros na URL são passados como parte do caminho (ex: `/receitas/listar/1`).
- Parâmetros no Body devem ser enviados em formato JSON no corpo da requisição.