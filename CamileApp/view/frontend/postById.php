<p><a href="index.php?route=front.posts">Retour aux articles</a></p>

<?php
$title = htmlspecialchars($post->getTitle());
$chapo = htmlspecialchars($post->getChapo());
$content = htmlspecialchars($post->getContent());
$datePost = $post->getDate_creation() == $post->getDate_modification() ? 'Publié le '.htmlspecialchars($post->getDate_creation()) : 'Modifié le '. htmlspecialchars($post->getDate_modification());
$author = htmlspecialchars($post->getPseudo());
$category = htmlspecialchars($post->getCategory());
$numberComments = ($post->getNumberComments());
?>

<h2> <B><?=$title?></B></h2>
<p><B><?= $chapo ?></B></p>
<p><?= $content ?></p>
<p>Par <?= $author ?></p>
<p>Categorie : <?= $category ?></p>
<p><small><?= $datePost ?></small></p>
<br/>

<h4>Commentaires (<?= $numberComments ?>) :</h4>
<form method="post" action="index.php?route=back.addComment">
    <label for="content"></label>
    <textarea></textarea>
    <input type="submit" value="Réagir">
</form>
<?php
foreach($comments as $comment)
{
    $pseudo = htmlspecialchars($comment->getPseudo());
    $dateComment = 'le '.htmlspecialchars($comment->getDate_creation());
    $content = htmlspecialchars($comment->getContent())
    ?>
    <p><B><?= $pseudo.'</B> (<small>'.$dateComment.'</small>) : '.$content?></p>

<?php } ?>