<?php 
     try{
          include '../includes/DatabaseConnection.php';
          include '../includes/DatabaseFunctions.php';

          $sql = 'SELECT question.id, question.text, question.date, user.name, question.img FROM question
          INNER JOIN module ON module_id = module.id
          INNER JOIN user ON user_id = user.id';
          $questions = $pdo->query($sql);
          $title = 'Questions List';
          $totalQuestions = totalQuestions($pdo);
          ob_start();
          include '../templates/admin_questions.html.php';
          $output = ob_get_clean();
     }catch (PDOException $e){
          $title = 'An error has occurred';
          $output = 'Database error: ' . $e->getMessage();
     }
     include '../templates/admin_layout.html.php';

?>

