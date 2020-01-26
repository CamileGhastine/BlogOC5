<div class="row">
    <div class="col-lg-12 mt-3">
        <div class="row pt-4">
            <div class="col-sm-8">
                <h1>Modifier l'article</h1>
            </div>
            <div class="col-sm-4">
                <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
            </div>
        </div>

        <?php
        $postId = htmlspecialchars($post->getId());
        $title = htmlspecialchars($post->getTitle());
        $chapo = htmlspecialchars($post->getChapo());
        $content = htmlspecialchars($post->getContent());
        $postCategory = htmlspecialchars($post->getCategory());
        ?>

        <form method="post" action="index?route=admin.updatePost&id=<?= $postId ?>" class="pb-3">

            <div class="form-group">
                <label for="title" >Titre</label>
                <input type="text" class="form-control" name="title" value="<?= $title ?>">
            </div>

            <div class="form-group">
                <label for="chapo" >Chapô</label>
                <input type="text" class="form-control" name="chapo" value="<?= $chapo ?>">
            </div>

            <div class="form-group">
                <label for="content">Contenu</label>
                <textarea class="form-control" name="content" rows="6"><?= $content ?></textarea>
            </div>

            <div class="form-group ">
                <SELECT class="form-control" name="category_id" size="1">
                    <?php foreach ($categories as $category) :
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
                    <button type="submit" class="btn btn-danger">Modifier</button>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    <a class="btn btn-success " href="index.php?route=admin.posts">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>