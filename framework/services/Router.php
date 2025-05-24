<?
namespace framework\services;

use framework\services\Action;

/**
 * Router class to handle HTTP routing.
 *
 * This class is responsible for defining and dispatching routes
 * for incoming HTTP requests. It supports dynamic route parameters
 * and allows for easy integration with controllers and actions.
 *
 * @package framework\services
 */
class Router
{
    private array $routes = [];
    private string $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    public function getBasePath(): string
    {
        return $this->basePath;
    }

    public function addRoute(string $httpMethod, string $route, Action $action): void
    {
        $this->routes[] = [
            'httpMethod' => strtoupper($httpMethod),
            'route' => "{$this->getBasePath()}$route",
            'action' => $action
        ];
    }

    public function execute(string $method, string $path): void
    {
        foreach ($this->routes as $route) {
            if ($route['httpMethod'] === strtoupper($method) && preg_match($this->convertToRegex($route['route']), "/" . $path)) {
                $class = $route['action'] ?? null;
                echo $class->run();
                return;
            }
        }
        
        echo "Route not found for method $method and route $path";
        return;
    }

    private function convertToRegex(string $path): string
    {
        return '#^' . preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', preg_quote($path, '#')) . '$#';
    }
}