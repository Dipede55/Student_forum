<p><?=$totalQuestions?> questions have been posted to the Student Forum database</p>
<?php foreach($questions as $question): ?>
    <blockquote>
        <?= htmlspecialchars($question['text'], ENT_QUOTES, 'UTF-8') ?>

        (by <a href="mailto:<?=htmlspecialchars($question['email'], ENT_QUOTES, 'UTF-8' );?>">
        <?=htmlspecialchars($question['name'], ENT_QUOTES, 'UTF-8'); ?></a>)
        <br /><?=htmlspecialchars($question['moduleName'], ENT_QUOTES, 'UTF-8'); ?>
        <a href="editquestion.php?id=<?=$question['id']?>">Edit</a>

        <form action="deletequestion.php" method="post">
            <input type="hidden" name="id" value="<?= $question['id'] ?>">
            <input type="submit" value="Delete">
        </form>
    </blockquote>

    <?php $display_date = date("D d M Y", strtotime($question['date'])); ?>
    <p><?= htmlspecialchars($display_date, ENT_QUOTES, 'UTF-8'); ?></p>

     <img height="100" src="../images/<?= htmlspecialchars($question['img'], ENT_QUOTES, 'UTF-8'); ?>" alt="Question image">

<?php endforeach; ?>