
<p><a href="index.php">Retour à l'accueil</a></p>

<?php
foreach ($posts as $post)
{ ?>
    <h3> <B><?= htmlspecialchars($post['title']); ?></B></h3>
    <p><?= htmlspecialchars($post['chapo']); ?></p>
    <p><small>Publié le <?= htmlspecialchars($post['date_creation']); ?></small></p>
    <br/>
<?php } ?>