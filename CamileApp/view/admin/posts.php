<div class="row py-4">
    <div class="col-sm-8">
        <h1>Administration des articles et des commentaires</h1>
    </div>
    <div class="col-sm-4">
        <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <p><a href="index.php?route=admin.addPost" class="btn btn-success mt-3">Ajouter un article</a></p>
    </div>
    <div class="col-lg-8">
        <?php if(isset($_GET['success'])):
            switch($_GET['success'])
            {
                case('add') : $message = 'L\'article a  été créé avec succès.';
                    break;
                case('delete') : $message = 'L\'article a  été supprimé avec succès.';
                    break;
                case('update') : $message = 'L\'article a  été modifié avec succès.';
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
    </div>
</div>

<div class="pb-3">
    <table class="table table-striped ">
        <thead>
        <tr>
            <th scope="col">Article</th>
            <th scope="col">Catégorie</th>
            <th class="text-center" scope="col">Commentaires</th>
            <th scope="col">Action</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($posts as $post):
            $postId = $post->getId();
            $title = htmlspecialchars($post->getTitle());
            $category = htmlspecialchars($post->getCategory());
            $numberComment = $post->getNumberComments() + $post->getNumberUnvalidated();
            $numberUnvalidated = $post->getNumberUnvalidated() == 0 ? null : 'dont '.'<a href="#" class="btn-sm btn-success mt-3">'.$post->getNumberUnvalidated().' à valider</a>';
            $btn = (isset($_GET['delete']) AND $_GET['delete'] == $postId) ? 'secondary' : 'danger';

            ?>
            <tr>
                <td><?= $title ?></td>
                <td><?= $category ?></td>
                <td class="text-center"><?= $numberComment.' '.$numberUnvalidated ?></td>
                <td>
                    <a href="index.php?route=admin.updatePost&id=<?= $postId ?>" class="btn-sm btn-primary mt-3">Modifier article et commentaires</a>
                    <a href="index.php?route=admin.posts&delete=<?= $postId ?>#deleteConfirmation" class="btn-sm btn-<?= $btn ?> mt-3">Supprimer</a>
                </td>
                <td>
                    <?php if($btn == 'secondary'): ?>
                        <a id="deleteConfirmation" href="index.php?route=admin.deletePost&id=<?= $postId ?>" class="btn-sm btn-danger mt-3">Confirmer</a>
                        <a href="index.php?route=admin.posts" class="btn-sm btn-success mt-3">Annuler</a
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>
</div>
