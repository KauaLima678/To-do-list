<?php
// register.php
session_start();
require_once '../app/db/conn.php'; // Ajuste o caminho

$message = '';

// Se o usuário já estiver logado, redireciona para a página principal
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['senha'] ?? '';

    if (empty($username) || empty($password)) {
        $message = 'Por favor, preencha todos os campos obrigatórios.';
    } elseif (strlen($password) < 6) {
        $message = 'A senha deve ter pelo menos 6 caracteres.';
    } else {
        // Hash da senha para segurança
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Verifica se o username já existe
            $stmt_check = $pdo->prepare("SELECT id FROM usuarios WHERE nome = :nome");
            $stmt_check->execute(['nome' => $username]);
            if ($stmt_check->fetch()) {
                $message = 'Este nome de usuário já está em uso.';
            } else {
                // Insere o novo usuário no banco de dados
                $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
                $stmt->execute([
                    'nome' => $username,
                    'email' => $email,
                    'senha' => $hashed_password
                ]);

                // Redireciona para a página de login após o cadastro
                $message = 'Cadastro realizado com sucesso! Você já pode fazer login.';
                header('Location: login.php?registered=true');
                exit;
            }
        } catch (\PDOException $e) {
            $message = 'Erro ao cadastrar: ' . $e->getMessage();
        }
    }
}
?> <!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="./assets/imgs/Favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="./assets/css/login.css">
    <title>Clear Task - Login</title>
</head>

<body>
    <div class="container">
        <div class="colLeft">
            <div class="form">
                <div class="header">
                    <h1>Cadastre-se</h1>
                    <p>Ja possui conta? Entre <a href="./login.php" style="text-decoration: none; cursor: pointer;">Aqui!</a></p>
                </div>
                <form method="post">
            <div class="inputContent">
                <label for="email" class="label">Email</label>
                <div class="input">
                    <i class="fa-regular fa-envelope icon"></i>
                    <input type="email" name="email" placeholder="Insira seu Email">
                </div>
            </div>

            <div class="inputContent">
                <label for="nome" class="label">Nome de Usuário</label>
                <div class="input">
                    <i class="fa-solid fa-user icon"></i>
                    <input type="nome" name="nome" placeholder="Insira seu nome de usuário">
                </div>
            </div>

            <div class="inputContent password">
                <label for="senha" class="label">Senha</label>
                <div class="input">
                    <i class="fa-solid fa-lock icon"></i>
                    <input type="password" name="senha" placeholder="Digite sua senha" id="senha">
                    <i  class="fa-solid fa-eye-slash icon" id="eye"></i>
                </div>
                <div class="actions">
                    <div class="remember">
                        <input type="checkbox">
                        <span>Lembrar de mim</span>
                    </div>
                    <div class="forget">
                        <span>Esqueci minha senha </span>
                    </div>
                </div>
            </div>
            <!-- <?php if($error_message): ?>
            <p>Email ou senha invalidos</p>
            <?php endif; ?> -->
            <div class="buttonArea">
                <button type="submit">Entrar</button>
            </div>

            <div class="div">
                <p>Ou entre com</p>

                <div class="social">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/2021_Facebook_icon.svg/512px-2021_Facebook_icon.svg.png" alt="Facebook">
                    <img src="https://cdn-icons-png.flaticon.com/512/0/747.png" alt="Apple">
                    <img src="https://cdn-icons-png.flaticon.com/512/720/720255.png" alt="Google">
                </div>
            </div>
        </form>
            </div>
        </div>
        <div class="colRight">
            <div class="shape">
                <img src="./assets/imgs/ClearTaskImg.png" alt="Imagem Hero">
                <div class="hero">
                    <h1>Clear Task</h1>
                    <p>Organize suas tarefas, afazeres, e compromissos com facilidade!</p>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/js/script.js"></script>
</body>

</html>