<?php
if (isset($_POST['text'])) {
    try {
        include 'includes/DatabaseConnection.php';

        // Handle file upload
        $imageName = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDir = 'images/';
            $imageName = basename($_FILES['image']['name']);
            $targetFile = $targetDir . $imageName;
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        }

        // Insert into database
        $sql = 'INSERT INTO question SET 
                    text = :text, 
                    date = CURDATE(), 
                    img = :img,
                    user_id = :userid,
                    module_id = :moduleid';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':text', $_POST['text']);
        $stmt->bindValue(':userid', $_POST['user']);
        $stmt->bindValue(':moduleid', $_POST['module']);
        $stmt->bindValue(':img', $imageName);
        $stmt->execute();

        header('location: questions.php');
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    include 'includes/DatabaseConnection.php';

    // Fetch all users
    $userStmt = $pdo->query('SELECT id, name FROM user');
    $users = $userStmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch all modules
    $moduleStmt = $pdo->query('SELECT id, moduleName FROM module');
    $modules = $moduleStmt->fetchAll(PDO::FETCH_ASSOC);

    $title = 'Add a new question';
    ob_start();
    include 'templates/addquestion.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';
?>
