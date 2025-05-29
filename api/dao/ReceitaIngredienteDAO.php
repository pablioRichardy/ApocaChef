<?php

namespace api\dao;

use api\generic\PostgresFactory;

class ReceitaIngredienteDAO extends PostgresFactory
{
    public function vincularIngrediente($receitaId, $ingredienteId)
    {
        $sql = "INSERT INTO receita_ingrediente (receita_id, ingrediente_id) VALUES (:receitaId, :ingredienteId)";
        $stmt = $this->banco->getConexao()->prepare($sql);
        return $stmt->execute([
            ':receitaId' => $receitaId,
            ':ingredienteId' => $ingredienteId
        ]);
    }

    public function buscarIngredientesDaReceita($receitaId)
    {
        $sql = "SELECT i.* FROM ingredientes i 
                INNER JOIN receita_ingrediente ri ON i.id = ri.ingrediente_id
                WHERE ri.receita_id = :receitaId";

        $stmt = $this->banco->getConexao()->prepare($sql);
        $stmt->execute([':receitaId' => $receitaId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function desvincularIngrediente($receitaId, $ingredienteId)
    {
        $sql = "DELETE FROM receita_ingrediente WHERE receita_id = :receitaId AND ingrediente_id = :ingredienteId";
        $stmt = $this->banco->getConexao()->prepare($sql);
        return $stmt->execute([
            ':receitaId' => $receitaId,
            ':ingredienteId' => $ingredienteId
        ]);
    }
}
