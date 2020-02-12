<?php
$postId = $post->getId();
$title = htmlspecialchars($post->getTitle());
$numberComments = ($post->getNumberComments());
$contentUnvalid = isset($postAddUnvalid) ? htmlspecialchars($postAddUnvalid['content']) : null;
$contentMessage = isset($formMessage) ? htmlspecialchars($formMessage['content']) : null;
$successMessage = (isset($_GET['success']) AND $_GET['success'] == 'user') ? 'Une fois validé par l\'administrateur, votre commentaires sera publié.': null;
?>
<div class="admin">
    <div class="row py-4 px-5 ">
        <div class="col-12">
            <div class="row">
                <div class="py-4 px-5 col-md-8 text-center text-md-left">
                    <h1 id="comments">Gérer les <?= $numberComments ?> commentaires</h1>
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
                    <a href="index.php?route=admin.updatePost&id=<?= $postId ?>" class="btn btn-primary">Modifier l'article</a>
                </div>
            </div>
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
    <div class="row ">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="alert alert-success text-center">

                    <?= $message ?>
                </div>
            </div>
        </div>
    <?php endif ?>

    <div class="pb-3">
        <table class="table table-striped table-responsive mx-5">
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
                        <td class="d-flex flex-column">
                            <a href="index.php?route=admin.validateComment&id=<?= $_GET['id'] ?>&commentId=<?= $commentId ?>&token=<?= $_SESSION['token'] ?>" class="btn-sm btn-success mt-3">Valider</a>
                        </td>
                    <?php else : ?>
                        <td></td>
                    <?php endif ?>
                    <?php if($formUpdate) : ?>
                        <td id="update">
                            <?= '<B>'.$pseudo .' :</B>' ?>
                            <form method="post" action="index.php?route=admin.updateComment&id=<?= $postId ?>&commentId=<?= $commentId ?>">
                                <input type="text" class="form-control" name="content" value="<?= $content ?>">
                                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                <button type="submit" class="btn-sm btn-success">Modifier</button>
                                <a href="index.php?route=admin.comments&id=<?= $postId ?>#comments" class="btn-sm btn-primary">annuler</a>
                            </form>
                        </td>
                    <?php else : ?>
                        <td>
                            <?= '<B>' . $pseudo . '</B>  : '.'<div class="d-block d-sm-none"><br/></div>'. $content ?>
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
