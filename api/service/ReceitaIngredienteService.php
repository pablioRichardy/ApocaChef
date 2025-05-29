<?php

namespace api\service;

use api\dao\ReceitaIngredienteDAO;
use Exception;

class ReceitaIngredienteService extends ReceitaIngredienteDAO
{
    public function adicionarIngrediente($receitaId, $ingredienteId)
    {
        if (!$receitaId || !$ingredienteId) {
            throw new Exception("Receita e Ingrediente são obrigatórios.");
        }
        return $this->vincularIngrediente($receitaId, $ingredienteId);
    }

    public function listarIngredientes($receitaId)
    {
        if (!$receitaId) {
            throw new Exception("ID da receita não informado.");
        }
        return $this->buscarIngredientesDaReceita($receitaId);
    }

    public function removerIngrediente($receitaId, $ingredienteId)
    {
        if (!$receitaId || !$ingredienteId) {
            throw new Exception("IDs inválidos.");
        }
        return $this->desvincularIngrediente($receitaId, $ingredienteId);
    }
}