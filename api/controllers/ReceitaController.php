<?php

namespace api\controllers;

use api\service\ReceitaService;

use framework\handlers\RequestHandler;

class ReceitaController extends RequestHandler
{
    public function cadastrarReceitas()
    {
        $titulo = $this->get("titulo");
        $descricao = $this->get("descricao");
        $imagem = $this->get("imagem");
        $dificuldade = $this->get("dificuldade");
        $tempo_preparo = $this->get("tempo_preparo");

        $service = new ReceitaService();
        $resultado = $service->cadastrarReceita($titulo, $descricao, $imagem, $dificuldade, $tempo_preparo);

        return $resultado;
    }

    public function atualizarReceitas()
    {
        $id = $this->get("id");
        $titulo = $this->get("titulo");
        $descricao = $this->get("descricao");
        $imagem = $this->get("imagem");
        $dificuldade = $this->get("dificuldade");
        $tempo_preparo = $this->get("tempo_preparo");

        var_dump($id);
        $service = new ReceitaService();
        $resultado = $service->atualizarReceita($id, $titulo, $descricao, $imagem, $dificuldade, $tempo_preparo);

        return $resultado;
    }

    public function deletarReceitas()
    {
        $id = $this->get("id");

        $service = new ReceitaService();
        $resultado = $service->deletarReceita($id);

        return $resultado;
    }

    public function listarReceitas()
    {
        $service = new ReceitaService();
        $dados = $service->listarReceitas();
    }

    public function buscarReceitaPorId()
    {
        $id = $this->get("id");

        $service = new ReceitaService();
        $dados = $service->buscarReceitaPorId($id);

        return $dados;
    }
}
