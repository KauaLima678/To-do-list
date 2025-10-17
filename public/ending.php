<?php
require_once '../app/db/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['route']) && $_GET['route'] === 'create') {
    require_once '../app/actions/create.php';
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['route']) && $_GET['route'] === 'delete') {
    require_once '../app/actions/delete.php';
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['route']) && $_GET['route'] === 'toggle') {
    require_once '../app/actions/toggle.php';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['route']) && $_GET['route'] === 'update') {
    require_once '../app/actions/update.php';
}

$tasks = [];

$sql = $pdo->query("SELECT * FROM tasks WHERE completed = 1 ORDER BY id DESC");

if ($sql->rowCount() > 0) {
    $tasks = $sql->fetchAll((PDO::FETCH_ASSOC));
}



?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/css/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=first_page" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>To do list</title>
</head>

<body>
    <div class="open" id="open" onclick="openSide()">
                <span class="material-symbols-outlined">
                    first_page
                </span>
            </div>
    <aside id="sidebar">
        <div class="user">
            <div class="userinfo">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTr3jhpAFYpzxx39DRuXIYxNPXc0zI5F6IiMQ&s"
                    alt="User image">
                <p class="username">User123</p>
            </div>
            <div class="close" onclick="closeSide()">
                <span class="material-symbols-outlined">
                    first_page
                </span>
            </div>
        </div>
        <div class="asideNav">
            <div class=" link">
                <i class="fa-solid fa-circle-plus"></i>
                <div class="textLink" id="textLink">
                    <a href="./cadastrar.php" id="link">Adicionar Tarefa</a>
                </div>
            </div>
            <div class="link">
                <i class="fa-solid fa-house"></i>
                <div class="textLink" id="textLink">
                    <a href="/" id="link">Home</a>
                </div>
            </div>
            <div class="link">
                <i class="fa-solid fa-bars-progress"></i>
                <div class="textLink" id="textLink">
                    <a href="./progress.php" id="link">Em andamento</a>
                </div>
            </div>
            <div class="link">
                <i class="fa-solid fa-circle-check"></i>
                <div class="textLink" id="textLink">
                    <a href="./ending.php" id="link">Concluídas</a>
                </div>
            </div>
        </div>
    </aside>
    <div class="container">
        <h1>Things to do</h1>
        <div class="content">
            <div class="tasksList">
                <?php if (count($tasks) === 0): ?>
                    <div class="notFound">
                        <img src="./assets/imgs/notFound.png" alt="notFound" class="image">
                        <div class="text">
                            <p>Parece que você ainda não cadastrou nenhuma tarefa!</p>
                        </div>
                        <div class="button">
                            <a href="./cadastrar.php" class="addTaskBtn">Cadastre aqui </a>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($tasks as $task): ?>
                        <div class="task" data-id="<?= $task['id'] ?>" data-title="<?= $task['title'] ?>"
                            data-desc="<?= $task['task'] ?>">
                            <div class="titleTask">
                                <div class="checkarea">
                                    <input type="checkbox" data-id="<?= $task['id'] ?>" class="checkbox" <?= $task['completed'] ? 'checked' : '' ?>>
                                </div>
                                <div class="title">
                                    <div class="lineGap"></div>
                                    <h1><?= $task['title'] ?></h1>
                                    <p><?= $task['task'] ?></p>
                                </div>
                            </div>
                            <div class="taskActions">
                                <a href="#" class="edit-btn" data-id="<?= $task['id'] ?>"><i
                                        class="fa-solid fa-pen-to-square"></i></a>

                                <a href="index.php?id=<?= $task['id'] ?>&route=delete"><i
                                        class="fa-solid fa-trash-can trash"></i></a>
                            </div>
                        </div>
                        <div class="formContainer">
                            <form method="POST" action="index.php?route=update&id=<?= $task['id'] ?>" class="addTaskList"
                                id="edit-form-<?= $task['id'] ?>">
                                <div class="addTaskCont">
                                    <div class="inputContent">
                                        <input type="text" name="taskTitle" id="taskTitle" placeholder="Add your task title"
                                            class="titleTask">
                                        <input type="text" name="task" id="task" placeholder="Add your task" class="descTask">

                                        <div class="line"></div>
                                        <div class="actionsAddArea">
                                            <div class="badgesActions">
                                                <div class="today">
                                                    <p><i class="fa-solid fa-calendar-days"></i> Para hoje</p>
                                                </div>
                                            </div>
                                            <div class="buttonArea">
                                                <button type="submit" class="cancel">Cancelar</button>
                                                <button type="submit" class="submit">Salvar alterações</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/script.js"></script>
</body>

</html>


<!--<i class="fa-solid fa-check"></i> -->