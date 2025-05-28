<?php

namespace api\generic;

class PostgresFactory
{
    public PostgresSingleton $banco;
    
    public function __construct()
    {
        $this->banco = PostgresSingleton::getInstance();
    }
}
