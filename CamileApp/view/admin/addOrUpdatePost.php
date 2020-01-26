<?php
// Request Add post ($update=false) or Update post ($update=true)
$update = isset($post);

if($update)
{
    $titlePage = 'Modifier l\'article';
    $postId = htmlspecialchars($post->getId());
    $formAction = 'index?route=admin.updatePost&id='.$postId;
    $title = htmlspecialchars($post->getTitle());
    $chapo = htmlspecialchars($post->getChapo());
    $content = htmlspecialchars($post->getContent());
    $postCategory = htmlspecialchars($post->getCategory());
    $button = 'Modifier';
}
else
{
    $titlePage = 'Ajouter un article';
    $formAction = 'index?route=admin.addPost';
    $postId = null;
    $title = null;
    $chapo = null;
    $content = null;
    $postCategory = null;
    $button = 'Publier';
}

?>

<div class="row">
    <div class="col-lg-12 mt-3">
        <div class="row pt-4">
            <div class="col-sm-4">
                <h1><?= $titlePage ?></h1>
            </div>
            <div class="col-sm-4">
                <a href="#" class="btn btn-primary">Valider/modifier ses commentaires</a>
            </div>
            <div class="col-sm-4">
                <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
            </div>
        </div>

        <?php

        ?>

        <form method="post" action="<?= $formAction ?>" class="pb-3">

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" name="title" value="<?= $title ?>">
            </div>

            <div class="form-group">
                <label for="chapo">Chapô</label>
                <input type="text" class="form-control" name="chapo" value="<?= $chapo ?>">
            </div>

            <div class="form-group">
                <label for="content">Contenu</label>
                <textarea class="form-control" name="content" rows="6"><?= $content ?></textarea>
            </div>

            <div class="form-group ">
                <SELECT class="form-control" name="category_id" size="1">
                    <?php foreach($categories as $category) :
                        $categoryName = htmlspecialchars($category->getName());
                        $categoryId = $category->getId();
                        $selected = $postCategory == $categoryName ? 'selected' : null;
                        ?>
                        <OPTION <?= $selected ?> value="<?= $categoryId ?>">
                            <?= $categoryName ?>
                        </OPTION>
                    <?php endforeach ?>
                </SELECT>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-danger"><?= $button ?></button>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    <a class="btn btn-success " href="index.php?route=admin.posts">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>