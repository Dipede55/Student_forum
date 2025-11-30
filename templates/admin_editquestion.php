<!-- <form id="admin" action="" method="post">
     <input type="hidden" name="questionid" value="<?=$question['id']?>">
     <label for="text">Edit your question here:</label>
     <textarea name="text" rows="3" cols="40">
     <?=$question['text']?>
     </textarea>
     <input type="submit" name="submit" value="Save">
</form> -->

<!-- templates/admin_editquestion.php -->
<form id="admin" action="" method="post">
    <input type="hidden" name="questionid" value="<?= $question['id'] ?>">
    
    <label for="text">Edit question:</label><br>
    <textarea name="text" rows="5" cols="60" required><?= htmlspecialchars($question['text']) ?></textarea>
    <br><br>
    
    <input type="submit" name="submit" value="Save Changes">
</form>

<p><a href="questions.php">Back to Questions</a></p>
<!-- <form action="questions.php" method="post">
     <input type="submit" value="Back to Questions">
</form> -->