<?
namespace frontend\controllers;

class HomeController
{
    public function render()
    {
        return <<<HTML
            <div class="content">
                <h1>ApocaChef</h1>
                <section>
                    <h2>Receitas Recentes</h2>
                    <div class="cards">
                        <div class="card">
                            <div class="card-title"></div>
                            <div class="card-desc"></div>
                        </div>
                    </div>
                </section>
            </div>
        HTML;
    }
}