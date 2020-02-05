<?php
$all = isset($_GET['id']) ? false : true;
?>

    <div class="row">
        <div class="col-lg-12 d-flex justify-content-center menu menuCategories">
            <nav class="navbar navbar-expand-md navbar-dark justify-content-center">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navbar-nav align-items-center">
                        <a class="nav-item nav-link <?= $all ? 'active' : null ?>" href="index.php?route=front.posts">Tous les articles</a>

                        <?php
                        foreach($categories as $category)
                        {
                            $categoryName = $category->getNumberPosts() ? htmlspecialchars($category->getName()) : null;
                            $url = $category->getUrl();
                            if(!$all)
                            {
                                $categoryId = $category->getId();
                                $categoryId == $_GET['id'] ? $categoryDescription = htmlspecialchars($category->getDescription()) : null;
                                $active = $categoryId == $_GET['id'] ? 'active' : '';
                            }
                            ?>
                            <a class="nav-item nav-link <?= !$all ? $active : null ?>" href="<?= $url ?>"><?= $categoryName ?></a>
                            <?php
                        }
                        ?>
                    </div>
            </nav>
        </div>
    </div>

    <div class="card my-4">
        <p class="card-header text-center">
            <B><?= $all ? 'Tous les articles' : $categoryName ?></B>
            <br/>
            <?= $all ? '' : $categoryDescription ?>
        </p>
    </div>

<?php
foreach($posts as $post)
{
    $url = $post->getUrl();
    $title = htmlspecialchars($post->getTitle());
    $chapo = nl2br(htmlspecialchars($post->getChapo()));
    $date = $post->getDate_creation() == $post->getDate_modification() ? 'Publié le ' . htmlspecialchars($post->getDate_creation()) : 'Publié le ' . htmlspecialchars($post->getDate_creation()) . ' (mis à jour le ' . htmlspecialchars($post->getDate_modification()) . ')';
    $numberComments = $post->getNumberComments();
    ?>
    <div class="card my-4">
        <h3 class="card-header"><a href="<?= $url ?>"><B><?= $title ?></B></a></h3>
        <div class="card-body">
            <p><?= $chapo ?></p>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-6 text-left"> <a href="<?= $url ?>#comments">Commentaires (<?= $numberComments ?>)</a></div>
                <div class="col-lg-6 text-right text-muted"><small><?= $date ?></small></div>
            </div>
        </div>
    </div>
    <?php
}
?>