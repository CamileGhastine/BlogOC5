<p><a href="index.php?route=front.posts">Retour aux articles</a></p>

<?php
$postId = $post->getId();
$title = htmlspecialchars($post->getTitle());
$chapo = nl2br(htmlspecialchars($post->getChapo()));
$content = nl2br(htmlspecialchars($post->getContent()));
$datePost = $post->getDate_creation() == $post->getDate_modification() ? 'Publié le '.htmlspecialchars($post->getDate_creation()) : 'Modifié le '. htmlspecialchars($post->getDate_modification());
$author = htmlspecialchars($post->getPseudo());
$category = htmlspecialchars($post->getCategory());
$numberComments = ($post->getNumberComments());
$contentUnvalid = isset($postAddUnvalid) ? htmlspecialchars($postAddUnvalid['content']) : null;
$contentMessage = isset($formMessage) ? htmlspecialchars($formMessage['content']) : null;
$successMessage = (isset($_GET['success']) AND $_GET['success'] == 'user') ? 'Une fois validé par l\'administrateur, votre commentaires sera publié.': null;
?>

<h2> <B><?=$title?></B></h2>
<p><B><?= $chapo ?></B></p>
<p><?= $content ?></p>
<p>Par <?= $author ?></p>
<p>Categorie : <?= $category ?></p>
<p><small><?= $datePost ?></small></p>

<h4 id="comments">Commentaires (<?= $numberComments ?>) :</h4>
<P><?= $successMessage ?></P>
<form method="post" action="index.php?route=back.addComment&id=<?= $postId ?>">
    <label for="content">Réagissez ici :</label>
    <input name="post_id" type="hidden" value="<?= $postId ?>">
    <textarea name="content"><?= $contentUnvalid ?></textarea>
    <P><?= $contentMessage ?></P>
    <input type="submit" value="Réagir">
</form>
<?php
foreach($comments as $comment)
{
    $pseudo = htmlspecialchars($comment->getPseudo());
    $dateComment = 'le '.htmlspecialchars($comment->getDate_creation());
    $content = $comment->getValidated() == null ?  '<B><I>Ce commentaire est en cours de validation.</I></B>' : htmlspecialchars($comment->getContent())
    ?>
    <p><?= '<U><B>'.$pseudo.'</B> (<small>'.$dateComment.'</small>) :</U> '.$content?></p>

<?php } ?>