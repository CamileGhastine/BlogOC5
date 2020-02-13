<?php
$postId = $post->getId();
$title = htmlspecialchars($post->getTitle());
$numberComments = ($post->getNumberComments());
$contentUnvalid = isset($postAddUnvalid) ? htmlspecialchars($postAddUnvalid['content']) : null;
$contentMessage = isset($formMessage) ? htmlspecialchars($formMessage['content']) : null;
$successMessage = (isset($_GET['success']) AND $_GET['success'] == 'user') ? 'Une fois validé par l\'administrateur, votre commentaires sera publié.' : null;
?>
<div class="admin">
    <div class="row py-4 px-5 ">
        <div class="col-12">
            <div class="row">
                <div class="py-4 px-5 col-md-8 text-center text-md-left">
                    <h1 id="comments">Gérer les commentaires</h1>
                </div>
                <div class="col-md-4 text-center text-md-right px-5 pt-2 pb-4 py-md-4">
                    <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="py-3 py-md-0 px-5 col-md-8 text-center text-md-left">
                    <h2><?= $title ?></h2>
                </div>
                <div class="py-3 py-md-0 col-md-4 text-center text-md-right px-5">
                    <a href="index.php?route=admin.updatePost&id=<?= $postId ?>" class="btn btn-primary">Modifier
                        l'article</a>
                </div>
            </div>
        </div>
    </div>
    <?php if($numberComments == 0) $_GET['action']='none'; ?>
    <?php if(isset($_GET['action'])):
        switch($_GET['action'])
        {
            case('validate') :
                $message = 'Le commentaire a été validé avec succès.';
                break;
            case('delete') :
                $message = 'Le commentaire a été supprimé avec succès.';
                break;
            case('update') :
                $message = 'Le commentaire a été modifié avec succès.';
                break;
                case('none') :
                $message = 'Aucun commentaire pour cet article.';
                break;
        }
        ?>
        <div class="row ">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="alert alert-success text-center">

                    <?= $message ?>
                </div>
            </div>
        </div>
    <?php endif ?>

    <div class="row pb-3">
        <table class="col table table-striped table-responsive mx-0 mx-sm-5">
            <tbody>
            <?php foreach($comments as $comment) : ?>
                <?php
                $commentId = $comment->getId();
                $pseudo = htmlspecialchars($comment->getPseudo());
                $validated = $comment->getValidated();
                $dateComment = 'le ' . htmlspecialchars($comment->getDate_creation());
                $content = $validated == null ? htmlspecialchars($comment->getContent()) : htmlspecialchars($comment->getContent());
                $btn = (isset($_GET['delete']) AND $_GET['delete'] == $commentId) ? 'secondary' : 'danger';
                $formUpdate = (isset($_GET['update']) AND $_GET['update'] == $commentId);
                ?>
                <tr>
                    <?php if(!$formUpdate): ?>
                        <?php if($btn != 'secondary') : ?>
                            <td>
                                <?php if(!$validated) : ?>
                                    <a href="index.php?route=admin.validateComment&id=<?= $_GET['id'] ?>&commentId=<?= $commentId ?>&token=<?= $_SESSION['token'] ?>" class="d-none d-sm-block btn-sm btn-success mr-3">Valider</a>
                                <?php endif ?>
                            </td>
                        <?php else : ?>
                            <td></td>
                        <?php endif ?>
                    <?php endif ?>

                    <?php if($formUpdate) : ?>
                    <form method="post" action="index.php?route=admin.updateComment&id=<?= $postId ?>&commentId=<?= $commentId ?>">
                        <td></td>
                        <td id="update">
                            <?= '<B>' . $pseudo . ' :</B>' ?>
                            <input type="text" class="form-control" name="content" value="<?= $content ?>">
                        </td>
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        <td class="d-flex ">
                            <button type="submit" class="btn-sm btn-success mx-1">Modifier</button>
                            <a href="index.php?route=admin.comments&id=<?= $postId ?>#comments" class="btn-sm btn-danger text-center mx-1">annuler</a>
                        </td>
                        <td></td>
                    </form>
                <?php else : ?>
                    <td id="<?= ($btn == 'secondary') ? 'deleteConfirmation' : '' ?>">
                        <?= '<B>' . $pseudo . '</B>  : ' . '<div class="d-block d-sm-none"><br/></div>' . $content ?>
                    </td>
                    <?php if($btn != 'secondary') : ?>
                        <td class="d-flex flex-column">
                            <?php if(!$validated) : ?>
                                <a href="index.php?route=admin.validateComment&id=<?= $_GET['id'] ?>&commentId=<?= $commentId ?>&token=<?= $_SESSION['token'] ?>" class="d-block d-sm-none btn-sm btn-success mr-3">Valider</a>
                            <?php endif ?>
                            <a href="index.php?route=admin.comments&id=<?= $postId ?>&update=<?= $commentId ?>#update" class="btn-sm btn-primary mt-3">modifier</a>
                            <a href="index.php?route=admin.comments&id=<?= $postId ?>&delete=<?= $commentId ?>#deleteConfirmation" class="btn-sm btn-<?= $btn ?> mt-3" class="btn-sm btn-danger mt-3">Supprimer</a>
                        </td>
                        <td></td>
                    <?php else : ?>
                        <td></td>
                        <td class="d-flex flex-column">
                            <a href="index.php?route=admin.deleteComment&id=<?= $postId ?>&commentId= <?= $commentId ?>&token=<?= $_SESSION['token'] ?>"
                                   class="btn-sm btn-success mt-3">Confirmer</a>
                            <a href="index.php?route=admin.comments&id=<?= $postId ?>#comments"
                                   class="btn-sm btn-danger mt-3">Annuler</a>
                        </td>
                    <?php endif ; ?>
                 </tr>
                <?php endif ?>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>


