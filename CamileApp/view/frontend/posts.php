
<p><a href="index.php">Retour à l'accueil</a></p>

<p>Tous les articles</p>
<?php
while ($category = $categories->fetch())
{
    $categoryName = htmlspecialchars($category['name']);
    $categoryId = $category['id'];
    $url = 'index.php?route=front.postsByCategory&id='.$categoryId;
    ?>
    <p><a href="<?= $url ?>"><?= $categoryName ?></a></p>
<?php
}


while ($post = $posts->fetch())
{
    $url = 'index.php?route=front.postById&id='.$post['id'];
    $title = htmlspecialchars($post['title']);
    $chapo = htmlspecialchars($post['chapo']);
    $date = $post['date_creation'] == $post['date_modification'] ? 'Publié le '.htmlspecialchars($post['date_creation']) : 'Modifié le '. htmlspecialchars($post['date_modification']);
    $numberComments = $post['numberComments'];
    ?>

    <h3> <a href="<?= $url ?>"><B><?= $title ?></B></a></h3>
    <p><?= $chapo ?></p>
    <p><small><?= $date ?></small></p>
    <p>Commentaires (<?= $numberComments ?>)</p>
<?php
}
?>