<?php
require_once '../app/config/auth.php'; // Inclui seu arquivo auth.php
logout(); // Chama a função logout
header('Location: login.php'); // Redireciona para a página de login
exit;