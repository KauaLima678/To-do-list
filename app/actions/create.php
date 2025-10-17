<?php

require_once('../app/db/conn.php');

$task = filter_input(INPUT_POST, 'task');
$titleTask = filter_input(INPUT_POST, 'taskTitle');


if($task && $titleTask){
    $sql = $pdo->prepare('INSERT INTO tasks (task, title) VALUES (:task, :title)');
    $sql->bindValue(':task', $task);
    $sql->bindValue(':title', $titleTask);
    $sql->execute();
    header('Location: /index.php');
    exit();

} else{
    header('Location: /index.php');
    exit();
}