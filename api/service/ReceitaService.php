<?php

namespace api\service;

use api\dao\ReceitaDAO;

class ReceitaService extends ReceitaDAO
{
    public function cadastrarReceita($titulo, $descricao, $imagem, $dificuldade, $tempo_preparo)
    {
        if (!$titulo || !$descricao || !$dificuldade) {
            return "Todos os campos sao obrigatorios!";
        }

        $sucesso = $this->inserir($titulo, $descricao, $imagem, $dificuldade, $tempo_preparo);

        return $sucesso ? 'Receita cadastrada com sucesso.' : 'Erro ao cadastrar receita.';
    }

    public function atualizarReceita($id, $titulo, $descricao, $imagem, $dificuldade, $tempo_preparo)
    {
        if (!$id || !$titulo || !$descricao || !$dificuldade) {
            return "Todos os campos são obrigatórios!";
        }

        $sucesso = $this->atualizar($id, $titulo, $descricao, $imagem, $dificuldade, $tempo_preparo);

        return $sucesso ? "Receita atualizada com sucesso." : "Erro ao atualizar receita.";
    }

    public function deletarReceita($id)
    {
        if (!$id) {
            return "ID da receita é obrigatório!";
        }

        $sucesso = $this->deletar($id);

        return $sucesso ? "Receita deletada com sucesso." : "Erro ao deletar receita.";
    }

    public function listarReceitas()
    {
        return $this->buscarTodas();
    }
}
