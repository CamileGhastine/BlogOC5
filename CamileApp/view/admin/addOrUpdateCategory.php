<?php
// Request Add category ($update=false) or Update category ($update=true)
$update = isset($category);

if($update)
{
    $titlePage = 'Modifier la actégorie';
    $categoryId = htmlspecialchars($category->getId());
    $formAction = 'index.php?route=admin.updateCategory&id='.$categoryId;
    $categoryName = htmlspecialchars($category->getName());
    $categoryDescription = htmlspecialchars($category->getDescription());
    $button = 'Modifier';
}
else
{
    $titlePage = 'Ajouter une catégorie';
    $formAction = 'index.php?route=admin.addCategory';
    $categoryId = null;
    $categoryName = null;
    $categoryDescription = null;
    $button = 'Ajouter';
}
?>

<div class="row">
    <div class="col-lg-12 mt-3">

        <div class="row pt-4">
            <div class="col-sm-8">
                <h1><?= $titlePage ?></h1>
            </div>
            <div class="col-sm-4">
            </div>
        </div>

        <form method="post" action="<?= $formAction ?>" class="pb-3">

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
                    <button type="submit" class="btn btn-danger"><?= $button ?></button>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    <a class="btn btn-success " href="index.php?route=admin.categories">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>