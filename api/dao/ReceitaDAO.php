<?php

namespace api\dao;

use api\generic\PostgresFactory;

class ReceitaDAO extends PostgresFactory
{
    public function inserir($titulo, $descricao, $imagem, $dificuldade, $tempo_preparo)
    {
        $sql = "INSERT INTO receitas (titulo, descricao, imagem, dificuldade, tempo_preparo) VALUES (:titulo, :descricao, :imagem, :dificuldade, :tempo_preparo)";

        $stmt = $this->banco->getConexao()->prepare($sql);
        return $stmt->execute([
            ':titulo' => $titulo,
            ':descricao' => $descricao,
            ':imagem' => $imagem,
            ':dificuldade' => $dificuldade,
            ':tempo_preparo' => $tempo_preparo
        ]);

        return $this->banco->getConexao()->lastInsertId();
    }

    public function atualizar($id, $titulo, $descricao, $imagem, $dificuldade, $tempo_preparo)
    {
        $sql = "UPDATE receitas 
            SET titulo = :titulo, descricao = :descricao, imagem = :imagem, dificuldade = :dificuldade, tempo_preparo = :tempo_preparo
            WHERE id = :id";

        $stmt = $this->banco->getConexao()->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':titulo' => $titulo,
            ':descricao' => $descricao,
            ':imagem' => $imagem,
            ':dificuldade' => $dificuldade,
            ':tempo_preparo' => $tempo_preparo
        ]);
    }
    public function deletar($id)
    {
        $sql = "DELETE FROM receitas WHERE id = :id";

        $stmt = $this->banco->getConexao()->prepare($sql);

        return $stmt->execute([':id' => $id]);
    }
    public function buscarTodas()
    {
        $sql = "SELECT * FROM receitas";

        $stmt = $this->banco->getConexao()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
