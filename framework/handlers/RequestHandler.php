<?
namespace framework\handlers;

use stdClass;

/**
 * RequestHandler class to handle HTTP requests.
 *
 * This class is responsible for processing incoming HTTP requests,
 * including GET, POST, and JSON data. It provides methods to retrieve
 * request parameters and check their existence.
 *
 * @package framework\services
 */
class RequestHandler
{
    private object $request;
    
    public function __construct()
    {
        $this->request = new stdClass();
        
        if (
            isset($_SERVER['CONTENT_TYPE']) 
            && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== false
            || $_SERVER['REQUEST_METHOD'] == "PUT"
            || $_SERVER['REQUEST_METHOD'] == "DELETE"
        )
        {
            $jsonRequest = file_get_contents('php://input');
            $jsonData = json_decode($jsonRequest, true);
            
            if (json_last_error() === JSON_ERROR_NONE) {
                foreach ($jsonData as $key => $value) {
                    $this->request->$key = $value;
                }
            } else {
                throw new \Exception("Invalid JSON data: " . json_last_error_msg());
            }
        }

        foreach ($_GET as $key => $value) {
            if ($key == 'param') continue;
            
            $this->request->$key = $value;
        }
        foreach ($_POST as $key => $value) {
            $this->request->$key = $value;
        }
        foreach ($_FILES as $key => $value) {
            $this->request->$key = $value;
        }
    }

    public function setRouteParams(?array $params)
    {
        if(!$params) return;
        
        foreach($params as $param => $value)
            $this->request->$param = $value;
    }

    public function get(string $key): mixed
    {
        return $this->request->$key ?? null;
    }
    public function getAll(): stdClass
    {
        return $this->request;
    }
    public function has(string $key): bool
    {
        return isset($this->request->$key);
    }
    public function isEmpty(): bool
    {
        return empty((array)$this->request);
    }
}