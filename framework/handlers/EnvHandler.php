<?
namespace framework\handlers;

/**
 * EnvHandler class to handle environment variables.
 *
 * This class is responsible for loading and providing access to
 * environment variables defined in a .env file. It supports
 * retrieving values by their keys.
 *
 * @package framework\handlers
 */
class EnvHandler
{
    private object $env;

    public function __construct($path)
    {
        $this->env = new \stdClass();
        
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#')) {
                continue;
            }
            
            [$name, $value] = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            // Remove aspas se tiver
            $value = trim($value, "\"'");
            
            $this->env->$name = $value;
        }
    }

    public function get(string $key): mixed
    {
        return $this->env->$key ?? null;
    }
}