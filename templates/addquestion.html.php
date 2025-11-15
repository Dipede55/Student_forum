<form action="" method="post" enctype="multipart/form-data">
     <label for="text">Type your question here:</label>
     <textarea name="text" rows="3" cols="40"></textarea>

     <select name="user">
          <option value="">select an user</option>
          <?php foreach($users as $user): ?>
               <option value="<?=htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8');?>">
               <?=htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8');?></option>
          <?php endforeach;?>
          </select>
     <select name="module">
          <option value="">select a module</option>
          <?php foreach($modules as $module): ?>
               <option value="<?=htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8');?>">
               <?=htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8');?></option>
          <?php endforeach;?>
          </select>
          <!-- image upload -->
     <label for="image">Upload image:</label>
     <input type="file" name="image" accept="image/*">
     
     <input type="submit" name="submit" value="Add">
</form>

