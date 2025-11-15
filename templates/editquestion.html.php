<form action="" method="post">
     <input type="hidden" name="jokeid" value="<?=$question['id']?>">
     <label for="text">Edit your question here:</label>
     
     <textarea name="text" rows="3" cols="40">
     <?=$question['text']?>
     </textarea>
     
     <input type="submit" name="submit" value="Save">
</form>