<?php

$host = 'localhost';
$dbname = 'consultas_medicas'; 
$username = 'root'; 
$password = '';

try {
    
    $conexao = new PDO("mysql:host=$host", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


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
		
		CREATE TABLE usuarios (
			id INT AUTO_INCREMENT PRIMARY KEY,
			nome VARCHAR(50) NOT NULL,
			email VARCHAR(100) NOT NULL UNIQUE,
			senha VARCHAR(255) NOT NULL
		);
		
    ";
    $conexao->exec($sql);
    echo "Tabela 'pacientes' e 'usuarios' criada com sucesso!<br>";

} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>
