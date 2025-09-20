<?php
$active = 'favorite';
require_once '../includes/config.php';
if(!is_logged_in()) exit;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accommodation_id = $_POST['accommodation_id'];
    $action = $_POST['action'];

    if($action === 'add') {
        // Verificar si ya existe en la db
        $check = $pdo->prepare("SELECT * FROM user_accommodations WHERE user_id = ? AND accommodation_id = ?");
        $check->execute([$_SESSION['user_id'], $accommodation_id]);

        if($check->rowCount() > 0) {
            // Ya existe usuario en db
            header('Location: index.php?already=1');
            exit;
        } else {
            // Agregar en la db 
            $stmt = $pdo->prepare("INSERT INTO user_accommodations (user_id, accommodation_id) VALUES (?,?)");
            $stmt->execute([$_SESSION['user_id'], $accommodation_id]);
            header('Location: index.php?success=1');
            exit;
        }
    }  elseif($action === 'remove') {
        $stmt = $pdo->prepare("DELETE FROM user_accommodations WHERE user_id = ? AND accommodation_id = ?");
        $stmt->execute([$_SESSION['user_id'], $accommodation_id]);
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?removed=1');
        exit;
    }
}
