<p><a href="index.php">Retour à l'accueil</a></p>

<?php

//$post = $post->fetch()
?>
    <h3> <a href="index.php?route=front.post&id=<?= $post['id'] ?>"><B><?= htmlspecialchars($post['title']); ?></B></a></h3>
    <p><?= htmlspecialchars($post['chapo']); ?></p>
    <p><small>Publié le <?= htmlspecialchars($post['date_creation']); ?></small></p>
    <br/>
