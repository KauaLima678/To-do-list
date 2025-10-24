<?php


function isLogged(): bool{
    return isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0;
}

// function login(array $usuario, string $email, string $senha) {
//     if($email === ($usuario['email']) && $senha === ($usuario['senha'])){
//         session_regenerate_id(delete_old_session: true);
//         $_SESSION['usuario'] = [
//             'email' => $usuario['email'],
//             'senha' => $usuario['senha'],
//             'nome' => $usuario['nome'],
//         ];
//         return true;
//     }

//     return false;
// }

function logout () {
    $_SESSION[''];
    session_destroy();
}

function requireLogin() {
    if (!isLogged()) {
        header('Location: login.php');
        exit;
    }
}