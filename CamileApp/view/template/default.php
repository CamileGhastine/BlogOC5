<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- meta référencement à faire ?-->
    <meta name="title" content="">
    <meta name="description" content="">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans%7CVast+Shadow" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Camile Ghastine</title>
</head>

<body>
<div class="container-fluid">

    <!-- En tête -->

    <header>
        <div class="col-lg-12">
            <h1 class="col-lg-12 text-center">Camile Ghastine</h1>
            <h2 class="col-lg-12 text-center">Développeur web PHP/Symfony</h2>
            <p class="col-lg-12 text-center">Un code à chaque problème de vos projets</p>
        </div>
    </header>

    <p><a href="index.php?">Accueil</a></p>
    <p><a href="index.php?route=admin.home">Admin</a></p>
    <?php if(empty($_SESSION)) : ?>
        <p><a href="index.php?route=back.connexionRegister">Enregistrement/connexion</a></p>
    <?php else : ?>
        <p><a href="index.php?route=back.account">Compte de <?= ucfirst($_SESSION['pseudo'])?></a></p>
        <p><a href="index.php?route=back.disconnect">Déconnection</a></p>

    <?php endif ?>
    <div class="px-5">
        <?= $content ?>
    </div>

</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>