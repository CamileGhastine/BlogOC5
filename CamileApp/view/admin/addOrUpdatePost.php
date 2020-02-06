<?php

// Return to form after problem with the form
$titleMessage = isset($formMessage['title']) ? $formMessage['title'] : '';
$chapoMessage = isset($formMessage['chapo']) ? $formMessage['chapo'] : '';
$contentMessage = isset($formMessage['content']) ? $formMessage['content'] : '';

// Request Add post ($update=false) or Update post ($update=true)
$update = (isset($post) OR isset($postUpdateUnvalid));

if($update) //update post
{
    $titlePage = 'Modifier l\'article';
    $postId = isset($postUpdateUnvalid) ? $postUpdateUnvalid['id'] : htmlspecialchars($post->getId());
    $formAction = 'index?route=admin.updatePost&id='.$postId;
    $title = isset($postUpdateUnvalid) ? htmlspecialchars($postUpdateUnvalid['title']) :  htmlspecialchars($post->getTitle());
    $chapo = isset($postUpdateUnvalid) ? htmlspecialchars($postUpdateUnvalid['chapo']) : htmlspecialchars($post->getChapo());
    $content = isset($postUpdateUnvalid) ? htmlspecialchars($postUpdateUnvalid['content']) : htmlspecialchars($post->getContent());
    $postCategory_id = isset($postUpdateUnvalid) ? htmlspecialchars($postUpdateUnvalid['category_id']) : htmlspecialchars($post->getCategory_id());
    $button = 'Modifier';
}
else // add post
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
            <div class="row">
                <div class="col-lg-6">
                    <h1><?= $titlePage ?></h1>
                </div>
                <?php if($update) : ?>
                    <div class="col-lg-3 d-flex justify-content-end">
                        <a href="index.php?route=admin.comments&id=<?= $_GET['id'] ?>#comments" class="btn btn-primary">Gérer ses commentaires</a>
                    </div>
                <?php endif ?>
                <div class="col-lg-<?= $update ? 3 : 6 ?> d-flex justify-content-end">
                    <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
                </div>
            </div>

            <form method="post" action="<?= $formAction ?>" class="pb-3">
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" name="title" value="<?= $title ?>">
                    </div>
                    <div class="col-lg-4 d-flex align-items-end">
                        <p><?= $titleMessage ?></p>
                    </div>
                </div>
                <?php if($update) : ?>
                    <input type="hidden" name="id" value="<?= $postId ?>">
                <?php else : ?>
                    <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
                <?php endif ?>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="chapo">Chapô</label>
                        <input type="text" class="form-control" name="chapo" value="<?= $chapo ?>" maxlength="255">
                    </div>
                    <div class="col-lg-4 d-flex align-items-end">
                        <p><?= $chapoMessage ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="content">Contenu</label>
                        <textarea class="form-control" name="content" rows="6"><?= $content ?></textarea>
                    </div>
                    <div class="col-lg-4 d-flex align-items-end">
                        <p><?= $contentMessage ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-12">
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
