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
    $numberComments = $post->getNumberComments();
    $postId = isset($postUpdateUnvalid) ? $id : htmlspecialchars($post->getId());
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
    $numberComments = '';
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
            <div class="col-lg-6 d-flex justify-content-end">
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

<h4 id="comments">Commentaires (<?= $numberComments ?>) :</h4>

<div class="pb-3">
    <table class="table table-striped ">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($comments as $comment)
        {
            $commentId = $comment->getId();
            $pseudo = htmlspecialchars($comment->getPseudo());
            $validated = $comment->getValidated();
            $dateComment = 'le '.htmlspecialchars($comment->getDate_creation());
            $content = $validated == null ?  '<B><I>'.htmlspecialchars($comment->getContent()).'</I></B>' : htmlspecialchars($comment->getContent())
            ?>
            <tr >
                <?php if(!$validated) : ?>
                    <td>
                        <a href="index.php?route=admin.validateComment&id=<?= $_GET['id'] ?>&commentId=<?= $commentId ?>" class="btn-sm btn-success mt-3">Valider</a>
                    </td>
                <?php else : ?>
                    <td></td>
                <?php endif ?>
                <td>
                    <?= '<U><B>'.$pseudo.'</B> (<small>'.$dateComment.'</small>) :</U> '.$content ?>
                </td>


                <td>
                    <a href="index.php?route=admin.categories&delete=#deleteConfirmation" class="btn-sm btn-primary mt-3">modifier</a>
                </td>
                <td>
                    <a href="index.php?route=admin.categories&delete=#deleteConfirmation" class="btn-sm btn-danger mt-3">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
