<?php

$postId = $post->getId();
$title = htmlspecialchars($post->getTitle());
$chapo = nl2br(htmlspecialchars($post->getChapo()));
$content = nl2br(htmlspecialchars($post->getContent()));
$datePost = $post->getDate_creation() == $post->getDate_modification() ?
    'Publié le ' . htmlspecialchars($post->getDate_creation()) :
    'Publié le ' . htmlspecialchars($post->getDate_creation()).'<br/>(modifié le ' . htmlspecialchars($post->getDate_modification()).')';
$author = htmlspecialchars($post->getPseudo());
$category = htmlspecialchars($post->getCategory());
$numberComments = ($post->getNumberComments());
$contentUnvalid = isset($postAddUnvalid) ? htmlspecialchars($postAddUnvalid['content']) : null;
$contentMessage = isset($formMessage) ? htmlspecialchars($formMessage['content']) : null;
$successMessage = (isset($_GET['success']) AND $_GET['success'] == 'user') ? 'Une fois validé par l\'administrateur, votre commentaires sera publié.' : null;
$urlCategory = 'index.php?route=front.postsByCategory&id=' . $post->getCategory_id();
?>
<div class="row">
    <div class="col-lg-12 text-center">
        <a class="btn pt-4" href="index.php?route=front.posts"><img src="img/post/return.png" id="icon"></a>

    </div>
    <div class="col-lg-12">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10">
                <div class="card my-4">
                    <h1 class="card-header text-center"><?= $title ?></h1>
                    <div class="card-body">
                        <p class="lead text-center"><?= $chapo ?></p>
                        <hr>
                        <p><?= $content ?></p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 text-center text-sm-left">
                               <a href="<?= $urlCategory ?>"><?= $category ?></a>
                            </div>
                            <div class="col-md-6 text-center text-sm-right text-muted">
                                <small><?= $datePost ?></small><br/>Par <?= ucfirst($author) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
