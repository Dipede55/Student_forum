

<?php 
function query ($pdo, $sql, $parameters = []){
$query = $pdo -> prepare ($sql);
$query -> execute($parameters) ;
return $query;
}
function totalQuestions ($pdo){
$query = query ($pdo, 'SELECT COUNT(*) FROM question');
$row = $query->fetch();
return $row[0]; 

//this is old way to write the function
// function totalJokes ($pdo){
// $query = $pdo -> prepare( 'SELECT COUNT(*) FROM joke');
// $query -> execute();
// $row = $query->fetch();
// return $row[0]; 
} 

function getQuestion ($pdo, $id) {
$parameters = [':id' => $id];
$query = query ($pdo, 'SELECT * FROM question WHERE id = :id', $parameters);
return $query->fetch ();
}

function updateQuestion($pdo, $questionId, $text) {
$query = 'UPDATE question SET text = :text WHERE id = :id';
$parameters = [':text' => $text, ':id' => $questionId];
query ($pdo, $query, $parameters);
}

function deleteQuestion ($pdo, $id) {
$parameters = [':id' => $id];
query($pdo, 'DELETE FROM question WHERE id = :id', $parameters);
}

function insertQuestion($pdo, $text, $userid, $moduleid) {
$query = 'INSERT INTO question (text, date, user_id, module_id)
VALUES (:text, CURDATE(), :userid, :moduleid)';
$parameters = [':text' => $text, ':userid' => $userid, ':moduleid' => $moduleid];
query($pdo, $query, $parameters);
}

#user function
function allUsers($pdo) {
    $users = query($pdo, 'SELECT * FROM user');
    return $users->fetchAll();
}

##module FUNCTIONS##
function allModules ($pdo) {
     $modules = query ($pdo, 'SELECT * FROM module');
     return $modules->fetchAll();
}


function allQuestions ($pdo) {
     $questions = query ($pdo, 'SELECT question.id, question.text, question.date, user.name, question.img FROM question
          INNER JOIN module ON module_id = module.id
          INNER JOIN user ON user_id = user.id');
     return $questions->fetchAll();
}

?>
