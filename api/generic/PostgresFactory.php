<?php

namespace generic;

class PostgresFactory
{
    public PostgresSingleton $banco;
    
    public function __construct()
    {
        $this->banco = PostgresSingleton::getInstance();
    }
}
