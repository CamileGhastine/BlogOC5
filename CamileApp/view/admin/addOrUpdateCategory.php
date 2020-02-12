<?php

// Return to form after problem with the form
$nameMessage = isset($formMessage['name']) ? $formMessage['name'] : '';
$descriptionMessage = isset($formMessage['description']) ? $formMessage['description'] : '';

// Request Add category ($update=false) or Update category ($update=true)
$update = (isset($category) OR isset($postUpdateUnvalid));

if($update) // update category
{
    $titlePage = 'Modifier la catégorie';
    $categoryId = isset($postUpdateUnvalid) ? $id : htmlspecialchars($category->getId());
    $formAction = 'index.php?route=admin.updateCategory&id='.$categoryId;
    $categoryName = isset($postUpdateUnvalid) ? $postUpdateUnvalid['name']: htmlspecialchars($category->getName());
    $categoryDescription = isset($postUpdateUnvalid) ? $postUpdateUnvalid['description']: htmlspecialchars($category->getDescription());
    $button = 'Modifier';
}
else // add category
{
    $titlePage = 'Ajouter une catégorie';
    $formAction = 'index.php?route=admin.addCategory';
    $categoryId = null;
    $categoryName = isset($postAddUnvalid) ? htmlspecialchars($postAddUnvalid['name']) : null;;
    $categoryDescription = isset($postAddUnvalid) ? htmlspecialchars($postAddUnvalid['description']) : null;;
    $button = 'Ajouter';
}
?>

<div class="admin">
    <div class="row">
        <div class="py-4 px-5 col-sm-8 text-center text-md-left">
            <h1><?= $titlePage ?></h1>
        </div>
        <div class="col-sm-4 text-center text-md-right px-5 pt-2 pb-4 py-md-4">
            <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
        </div>
    </div>

    <div class="row px-5">
        <div class="col-lg-12">
            <form method="post" action="<?= $formAction ?>" class="pb-3">


                    <div class="form-group col-lg-12 text-center text-sm-left">
                        <label for="name" >Nom</label>
                        <input type="text" class="form-control" name="name" value="<?= $categoryName ?>" maxlength="100" required>
                        <p class="message-form"><?= $nameMessage ?></p>
                    </div>

                    <div class="form-group col-lg-12 text-center text-sm-left">
                        <label for="description">description</label>
                        <textarea class="form-control" name="description" rows="2" maxlength="255" required><?= $categoryDescription ?></textarea>
                        <p class="message-form"><?= $descriptionMessage ?></p>
                    </div>

                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                <div class="row px-5">
                    <div class="col-sm-6 text-center text-sm-left mb-3">
                        <button type="submit" class="btn btn-danger"><?= $button ?></button>
                    </div>
                    <div class="col-sm-6 text-center text-sm-right">
                        <a class="btn btn-success " href="index.php?route=admin.categories">Annuler</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

