<p><?=$totalQuestions?> questions have been submitted to the Student forum Database. </p>


<?php foreach($questions as $question): ?>
    <blockquote>
        <?= htmlspecialchars($question['text'], ENT_QUOTES, 'UTF-8') ?>

        (by <a href="mailto:<?=htmlspecialchars($question['email'], ENT_QUOTES, 'UTF-8' );?>">
        <?=htmlspecialchars($question['name'], ENT_QUOTES, 'UTF-8'); ?></a>)
        <br/> 
        <small> Module: <?=htmlspecialchars($question['moduleName'], ENT_QUOTES, 'UTF-8'); ?>
       
        <a href="editquestion.php?id=<?=$question['id']?>">Edit</a>
        </small>
        <form action="deletequestion.php" method="post">
            <input type="hidden" name="id" value="<?= $question['id'] ?>">
            <input type="submit" value="Delete">
        </form>
    </blockquote>

    <?php $display_date = date("D d M Y", strtotime($question['date'])); ?>
    <p><?= htmlspecialchars($display_date, ENT_QUOTES, 'UTF-8'); ?></p>

    <img height="100" src="/COMP1841/studentforum/images/<?= htmlspecialchars($question['img'], ENT_QUOTES, 'UTF-8'); ?>" alt="Question image">
    <?php 
    /* 
    <?php
        $isOwner = ($_SESSION['loggedin'] && $_SESSION['user_id'] == $q['user_id']);
        $isAdmin = $_SESSION['is_admin'];
        ?>

        <?php if ($isOwner): ?>
            <a href="editquestion.php?id=<?= $q['id'] ?>">Edit</a>
        <?php endif; ?>

        <?php if ($isOwner || $isAdmin): ?>
            <form action="deletequestion.php" method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?= $q['id'] ?>">
                <input type="submit" value="Delete" onclick="return confirm('Delete this question?')">
            </form>
        <?php endif; ?>
    */
    ?>
<?php endforeach; ?>