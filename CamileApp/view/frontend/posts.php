<?php
$all = isset($_GET['id']) ? false : true;
$categoryDescriptionActive = 'Toutes mes formations et compétences dans le domaine du développement numérique et autres.';
?>
<div class="d-none d-sm-block">
    <h1 class=" pl-4 py-4 d-flex text-center justify-content-center justify-content-lg-start" id="title">Formations / Compétences</h1>
</div>
<div class="d-block d-sm-none">
    <h1 class=" py-4 d-flex text-center justify-content-center justify-content-lg-start" id="title">Formations<br/>Compétences</h1>
</div>
<div class="row">
    <div class="col-lg-4 pt-2">
        <div class="col-lg-12">
            <div class="text-center menu-categories">
                <nav class="nav flex-column nav-pills">
                    <h4 class="pt-4">Domaines</h4>
                    <a class="nav-item nav-link <?= $all ? 'active disabled' : null ?>" href="index.php?route=front.posts#title">Tous <span class="badge badge-dark"><?= $countPosts->getNumberPosts() ?></span></a>
                    <?php
                    foreach($categories as $category)
                    {
                        $categoryName = htmlspecialchars($category->getName());
                        $numberPosts = $category->getNumberPosts();
                        $url = $category->getUrl().'#title';
                        if(!$all)
                        {
                            $active = $category->getId() == $_GET['id'] ? 'active disabled' : null;
                            if($category->getId() == $_GET['id'])
                            {
                                $categoryNameActive = htmlspecialchars($category->getName());
                                $categoryDescriptionActive = htmlspecialchars($category->getDescription());
                            }
                        }
                        ?>
                        <a class="nav-item nav-link <?= !$all ? $active : null ?>" href="<?= $url ?>"><?= $categoryName ?> <span class="badge badge-dark"><?= $numberPosts ?></span></a>
                        <?php
                    }
                    ?>
                </nav>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-body text-center" id="description">
                    <p>
                        <B><?= isset($categoryNameActive) ? $categoryNameActive.'<br/>' : null ?></B>
                        <?= $categoryDescriptionActive ?>
                    </p>

                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <?php
            foreach($posts as $post)
            {
                $url = $post->getUrl();
                $title = htmlspecialchars($post->getTitle());
                $chapo = nl2br(htmlspecialchars($post->getChapo()));
                $date = $post->getDate_creation() == $post->getDate_modification() ? 'Publié le ' . htmlspecialchars($post->getDate_creation()) : 'Publié le ' . htmlspecialchars($post->getDate_creation()) . '<br/>(mis à jour le ' . htmlspecialchars($post->getDate_modification()) . ')';
                $numberComments = $post->getNumberComments();
                ?>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-12">
                        <div class="card my-4">
                            <h3 class="card-header"><a href="<?= $url ?>"><B><?= $title ?></B></a></h3>
                            <div class="card-body">
                                <p><?= $chapo ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6 text-center text-sm-left" id="comments-number">
                                        <a href="<?= $url ?>#comments"><?= $numberComments > 1 ? 'Commentaires' : 'Commentaire'?> <span class="badge badge-dark"><?= $numberComments ?></span></a>
                                    </div>
                                    <div class="col-md-6 text-center text-sm-right text-muted">
                                        <small><?= $date ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
