<p><a href="index.php?route=front.posts">Retour aux articles</a></p>

<?php
$title = htmlspecialchars($post['title']);
$chapo = htmlspecialchars($post['chapo']);
$content = htmlspecialchars($post['content']);
$datePost = $post['date_creation'] == $post['date_modification'] ? 'Publié le '.htmlspecialchars($post['date_creation']) : 'Modifié le '. htmlspecialchars($post['date_modification']);
$author = htmlspecialchars($post['pseudo']);
$category = htmlspecialchars($post['category']);
$numberComments = ($post['numberComments']);
?>

<h2> <B><?=$title?></B></h2>
<p><B><?= $chapo ?></B></p>
<p><?= $content ?></p>
<p>Par <?= $author ?></p>
<p>Categorie : <?= $category ?></p>
<p><small><?= $datePost ?></small></p>
<br/>

<h4>Commentaires (<?= $numberComments ?>) :</h4>
<?php
while($comment = $comments->fetch())
{
    $pseudo = htmlspecialchars($comment['pseudo']);
    $dateComment = 'le '.htmlspecialchars($post['date_creation']);
    $content = htmlspecialchars($comment['content'])
    ?>
    <p><B><?= $pseudo.'</B> (<small>'.$dateComment.'</small>) : '.$content?></p>

<?php } ?>