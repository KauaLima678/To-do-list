<?php
require_once('../app/db/conn.php');

$id = filter_input(INPUT_GET, 'id');

if($id){
    $sql = $pdo->prepare('DELETE FROM tasks WHERE id = (:id)');
    $sql-> bindValue(':id', $id);
    $sql->execute();
    header('Location: /index.php?status=delete');
    exit();
} else {
    header('Location: /index.php');
    exit();
}