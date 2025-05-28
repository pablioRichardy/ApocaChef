<?
include "../framework/autoload.php";

use framework\services\Action;
use framework\services\Router;
use framework\handlers\EnvHandler;

$env = new EnvHandler("/var/www/env/.env");

$router = new Router($env->get("API_BASE_URL"));
$router->addRoute(
    httpMethod: "PUT", 
    route: "/welcome", 
    action: new Action("api\controllers\WelcomeController", "sayHelloWorld")
);

$router->execute(
    method: $_SERVER['REQUEST_METHOD'],
    path: $_GET["param"] ?? $_SERVER['REQUEST_URI']
); 