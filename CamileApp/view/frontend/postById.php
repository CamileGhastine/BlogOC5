<p><a href="index.php?route=front.posts">Retour aux articles</a></p>

<?php
$postId = $post->getId();
$title = htmlspecialchars($post->getTitle());
$chapo = nl2br(htmlspecialchars($post->getChapo()));
$content = nl2br(htmlspecialchars($post->getContent()));
$datePost = $post->getDate_creation() == $post->getDate_modification() ? 'Publié le ' . htmlspecialchars($post->getDate_creation()) : 'Modifié le ' . htmlspecialchars($post->getDate_modification());
$author = htmlspecialchars($post->getPseudo());
$category = htmlspecialchars($post->getCategory());
$numberComments = ($post->getNumberComments());
$contentUnvalid = isset($postAddUnvalid) ? htmlspecialchars($postAddUnvalid['content']) : null;
$contentMessage = isset($formMessage) ? htmlspecialchars($formMessage['content']) : null;
$successMessage = (isset($_GET['success']) AND $_GET['success'] == 'user') ? 'Une fois validé par l\'administrateur, votre commentaires sera publié.' : null;
$urlCategory = 'index.php?route=front.postsByCategory&id=' . $post->getCategory_id();
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card my-4">
                <h1 class="card-header text-center"><?= $title ?></h1>
                <div class="card-body">
                    <p class="lead text-center"><?= $chapo ?></p>
                    <hr>
                    <p><?= $content ?></p>
                    <p class="text-right lead">Par <?= $author ?></p>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6 text-left">
                            <p>Categorie : <a href="<?= $urlCategory ?>"><?= $category ?></a></p>
                        </div>
                        <div class="col-lg-6 text-right text-muted"><p><small><?= $datePost ?></small></p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card my-4">
                <p id="comments" class="card-header">Réagissez ici</p>
                <div class="card-body">
                    <form method="post" action="index.php?route=back.addComment&id=<?= $postId ?>">
                        <div class="form-group">
                            <input name="post_id" type="hidden" value="<?= $postId ?>">
                            <textarea class="form-control" name="content" rows="3"><?= $contentUnvalid ?></textarea>
                        </div>
                        <P><?= $contentMessage ?></P>
                        <button type="submit" class="btn btn-primary" value="réagir">Réagir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card my-4">
                <h4 id="comments" class="card-header">Commentaires (<?= $numberComments ?>)</h4>
                <div class="card-body">
                    <?php
                    foreach($comments as $comment)
                    {
                        $pseudo = htmlspecialchars($comment->getPseudo());
                        $dateComment = 'le ' . htmlspecialchars($comment->getDate_creation());
                        $content = $comment->getValidated() == null ? '<B><I>Ce commentaire est en cours de validation.</I></B>' : htmlspecialchars($comment->getContent())
                        ?>
                        <p><?= '<U><B>' . $pseudo . '</B> (<small>' . $dateComment . '</small>) :</U> ' . $content ?></p>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>