<?php
session_start();
require_once '../app/db/conn.php';
include '../app/components/sidebar.php';

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
    <link rel="icon" type="image/png" href="./assets/imgs/Favicon.png">
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
    <?= sidebar() ?>
    <div class="container">
        <h1>Tarefas concluídas</h1>
        <div class="content">
            <div class="tasksList">
                <?php if (count($tasks) === 0): ?>
                    <div class="notFound">
                        <img src="./assets/imgs/notFound2.png" alt="notFound" class="image">
                        <div class="text">
                            <p>Ops! Parece que você ainda não finalizou nenhuma tarefa!</p>
                        </div>
                        <div class="button">
                            <a href="/" class="addTaskBtn">Página inicial</a>
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
                                <a href="ending.php?id=<?= $task['id'] ?>&route=delete"><i
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