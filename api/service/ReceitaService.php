<?php

namespace api\service;

use api\dao\ReceitaDAO;
use Exception;

class ReceitaService extends ReceitaDAO
{
    public function listarReceitas()
    {
        return $this->buscarTodas();
    }

    public function buscarReceitaPorId($id)
    {
        if (!$id) {
            throw new Exception("ID não informado ou não existe.");
        }
        return $dados = $this->buscarPorId($id);

        return $dados;
    }
    
    public function cadastrarReceita($titulo, $descricao, $imagem, $dificuldade, $tempo_preparo)
    {
        if (!$titulo || !$descricao || !$dificuldade) {
            throw new Exception("Todos os campos são obrigatórios!");
        }

        $sucesso = $this->inserir($titulo, $descricao, $imagem, $dificuldade, $tempo_preparo);

        return $sucesso;
    }

    public function atualizarReceita($id, $titulo, $descricao, $imagem, $dificuldade, $tempo_preparo)
    {
        if (!$id || !$titulo || !$descricao || !$dificuldade) {
            throw new Exception("Todos os campos são obrigatórios!");
        }

        $sucesso = $this->atualizar($id, $titulo, $descricao, $imagem, $dificuldade, $tempo_preparo);

        return $sucesso;
    }

    public function deletarReceita($id)
    {
        if (!$id) {
            throw new Exception("ID da receita é obrigatório!");
        }

        $sucesso = $this->deletar($id);

        return $sucesso;
    }
}
