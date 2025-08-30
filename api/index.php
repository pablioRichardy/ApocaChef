<?
include "../framework/autoload.php";
require_once './vendor/autoload.php';

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
    action: new Action("api\controllers\ReceitaController", "listarReceitas"),
    authorization: true
);
$router->addRoute(
    httpMethod: "GET",
    route: "/receitas/listar/{id}",
    action: new Action("api\controllers\ReceitaController", "buscarReceitaPorId"),
    authorization: true
);

$router->addRoute(
    httpMethod: "POST",
    route: "/receitas/cadastrar",
    action: new Action("api\controllers\ReceitaController", "cadastrarReceitas"),
    authorization: true
);

$router->addRoute(
    httpMethod: "PUT",
    route: "/receitas/atualizar/{id}",
    action: new Action("api\controllers\ReceitaController", "atualizarReceitas"),
    authorization: true
);

$router->addRoute(
    httpMethod: "DELETE",
    route: "/receitas/deletar/{id}",
    action: new Action("api\controllers\ReceitaController", "deletarReceitas"),
    authorization: true
);

// Rotas de Ingredientes
$router->addRoute(
    httpMethod: "GET",
    route: "/ingredientes/listar",
    action: new Action("api\controllers\IngredienteController", "listarIngredientes"),
    authorization: true
);

$router->addRoute(
    httpMethod: "GET",
    route: "/ingredientes/listar/{id}",
    action: new Action("api\controllers\IngredienteController", "listarIngredientePorId"),
    authorization: true
);

$router->addRoute(
    httpMethod: "GET",
    route: "/ingredientes/buscar/{nome}",
    action: new Action("api\controllers\IngredienteController", "listarIngredientePorNome"),
    authorization: true
);

$router->addRoute(
    httpMethod: "POST",
    route: "/ingredientes/cadastrar",
    action: new Action("api\controllers\IngredienteController", "cadastrarIngredientes"),
    authorization: true
);

$router->addRoute(
    httpMethod: "PUT",
    route: "/ingredientes/atualizar/{id}",
    action: new Action("api\controllers\IngredienteController", "atualizarIngrediente"),
    authorization: true
);

$router->addRoute(
    httpMethod: "DELETE",
    route: "/ingredientes/deletar/{id}",
    action: new Action("api\controllers\IngredienteController", "deletarIngrediente"),
    authorization: true
);

// Rotas de Relação Receita-Ingrediente

$router->addRoute(
    httpMethod: "POST",
    route: "/receita/{id}/ingrediente",
    action: new Action("api\controllers\ReceitaIngredienteController", "adicionarIngrediente"),
    authorization: true
);

$router->addRoute(
    httpMethod: "GET",
    route: "/receitas/{id}/ingredientes",
    action: new Action("api\controllers\ReceitaIngredienteController", "listarIngredientesDaReceita"),
    authorization: true
);

$router->addRoute(
    httpMethod: "DELETE",
    route: "/receitas/{id}/ingredientes/{ingrediente_id}",
    action: new Action("api\controllers\ReceitaIngredienteController", "removerIngredienteDaReceita"),
    authorization: true
);

$router->execute(
    method: $_SERVER['REQUEST_METHOD'],
    path: $_GET["param"] ?? $_SERVER['REQUEST_URI']
);
