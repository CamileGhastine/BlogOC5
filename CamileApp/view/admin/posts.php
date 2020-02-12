<div class="admin">
    <div class="row">
        <div class="py-4 px-5 col-sm-8 text-center text-md-left">
            <h1 id="title">Gérer les articles et les commentaires</h1>
        </div>
        <div class="col-sm-4 text-center text-md-right px-5 pt-2 pb-4 py-md-4">
            <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
        </div>
    </div>

    <div class="row">
        <div class="pb-3 mx-5 col-md-4 text-center text-md-left">
            <p><a href="index.php?route=admin.addPost" class="btn btn-success mt-3">Ajouter un article</a></p>
        </div>
        <div class="col-md-8 px-5">
            <?php if(isset($_GET['success'])):
                switch($_GET['success'])
                {
                    case('add') : $message = 'L\'article a été créé avec succès.';
                        break;
                    case('delete') : $message = 'L\'article et ses commentaires ont été supprimés avec succès.';
                        break;
                    case('update') : $message = 'L\'article a été modifié avec succès.';
                        break;
                }
                ?>
                <div class="alert alert-success">
                    <div class=row>
                        <div class="col-sm-8 text-center">
                            <?= $message ?>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>

    <div class="row pb-3 mx-0 mx-sm-5">
        <table class="col table table-striped table-responsive">
            <thead>
            <tr>
                <th scope="col">Article</th>
                <th scope="col">Catégorie</th>
                <th class="text-center" scope="col">Commentaires</th>
                <th scope="col">Articles</th>
                <th scope="col"></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($posts as $post):
                $postId = $post->getId();
                $title = htmlspecialchars($post->getTitle());
                $category = htmlspecialchars($post->getCategory());
                $numberComment = $post->getNumberComments() + $post->getNumberUnvalidated(); // number comments = numberValidatedComments + numberUnvalidatedComments
                $numberUnvalidated = $post->getNumberUnvalidated();
                $btn = (isset($_GET['delete']) AND $_GET['delete'] == $postId) ? 'secondary' : 'danger';

                ?>
                <tr>
                    <td><?= $title ?></td>
                    <td><?= $category ?></td>
                    <td class="text-center"><a href="index.php?route=admin.comments&id=<?= $postId ?>#comments" class="btn-sm btn-primary mt-3">Modifdier-<?= $numberUnvalidated ?>/<?= $numberComment ?></a></td>
                    <td class="text-center">
                        <a href="index.php?route=admin.updatePost&id=<?= $postId ?>" class="btn-sm btn-primary mt-3">Modifier</a>
                        <a href="index.php?route=admin.posts&delete=<?= $postId ?>#deleteConfirmation" class="btn-sm btn-<?= $btn ?> mt-3">Supprimer</a>
                    </td>

                    <?php if($btn == 'secondary'): ?>
                        <td class="text-center">
                            <a id="deleteConfirmation" href="index.php?route=admin.deletePost&id=<?= $postId ?>&token=<?= $_SESSION['token'] ?>" class="btn-sm btn-danger mt-3">Confirmer</a>
                            <a href="index.php?route=admin.posts" class="btn-sm btn-success mt-3">Annuler</a>
                        </td>
                    <?php else : ?>
                        <td></td>
                        <td></td>
                    <?php endif ?>

                </tr>
            <?php endforeach ?>

            </tbody>
        </table>
    </div>
</div>
