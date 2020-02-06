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