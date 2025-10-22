<?php require_once'../app/db/conn.php';

$taskId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if($taskId){
    $sql = 'UPDATE tasks SET completed = NOT completed WHERE Id = :id';

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $taskId, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(['success' => true, 'id' => $taskId, 'completed' => $newStatus]);
        exit();
    } catch (\PDOException $e) {
        die('Erro ao atualizar tarefa:' . $e->getMessage());
    }
}

exit();