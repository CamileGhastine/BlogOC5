<div class="row py-4">
    <div class="col-sm-8">
        <h1>Administration des catégories</h1>
    </div>
    <div class="col-sm-4">
        <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <p><a href="index.php?route=admin.addCategory" class="btn btn-success mt-3">Ajouter une catégories</a></p>
    </div>
    <div class="col-lg-8">
        <?php if(isset($_GET['success'])):
            $alert = 'success';
            switch($_GET['success'])
            {
                case('add') :
                    $message = 'La catégorie a  été créée avec succès.';
                break;
                case('delete') :
                    $message = 'La catégorie a  été supprimée avec succès.<br/> Si elle Contenait des articles, ils ont été transférés dans la catégorie "non classé" ';
                break;
                case('update') :
                    $message = 'La catégorie a  été modifiée avec succès.';
                break;
                case('no') :
                    $message = 'Cette catégorie ne peut pas être supprimée.';
                    $alert = 'danger';
                break;
            }
            ?>
        <div class="alert alert-<?= $alert ?>">
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
            <th scope="col">Catégorie</th>
            <th scope="col" class="text-center">Articles</th>
            <th scope="col">Action</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($categories as $category):
            $categoryName = htmlspecialchars($category->getName());
            $numberPosts = $category->getNumberPosts();
            $categoryId = $category->getId();
            $url = $category->getUrl();
            $btn = (isset($_GET['delete']) AND $_GET['delete'] == $categoryId) ? 'secondary' : 'danger';

            ?>
            <tr>
                <td><?= $categoryName ?></td>
                <td class="text-center"><?= $numberPosts ?></td>
                <?php if($categoryId != 1) : ?>
                    <td>
                        <a href="index.php?route=admin.updateCategory&id=<?= $categoryId ?>" class="btn-sm btn-primary mt-3">Modifier</a>
                        <a href="index.php?route=admin.categories&delete=<?= $categoryId ?>#deleteConfirmation" class="btn-sm btn-<?= $btn ?> mt-3">Supprimer</a>
                    </td>
                <?php endif ?>
                <td>
                    <?php if($btn == 'secondary'): ?>
                        <a id="deleteConfirmation" href="index.php?route=admin.deleteCategory&id=<?= $categoryId ?>" class="btn-sm btn-danger mt-3">Confirmer</a>
                        <a href="index.php?route=admin.categories" class="btn-sm btn-success mt-3">Annuler</a
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>
</div>
