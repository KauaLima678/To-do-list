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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['route']) && $_GET['route'] === 'update'){
    require_once '../app/actions/update.php';
}

$tasks = [];

$sql = $pdo->query("SELECT * FROM tasks");

if ($sql->rowCount() > 0) {
    $tasks = $sql->fetchAll((PDO::FETCH_ASSOC));
}



?>
            <!DOCTYPE html>
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
            <div class="link">
                <i class="fa-solid fa-circle-plus"></i>
                <a href="">Adicionar Tarefa</a>
            </div>
            <div class="link">
                <i class="fa-solid fa-house"></i>
                <a href="./index.php">Home</a>
            </div>
            <div class="link">
                <i class="fa-solid fa-bars-progress"></i>
                <a href="./progress.php">Em andamento</a>
            </div>
            <div class="link">
                <i class="fa-solid fa-circle-check"></i>
                <a href="./ending.php">Concluídas</a>
            </div>
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
                                    <button type="submit" class="submit">Add Task</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                 </div>
        </div>
    </div>

    <script src="./assets/js/script.js"></script>
</body>

</html>

