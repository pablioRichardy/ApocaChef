<?
namespace api\controllers;

use framework\handlers\RequestHandler;

class WelcomeController extends RequestHandler
{
    public function sayHelloWorld()
    {
        return "Hello, World!";
    }
}