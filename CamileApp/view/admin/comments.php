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
<div class="admin">
    <div class="row">
        <div class="col-lg-6">
            <h2><?= $title ?></h2>
        </div>
        <div class="col-lg-3 d-flex justify-content-end">
            <a href="index.php?route=admin.updatePost&id=<?= $postId ?>" class="btn-sm btn-primary">Modifier l'article</a>
        </div>
        <div class="col-lg-3 d-flex justify-content-end">
            <a href="index.php?route=admin.home" class="btn-sm btn-secondary">Retour au tableau de bord</a>
        </div>
    </div>
    <p><B><?= $chapo ?></B></p>
    <p><?= $content ?></p>
    <p>Par <?= $author ?></p>
    <p>Categorie : <?= $category ?></p>
    <p><small><?= $datePost ?></small></p>

    <div class="row pb-3">
        <div class="col-lg-6">
            <h1 id="comments">Commentaires (<?= $numberComments ?>) :</h1>
        </div>
        <div class="col-lg-3 d-flex justify-content-end">
            <a href="index.php?route=admin.updatePost&id=<?= $postId ?>" class="btn-sm btn-primary">Modifier l'article</a>
        </div>
        <div class="col-lg-3 d-flex justify-content-end">
            <a href="index.php?route=admin.home" class="btn-sm btn-secondary">Retour au tableau de bord</a>
        </div>
    </div>

    <?php if(isset($_GET['action'])):
        switch($_GET['action'])
        {
            case('validate') : $message = 'Le commentaire a été validé avec succès.';
                break;
            case('delete') : $message = 'Le commentaire a été supprimé avec succès.';
                break;
            case('update') : $message = 'Le commentaire a été modifié avec succès.';
                break;
        }
        ?>
        <div class="alert alert-success">
            <div class=row>
                <div class="col-sm-8">
                    <?= $message ?>
                </div>
            </div>
        </div>
    <?php endif ?>

    <div class="pb-3">
        <table class="table table-striped ">
            <tbody>
            <?php
            foreach($comments as $comment)
            {
                $commentId = $comment->getId();
                $pseudo = htmlspecialchars($comment->getPseudo());
                $validated = $comment->getValidated();
                $dateComment = 'le '.htmlspecialchars($comment->getDate_creation());
                $content = $validated == null ?  htmlspecialchars($comment->getContent()) : htmlspecialchars($comment->getContent());
                $btn = (isset($_GET['delete']) AND $_GET['delete'] == $commentId) ? 'secondary' : 'danger';
                $formUpdate = (isset($_GET['update']) AND $_GET['update'] == $commentId);
                ?>
                <tr >
                    <?php if(!$validated) : ?>
                        <td>
                            <a href="index.php?route=admin.validateComment&id=<?= $_GET['id'] ?>&commentId=<?= $commentId ?>&token=<?= $_SESSION['token'] ?>" class="btn-sm btn-success mt-3">Valider</a>
                        </td>
                    <?php else : ?>
                        <td></td>
                    <?php endif ?>
                    <?php if($formUpdate) : ?>
                        <td id="update">
                            <?= '<U><B>'.$pseudo.'</B> (<small>'.$dateComment.'</small>) :</U> ' ?>
                            <form method="post" action="index.php?route=admin.updateComment&id=<?= $postId ?>&commentId=<?= $commentId ?>">
                                <input type="text" class="form-control" name="content" value="<?= $content ?>">
                                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                <button type="submit" class="btn-sm btn-success">Modifier</button>
                                <a href="index.php?route=admin.comments&id=<?= $postId ?>#comments" class="btn-sm btn-primary">annuler</a>
                            </form>
                        </td>
                    <?php else : ?>
                        <td>
                            <?= '<U><B>'.$pseudo.'</B> (<small>'.$dateComment.'</small>) :</U> '.$content ?>
                        </td>
                    <?php endif ?>
                    <?php if($btn != 'secondary' AND !$formUpdate): ?>
                        <td>
                            <a href="index.php?route=admin.comments&id=<?= $postId ?>&update=<?= $commentId ?>#update" class="btn-sm btn-primary mt-3">modifier</a>
                        </td>
                    <?php else : ?>
                        <td></td>
                    <?php endif ?>
                    <td>
                        <a href="index.php?route=admin.comments&id=<?= $postId ?>&delete=<?= $commentId ?>#deleteConfirmation" class="btn-sm btn-<?= $btn ?> mt-3" class="btn-sm btn-danger mt-3">Supprimer</a>
                    </td>

                    <?php if($btn == 'secondary'): ?>
                        <td><a id="deleteConfirmation" href="index.php?route=admin.deleteComment&id=<?= $postId ?>&commentId= <?= $commentId ?>&token=<?= $_SESSION['token'] ?>" class="btn-sm btn-danger mt-3">Confirmer</a></td>
                        <td> <a href="index.php?route=admin.comments&id=<?= $postId ?>#comments" class="btn-sm btn-success mt-3">Annuler</a></td>
                    <?php else : ?>
                        <td></td>
                        <td></td>
                    <?php endif ?>

                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
