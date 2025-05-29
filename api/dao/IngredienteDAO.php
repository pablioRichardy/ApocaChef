<?php

namespace api\dao;

use api\generic\PostgresFactory;

class IngredienteDAO extends PostgresFactory
{
    public function buscarIngredientes()
    {
        $sql = "SELECT * FROM ingredientes";
        $stmt = $this->banco->getConexao()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function buscarIngredientePorId($id)
    {
        $sql = "SELECT * FROM ingredientes WHERE id = :id";

        $stmt = $this->banco->getConexao()->prepare($sql);
        // Executa a query passando um array associativo com os valores
        $stmt->execute([
            ":id" => $id
        ]);
        // Retorna o resultado como array associativo (1 ingrediente apenas)
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function inserirIngrediente($nome)
    {
        $sql = "INSERT INTO ingredientes (nome) VALUES (:nome)";

        $stmt = $this->banco->getConexao()->prepare($sql);
        return $stmt->execute([
            'nome' => $nome
        ]);
    }
    public function atualizarUmIngrediente($id, $nome)
    {
        $sql = "UPDATE ingredientes SET nome = :nome WHERE id = :id";

        $stmt = $this->banco->getConexao()->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'nome' => $nome
        ]);
    }

    public function deletarUmIngrediente($id)
    {
        $sql = "DELETE FROM ingredientes WHERE id = :id";

        $stmt = $this->banco->getConexao()->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
