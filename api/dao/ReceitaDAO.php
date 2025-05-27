<?php
namespace api\dao;

use generic\PostgresFactory;

class ReceitaDAO extends PostgresFactory
{
    public function inserir($titulo, $descricao, $modo_preparo, $imagem, $dificuldade, $tempo_preparo)
    {
        $sql = "INSERT INTO receitas (titulo, descricao, modo_preparo, imagem, dificuldade, tempo_preparo) VALUES (:titulo, :descricao, :modo_preparo, :imagem, :dificuldade, :tempo_preparo)";

        $stmt = $this->banco->getConexao()->prepare($sql);

        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':modo_preparo', $modo_preparo);
        $stmt->bindValue(':imagem', $imagem);
        $stmt->bindValue(':dificuldade', $dificuldade);
        $stmt->bindValue(':tempo_preparo', $tempo_preparo);

        return $stmt->execute();
    }
}
