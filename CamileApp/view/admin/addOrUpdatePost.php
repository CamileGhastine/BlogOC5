<?php

$titleMessage = isset($formMessage['title']) ? $formMessage['title'] : '';
$chapoMessage = isset($formMessage['chapo']) ? $formMessage['chapo'] : '';
$contentMessage = isset($formMessage['content']) ? $formMessage['content'] : '';


// Request Add post ($update=false) or Update post ($update=true)
$update = (isset($post) OR isset($postUnvalid));

if($update)
{
    $titlePage = 'Modifier l\'article';
    $postId = isset($postUnvalid) ? $id : htmlspecialchars($post->getId());
    $formAction = 'index?route=admin.updatePost&id='.$postId;
    $title = isset($postUnvalid) ? htmlspecialchars($postUnvalid['title']) :  htmlspecialchars($post->getTitle());
    $chapo = isset($postUnvalid) ? htmlspecialchars($postUnvalid['chapo']) : htmlspecialchars($post->getChapo());
    $content = isset($postUnvalid) ? htmlspecialchars($postUnvalid['content']) : htmlspecialchars($post->getContent());
    $postCategory_id = isset($postUnvalid) ? htmlspecialchars($postUnvalid['category_id']) : htmlspecialchars($post->getCategory_id());
    $button = 'Modifier';
}
else
{
    $titlePage = 'Ajouter un article';
    $formAction = 'index?route=admin.addPost';
    $postId = null;
    $title = isset($postAddUnvalid) ? htmlspecialchars($postAddUnvalid['title']) : null;
    $chapo = isset($postAddUnvalid) ? htmlspecialchars($postAddUnvalid['chapo']) : null;;
    $content = isset($postAddUnvalid) ? htmlspecialchars($postAddUnvalid['content']) : null;;
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
                <a href="#" class="btn btn-primary">Valider/modifier les commentaires</a>
            </div>
            <div class="col-sm-4">
                <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
            </div>
        </div>

        <form method="post" action="<?= $formAction ?>" class="pb-3">
            <div class="row">
                <div class="form-group col-lg-8">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" name="title" value="<?= $title ?>">
                </div>
                <div class="col-lg-4 d-flex align-items-end">
                    <p><?= $titleMessage ?></p>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-8">
                    <label for="chapo">Chapô</label>
                    <input type="text" class="form-control" name="chapo" value="<?= $chapo ?>" maxlength="255">
                </div>
                <div class="col-lg-4 d-flex align-items-end">
                    <p><?= $chapoMessage ?></p>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-8">
                    <label for="content">Contenu</label>
                    <textarea class="form-control" name="content" rows="6"><?= $content ?></textarea>
                </div>
                <div class="col-lg-4 d-flex align-items-end">
                    <p><?= $contentMessage ?></p>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-8">
                    <SELECT class="form-control" name="category_id" size="1">
                        <?php foreach($categories as $category) :
                            $categoryName = htmlspecialchars($category->getName());
                            $categoryId = $category->getId();
                            $selected = $postCategory_id == $categoryId ? 'selected' : null;
                            ?>
                            <OPTION <?= $selected ?> value="<?= $categoryId ?>">
                                <?= $categoryName ?>
                            </OPTION>
                        <?php endforeach ?>
                    </SELECT>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-danger"><?= $button ?></button>
                </div>
                <div class="col-lg-4 d-flex justify-content-end">
                    <a class="btn btn-success " href="index.php?route=admin.posts">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>