<?php

namespace api\controllers;

use api\service\ReceitaIngredienteService;
use framework\handlers\RequestHandler;

class ReceitaIngredienteController extends RequestHandler
{
    public function adicionarIngrediente()
    {
        $receitaId = $this->get("id");
        $ingredienteId = $this->get("ingrediente_id"); // pode ser um único ID por agora

        $service = new ReceitaIngredienteService();
        return $service->adicionarIngrediente($receitaId, $ingredienteId);
    }

    public function listarIngredientesDaReceita()
    {
        $receitaId = $this->get("id");

        $service = new ReceitaIngredienteService();
        return $service->listarIngredientes($receitaId);
    }

    public function removerIngredienteDaReceita()
    {
        $receitaId = $this->get("id");
        $ingredienteId = $this->get("ingrediente_id");

        $service = new ReceitaIngredienteService();
        return $service->removerIngrediente($receitaId, $ingredienteId);
    }
}
