<?php
session_start();
require_once('../app/db/conn.php');

if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] === null ){
    header("Location: ../../public/login.php");
    exit();
}

$userID = $_SESSION["user_id"];

$task = filter_input(INPUT_POST, 'task');
$titleTask = filter_input(INPUT_POST, 'taskTitle');


if($task && $titleTask){
    $sql = $pdo->prepare('INSERT INTO tasks (id_usuario, task, title) VALUES (:id_usuario, :task, :title)');
    $sql->bindValue(':task', $task);
    $sql->bindValue(':id_usuario', $userID);
    $sql->bindValue(':title', $titleTask);
    $sql->execute();
    header('Location: /index.php');
    exit();

} else{
    header('Location: /index.php');
    exit();
}