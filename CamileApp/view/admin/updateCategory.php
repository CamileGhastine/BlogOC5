<div class="row">
    <div class="col-lg-12 mt-3">

        <div class="row pt-4">
            <div class="col-sm-8">
                <h1>Modifier une catégories</h1>
            </div>
            <div class="col-sm-4">
                <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
            </div>
        </div>

        <?php
        $categoryId = htmlspecialchars($category->getId());
        $categoryName = htmlspecialchars($category->getName());
        $categoryDescription = htmlspecialchars($category->getDescription());
        ?>
        <form method="post" action="index.php?route=admin.updateCategory&id=<?= $categoryId ?>" class="pb-3">

            <div class="form-group">
                <label for="name" >Nom</label>
                <input type="text" class="form-control" name="name" value="<?= $categoryName ?>">
            </div>

            <div class="form-group">
                <label for="description">description</label>
                <textarea class="form-control" name="description" rows="2"><?= $categoryDescription ?></textarea>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-danger">Modifier</button>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    <a class="btn btn-success " href="index.php?route=admin.categories">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>