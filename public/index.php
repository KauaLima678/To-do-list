<?php
require_once'../app/db/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['route']) && $_GET['route'] === 'create') {
    require_once'../app/actions/create.php';
}

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['route']) && $_GET['route'] === 'delete'){
    require_once'../app/actions/delete.php';
}

$tasks = [];

$sql = $pdo->query("SELECT * FROM to_do_list");

if($sql->rowCount() > 0){
    $tasks = $sql->fetchAll((PDO::FETCH_ASSOC));
}



?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/css/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>To do list</title>
</head>

<body>
    <div class="container">
        <h1>My To Do List</h1>
        <div class="formContainer">
            <form method="POST" action="index.php?route=create">
                <div class="addTaskCont">
                    <div class="inputContent">
                        <input type="text" name="task" id="task" placeholder="Add your task">
                        <button type="submit">Add Task</button>
                    </div>
                </div>
            </form>

            <div class="tasksList">
              <?php foreach($tasks as $task): ?>
                      <div class="task">
                        <div class="titleTask">
                            <input type="checkbox" <?= $task['Completed'] ? 'checked' : ''?>>
                            <p><?= $task['Task'] ?></p>
                        </div>
                    <div class="taskActions">
                        <a href=""><i class="fa-solid fa-pen-to-square edit"></i></a>
                        
                        <a href="index.php?id=<?= $task['Id']?>&route=delete"><i class="fa-solid fa-trash-can trash"></i></a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>


<!--<i class="fa-solid fa-check"></i> -->