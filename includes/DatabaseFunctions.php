

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

function totalModules ($pdo){
$query = query ($pdo, 'SELECT COUNT(*) FROM module');
$row = $query->fetch();
return $row[0]; 
}

function totalReplies($pdo, $questionId) {
$stmt = $pdo->prepare('SELECT COUNT(*) FROM replies WHERE question_id = :questionId');
$stmt->execute([':questionId' => $questionId]);
return $stmt->fetchColumn();
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

function updateModule($pdo, $id, $moduleName)
{
    global $db;
    $query = "UPDATE module SET moduleName = :moduleName WHERE id = :id";
    $parameters = [':moduleName' => $moduleName, ':id' => $id];
    return query($pdo, $query, $parameters);
}

function deleteQuestion ($pdo, $id) {
$parameters = [':id' => $id];
query($pdo, 'DELETE FROM question WHERE id = :id', $parameters);
}

function deleteModule($pdo, $id)
{
    $parameters = [':id' => $id];
    $query = "DELETE FROM module WHERE id = :id";
    query($pdo, $query, $parameters);
}

function deleteUser($pdo, $id)
{
    $query = "DELETE FROM user WHERE id = :id";
    $parameters = [':id' => $id];
    query($pdo, $query, $parameters);
}

function insertQuestion($pdo, $text, $userid, $imageName, $moduleid) {
$query = 'INSERT INTO question (text, date, img, user_id, module_id)
VALUES (:text, CURDATE(), :img, :userid, :moduleid)';
$parameters = [':text' => $text, ':userid' => $userid, ':img' => $imageName, ':moduleid' => $moduleid];
query($pdo, $query, $parameters);
}

function insertModule($pdo, $moduleName)
{
    
    $query = "INSERT INTO module (moduleName) VALUES (:moduleName)";
    $parameters = [':moduleName' => $moduleName];
    return query($pdo, $query, $parameters);
}

#user function
// function allUsers($pdo) {
//     $users = query($pdo, 'SELECT * FROM user');
//     return $users->fetchAll();
// }

function allUsers($pdo) {
    return query($pdo, 'SELECT id, name, email, username, 
                        COALESCE(ar.admin_role_name, "User") AS role
                        FROM user 
                        LEFT JOIN admin_roles ar ON user.admin_role_id = ar.id
                        ORDER BY name')->fetchAll();
}

##module FUNCTIONS##
function allModules ($pdo) {
     $modules = query ($pdo, 'SELECT * FROM module');
     return $modules->fetchAll();
}


function allQuestions($pdo) {
    // Get all questions with user + module info
    $questions = query($pdo, '
        SELECT q.id, q.text, q.date, q.img, 
               u.name, u.email, u.id AS user_id,
               m.moduleName
        FROM question q
        JOIN user u ON q.user_id = u.id
        JOIN module m ON q.module_id = m.id
        ORDER BY q.date DESC');
    return $questions->fetchAll();
}

function currentUser() {
    if (!isset($_SESSION['user_id'])) return null;
    global $pdo;
    $stmt = $pdo->prepare('SELECT u.*, ar.admin_role_name 
                           FROM user u 
                           LEFT JOIN admin_roles ar ON u.admin_role_id = ar.id 
                           WHERE u.id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}

//Reply functions
function addReply($pdo, $questionId, $userId, $text) {
    query($pdo, 'INSERT INTO replies (question_id, user_id, reply_text) 
                 VALUES (?, ?, ?)', [$questionId, $userId, $text]);
}

function getReply($pdo, $id) {
    $query = query($pdo, 'SELECT r.*, u.name FROM replies r JOIN user u ON r.user_id = u.id WHERE r.id = ?', [$id]);
    return $query->fetch();
}

function updateReply($pdo, $id, $text) {
    query($pdo, 'UPDATE replies SET reply_text = ? WHERE id = ?', [$text, $id]);
}

function deleteReply($pdo, $id) {
    query($pdo, 'DELETE FROM replies WHERE id = ?', [$id]);
}

function findUserById($pdo, $id) {
    $query = query($pdo, 'SELECT * FROM user WHERE id = ?', [$id]);
    return $query->fetch();
}
?>
