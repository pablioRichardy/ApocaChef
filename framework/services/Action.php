<?
namespace framework\services;

/**
 * Router class for handling HTTP routes.
 */
class Action
{
    private string $class;
    private string $method;

    public function __construct(string $class, string $method)
    {
        $this->class = $class;
        $this->method = $method;
    }

    public function run(?array $params): mixed
    {
        if (!class_exists($this->class)) {
            throw new \Exception("Class {$this->class} not found");
        }

        $instance = new $this->class();
        if($params)
            $instance->setRouteParams($params);

        if (!method_exists($instance, $this->method)) {
            throw new \Exception("Method {$this->method} not found in class {$this->class}");
        }

        return $instance->{$this->method}();
    }
}