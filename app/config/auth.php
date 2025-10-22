<?php
session_start();

$USUARIO = [
    'email' => 'aluno@senai.com',
    'senha' => '@123456',
    'nome' => 'Kauã Lima',
];

function isLogged(): bool{
    return isset($_SESSION['usuario']);
}

function login(array $usuario, string $email, string $senha) {
    if($email === ($usuario['email']) && $senha === ($usuario['senha'])){
        session_regenerate_id(delete_old_session: true);
        $_SESSION['usuario'] = [
            'email' => $usuario['email'],
            'senha' => $usuario['senha'],
            'nome' => $usuario['nome'],
        ];
        return true;
    }

    return false;
}

function logout () {
    $_SESSION[''];
    session_destroy();
}