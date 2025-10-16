<?php

require_once('../app/db/conn.php');

$task = filter_input(INPUT_POST, 'task');


if($task){
    $sql = $pdo->prepare('INSERT INTO to_do_list (Task) VALUES (:task)');
    $sql->bindValue(':task', $task);
    $sql->execute();
    header('Location: /index.php');
    exit();

} else{
    header('Location: /index.php');
    exit();
}