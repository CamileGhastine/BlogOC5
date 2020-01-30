<p><a href="index.php?route=front.posts">Tous les articles</a></p>
<?php
foreach($categories as $category)
{
    $categoryName = $category->getNumberPosts() ? htmlspecialchars($category->getName()) : null;
    $categoryId = $category->getId();
    $categoryId == $_GET['id'] ? $categoryDescription = htmlspecialchars($category->getDescription()) : null ;
    $url = $category->getUrl();
    ?>

    <p><?= $categoryId == $_GET['id'] ? $categoryName : '<a href="'.$url.'">'.$categoryName.'</a>' ?></p>
    <?php
}
echo '<p class="border text-center">'.$categoryDescription.'</p>';

foreach($posts as $post)
{
    $url = $post->getUrl();
    $title = htmlspecialchars($post->getTitle());
    $chapo = nl2br(htmlspecialchars($post->getChapo()));
    $date = $post->getDate_creation() == $post->getDate_modification() ? 'Publié le '.htmlspecialchars($post->getDate_creation()) : 'Publié le '.htmlspecialchars($post->getDate_creation()).' (mis à jour le '. htmlspecialchars($post->getDate_modification()).')';
    $numberComments = $post->getNumberComments();
    ?>

    <h3> <a href="<?= $url ?>"><B><?= $title ?></B></a></h3>
    <p><?= $chapo ?></p>
    <p><small><?= $date ?></small></p>
    <p>Commentaires (<?= $numberComments ?>)</p>
    <?php
}
?>