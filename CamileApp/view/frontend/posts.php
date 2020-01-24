
<p><a href="index.php">Retour à l'accueil</a></p>

<p>Tous les articles</p>
<?php
foreach ($categories as $category)
{
    $categoryName = htmlspecialchars($category->getName());
    $url = $category->getUrl();
    ?>
    <p><a href="<?= $url ?>"><?= $categoryName ?></a></p>
<?php
}


foreach($posts as $post)
{
    $url = $post->getUrl();
    $title = htmlspecialchars($post->getTitle());
    $chapo = htmlspecialchars($post->getChapo());
    $date = $post->getDate_creation() == $post->getDate_modification() ? 'Publié le '.htmlspecialchars($post->getDate_creation()) : 'Modifié le '. htmlspecialchars($post->getDate_modification());
    $numberComments = $post->getNumberComments();
    ?>

    <h3> <a href="<?= $url ?>"><B><?= $title ?></B></a></h3>
    <p><?= $chapo ?></p>
    <p><small><?= $date ?></small></p>
    <p>Commentaires (<?= $numberComments ?>)</p>
<?php
}
?>