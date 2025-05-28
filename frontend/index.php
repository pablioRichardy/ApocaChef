<?
require_once "../framework/autoload.php";

use framework\services\Action;
use framework\services\Router;
use frontend\views\templates\Template;

$router = new Router("", new Template());
$router->addRoute(
    httpMethod: "GET",
    route: "/",
    action: new Action(
        class: "frontend\controllers\HomeController",
        method: "render"
    )
);

$router->execute(
    method: $_SERVER["REQUEST_METHOD"], 
    path: $_GET["param"] ?? $_SERVER["REQUEST_URI"]
);