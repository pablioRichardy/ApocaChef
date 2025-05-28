<?
namespace frontend\controllers;

class HomeController
{
    public function render()
    {
        return <<<HTML
            <div class="content">
                Meu conteúdo
            </div>
        HTML;
    }
}