<?php 
     try{
          include 'includes/DatabaseConnection.php';

          $sql = 'SELECT question.id, question.text, question.date, user.name, question.img FROM question
          INNER JOIN module ON module_id = module.id
          INNER JOIN user ON user_id = user.id';
          $questions = $pdo->query($sql);
          $title = 'Questions List';
          ob_start();
          include 'templates/questions.html.php';
          $output = ob_get_clean();
     }catch (PDOException $e){
          $title = 'An error has occurred';
          $output = 'Database error: ' . $e->getMessage();
     }
     include 'templates/layout.html.php';

?>

