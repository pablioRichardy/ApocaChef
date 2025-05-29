<?php

namespace api\service;

use api\dao\IngredienteDAO;
use Exception;

class IngredienteService extends IngredienteDAO
{
    public function listarIngrediente()
    {
        return $this->buscarIngredientes();
    }

    public function listarIngredientePorId($id)
    {
        if (!$id) {
            throw new Exception("ID não informado ou não existe.");
        }

        $sucesso = $this->buscarIngredientePorId($id);

        return $sucesso;
    }
    public function cadastrarIngrediente($nome)
    {
        if (!$nome) {
            throw new Exception("Nome do ingrediente não digitado.");
        }

        $sucesso = $this->inserirIngrediente($nome);

        return $sucesso;
    }

    public function atualizarIngrediente($id, $nome)
    {
        if (!$id || !$nome) {
            throw new \Exception("ID e nome do ingrediente são obrigatórios.");
        }
        $sucesso = $this->atualizarUmIngrediente($id, $nome);

        return $sucesso;
    }

    public function deletarIngrediente($id)
    {
        if (!$id) {
            throw new \Exception("ID do ingrediente é obrigatório.");
        }
        $sucesso = $this->deletarUmIngrediente($id);
        
        return $sucesso;
    }
}
