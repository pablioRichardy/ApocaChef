<?
include "../framework/autoload.php";

use framework\services\Action;
use framework\services\Router;
use framework\handlers\EnvHandler;

$env = new EnvHandler("/var/www/env/.env");

$router = new Router($env->get("API_BASE_URL"));
$router->addRoute(
    httpMethod: "GET", 
    route: "/welcome", 
    action: new Action("api\controllers\WelcomeController", "sayHelloWorld")
);

$router->addRoute(
    httpMethod: "GET",
    route: "/receitas/cadastrar",
    action: new Action("api\controllers\ReceitaController", "cadastrarReceita")
);

$router->execute(
    method: $_SERVER['REQUEST_METHOD'],
    path: $_GET["param"] ?? $_SERVER['REQUEST_URI']
); 