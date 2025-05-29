<?php

namespace api\controllers;

use api\service\IngredienteService;

use framework\handlers\RequestHandler;

class IngredienteController extends RequestHandler
{
    public function listarIngredientes()
    {
        $service = new IngredienteService();
        $dados = $service->listarIngrediente();

        return $dados;
    }
    public function listarIngredientePorId()
    {
        $id = $this->get("id");

        $service = new IngredienteService();
        $dados = $service->listarIngredientePorId($id);

        return $dados;
    }
    public function cadastrarIngredientes()
    {
        $nome = $this->get("nome");

        $service = new IngredienteService();
        $resultado = $service->cadastrarIngrediente($nome);

        return $resultado;
    }

    public function atualizarIngrediente()
    {
        $id = $this->get("id");
        $nome = $this->get("nome");

        $service = new IngredienteService();
        $dados = $service->atualizarIngrediente($id, $nome);

        return $dados;
    }

    public function deletarIngrediente()
    {
        $id = $this->get("id");

        $service = new IngredienteService();
        $resultado = $service->deletarIngrediente($id);

        return $resultado;
    }
}
