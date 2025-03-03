<?php
include('conexao.php');

    $sql = "CREATE DATABASE IF NOT EXISTS consultas_medicas";
    $conexao->exec($sql);
    echo "Banco de dados 'consultas_medicas' criado com sucesso!<br>";

    
    $conexao->exec("USE consultas_medicas");

    $sql = "
        CREATE TABLE IF NOT EXISTS pacientes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(255) NOT NULL,
            cpf VARCHAR(14) NOT NULL UNIQUE,
            endereco VARCHAR(255),
            cep VARCHAR(10),
            horario DATETIME,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ";
    $conexao->exec($sql);
    echo "Tabela 'pacientes' criada com sucesso!<br>";

?>
