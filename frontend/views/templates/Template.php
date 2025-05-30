<?
namespace frontend\views\templates;

use Exception;
use framework\services\IMiddleware;

class Template implements IMiddleware
{
    public function __construct() {}

    private function header(): string
    {
        return <<<HTML
            <!Doctype HTML>
            <head>
            </head>
            <body>
                <header>
                </header>
                <main>
        HTML;
    }

    private function footer(): string
    {
        return <<<HTML
                </main>
                <footer>
                </footer>
            </body>
        HTML;
    }

    public function process(array|string|Exception $response): string
    {
        return <<<HTML
            {$this->header()}
            $response
            {$this->footer()}
        HTML;
    }
    
}