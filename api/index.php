<?
include "../framework/autoload.php";

use api\middlewares\ResponseMiddleware;
use framework\services\Action;
use framework\services\Router;
use framework\handlers\EnvHandler;

$env = new EnvHandler("/var/www/env/.env");

$router = new Router($env->get("API_BASE_URL"), new ResponseMiddleware);

// Rotas de Receitas
$router->addRoute(
    httpMethod: "GET",
    route: "/receitas/listar",
    action: new Action("api\controllers\ReceitaController", "listarReceitas")
);
$router->addRoute(
    httpMethod: "GET",
    route: "/receitas/listar/{id}",
    action: new Action("api\controllers\ReceitaController", "buscarReceitaPorId")
);

$router->addRoute(
    httpMethod: "POST",
    route: "/receitas/cadastrar",
    action: new Action("api\controllers\ReceitaController", "cadastrarReceitas")
);

$router->addRoute(
    httpMethod: "PUT",
    route: "/receitas/atualizar/{id}",
    action: new Action("api\controllers\ReceitaController", "atualizarReceitas")
);

$router->addRoute(
    httpMethod: "DELETE",
    route: "/receitas/deletar/{id}",
    action: new Action("api\controllers\ReceitaController", "deletarReceitas")
);

// Rotas de Ingredientes
$router->addRoute(
    httpMethod: "GET",
    route: "/ingredientes/listar",
    action: new Action("api\controllers\IngredienteController", "listarIngredientes")
);

$router->addRoute(
    httpMethod: "GET",
    route: "/ingredientes/listar/{id}",
    action: new Action("api\controllers\IngredienteController", "listarIngredientePorId")
);

$router->addRoute(
    httpMethod: "POST",
    route: "/ingredientes/cadastrar",
    action: new Action("api\controllers\IngredienteController", "cadastrarIngredientes")
);

$router->addRoute(
    httpMethod: "PUT",
    route: "/ingredientes/atualizar/{id}",
    action: new Action("api\controllers\IngredienteController", "atualizarIngrediente")
);

$router->addRoute(
    httpMethod: "DELETE",
    route: "/ingredientes/deletar/{id}",
    action: new Action("api\controllers\IngredienteController", "deletarIngrediente")
);

// Rotas de Relação Receita-Ingrediente

$router->addRoute(
    httpMethod: "POST",
    route: "/receita/{id}/ingrediente",
    action: new Action("api\controllers\ReceitaIngredienteController", "adicionarIngrediente")
);

$router->addRoute(
    httpMethod: "GET",
    route: "/receitas/{id}/ingredientes",
    action: new Action("api\controllers\ReceitaIngredienteController", "listarIngredientesDaReceita")
);

$router->addRoute(
    httpMethod: "DELETE",
    route: "/receitas/{id}/ingredientes/{ingrediente_id}",
    action: new Action("api\controllers\ReceitaIngredienteController", "removerIngredienteDaReceita")
);

$router->execute(
    method: $_SERVER['REQUEST_METHOD'],
    path: $_GET["param"] ?? $_SERVER['REQUEST_URI']
);
