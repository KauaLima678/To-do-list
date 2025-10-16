<?php

$host = 'localhost';
$db = 'todolist';
$user = 'root';
$password = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    // Isso faz o PDO lançar uma exceção (erro) se houver problemas no SQL
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
    // Garante que o fetch (leitura dos dados) retorne um array associativo
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    // Desativa a preparação de statements emulado para mais segurança
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
   $pdo = new PDO ($dsn, $user, $password, $options);
} catch (\PDOException $e) {
    die('Erro de conexão: ' . $e->getMessage());
}



