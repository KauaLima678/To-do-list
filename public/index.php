<?php
require_once '../app/db/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['route']) && $_GET['route'] === 'create') {
    require_once '../app/actions/create.php';
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['route']) && $_GET['route'] === 'delete') {
    require_once '../app/actions/delete.php';
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['route']) && $_GET['route'] === 'toggle'){
    require_once '../app/actions/toggle.php';
}

$tasks = [];

$sql = $pdo->query("SELECT * FROM to_do_list");

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
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>To do list</title>
</head>

<body>
    <aside>
        <div class="user">
            <div class="userinfo">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTr3jhpAFYpzxx39DRuXIYxNPXc0zI5F6IiMQ&s"
                    alt="User image">
                <p>User123</p>
            </div>
            <div class="close">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="asideNav">
            <div class="add">
                <a href="">Adicionar Tarefa</a>
                <i class="fa-solid fa-circle-plus"></i>
            </div>
            <a href="">Em andamento</a>
            <a href="">Tarefas Finalizadas</a>
        </div>
    </aside>
    <div class="container">
        <h1>Things to do</h1>
        <div class="content">
            <div class="formContainer">
                <form method="POST" action="index.php?route=create">
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
                                    <button type="submit">Add Task</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                 </div>

                <div class="line"></div>

                <div class="tasksList">
                    <?php foreach ($tasks as $task): ?>
                        <div class="formContainer">
                <form method="POST" action="index.php?route=create" class="addTaskList">
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
                                    <button type="submit">Add Task</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                 </div>
                        <div class="task">
                            <div class="titleTask">
                                <div class="checkarea">
                                        <input type="checkbox" data-id="<?= $task['Id'] ?>" class="checkbox" <?= $task['Completed'] ? 'checked' : '' ?> >
                                </div>
                                <div class="title">
                                    <div class="lineGap" ></div>
                                    <h1><?= $task['Title'] ?></h1>
                                    <p><?= $task['Task'] ?></p>
                                </div>
                            </div>
                            <div class="taskActions">
                                <a href=""><i class="fa-solid fa-pen-to-square edit"></i></a>

                                <a href="index.php?id=<?= $task['Id'] ?>&route=delete"><i
                                        class="fa-solid fa-trash-can trash"></i></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
           
        </div>
    </div>

    <script src="./assets/js/script.js"></script>
</body>

</html>


<!--<i class="fa-solid fa-check"></i> -->