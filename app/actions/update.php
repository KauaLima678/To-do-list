<?php

require_once('../app/db/conn.php');

$taskTitleEdit = filter_input(INPUT_POST, 'taskTitle');
$taskEdit = filter_input(INPUT_POST, 'task');
$id = filter_input(INPUT_GET, 'id');


if($taskEdit && $taskTitleEdit && $id){
    $sql = $pdo->prepare('UPDATE tasks SET task = :taskEdit, title = :taskTitleEdit WHERE id = :id');
    $sql->bindValue(':taskEdit', $taskEdit);
    $sql->bindValue(':taskTitleEdit', $taskTitleEdit);
    $sql->bindValue(':id', $id);
    $sql->execute();
    header('Location: /index.php');
    exit();

} else{
    header('Location: /index.php');
    exit();
}