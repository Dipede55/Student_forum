<?php
try {
    include 'includes/DatabaseConnection.php';

    $sql = 'DELETE FROM question WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();

    header('location: questions.php');
    exit; // Always exit after redirect
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Unable to delete joke: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>
