<?php

namespace api\generic;

use PDO;
use PDOException;

class PostgresSingleton
{
    private static $instance = null;

    private $conexao = null;
    private $dsn = 'pgsql:host=db;port=5432;dbname=receitas_apocalipticas';
    private $usuario = 'user';
    private $senha = 'pass';

    private function __construct()
    {
        try {
            $this->conexao = new PDO($this->dsn, $this->usuario, $this->senha, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Erro ao conectar com PostgreSQL: " . $e->getMessage());
        }
    }

    public static function getInstance(): PostgresSingleton
    {
        if (self::$instance === null) {
            self::$instance = new PostgresSingleton();
        }

        return self::$instance;
    }

    public function getConexao(): PDO
    {
        return $this->conexao;
    }

    public function executar($query, $param = array())
    {
        if ($this->conexao) {
            $sth = $this->conexao->prepare($query);
            foreach ($param as $k => $v) {
                $sth->bindValue($k, $v);
            }
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }

        return [];
    }
}
