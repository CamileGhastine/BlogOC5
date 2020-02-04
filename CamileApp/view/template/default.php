<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- meta référencement -->
    <meta name="title" content="Blog Camile Ghastine">
    <meta name="description" content="Ma formation, mes compétences et mes services pour vos projets numériques">
    <meta name="author" content="Camile Ghastine">

    <title>Camile Ghastine</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans%7CVast+Shadow" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div class="container-fluid">

    <?php
    $id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
    $pseudo = isset($_SESSION['pseudo']) ? htmlspecialchars($_SESSION['pseudo']) : null;
    $statut = isset($_SESSION['statut']) ? $_SESSION['statut'] : null;
    ?>

    <!-- En tête -->

    <header class="row">

        <div class="col-lg-6 offset-lg-3">
            <div class="row">
                <h1 class="col-lg-12 d-flex align-items-center justify-content-center">Camile Ghastine</h1>
                <h2 class="col-lg-12 d-flex align-items-center justify-content-center">Développeur web PHP/Symfony</h2>
                <p class="col-lg-12 d-flex align-items-center justify-content-center lead">Un code à chaque problème de vos projets</p>
            </div>
        </div>
        <div class="col-lg-3 d-flex align-items-center justify-content-center">
            <img class="logo" src="img/default/logo.png" alt="logo camile ghastine développement">
        </div></header>

    <div class="row">
        <div class="col-lg-12 d-flex justify-content-center menu">
            <nav class="navbar navbar-expand-md navbar-dark justify-content-center">
                <a class="navbar-brand" href="index.php">
                    <img class="logoIcon" src="img/default/logo.png" alt="logo camile ghastine développement">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navbar-nav align-items-center">
                        <a class="nav-item nav-link " href="index.php">Accueil</a>
                        <a class="nav-item nav-link  " href="?route=front.posts">Articles</a>
                        <a class="nav-item nav-link  " href="doc/cv.pdf">Mon CV</a>
                        <a class="nav-item nav-link  " href="?p=form.index">Me Contacter</a>
                        <?php if($id === null) : ?>
                            <a class="nav-item nav-link " href="index.php?route=back.connectionRegister">Enregistrement/connexion</a>
                        <?php else : ?>
                            <a class="nav-item nav-link " href="index.php?route=back.account">Compte de <?= ucfirst($pseudo) ?></a>

                            <a class="nav-item nav-link " href="index.php?route=back.disconnect">Déconnexion</a>
                        <?php endif ?>
                        <?php if($statut === 'admin') : ?>
                            <a class="nav-item nav-link " href="index.php?route=admin.home">Admin</a>
                        <?php endif ?></div>
                </div>
            </nav>
        </div>
    </div>

    <?= $content ?>

    <!-- Pied de page -->
    <footer class="row py-2 pl-lg-2">
        <div class="col-lg-1" id="caret"><a href="#"><i class="fas fa-angle-double-up fa-2x"></i></a></div>
        <a class="col-lg-3 btn" href="https://www.linkedin.com/in/camile-ghastine/" target="_blank"><img src="img/default/linkedIn.png" class="icon"></a>
        <a class="col-lg-3 btn" href="https://github.com/CamileGhastine" target="_blank"><img src="img/default/github.png" class="icon"></a>
        <?php if(!empty($_SESSION) && $_SESSION['statut'] == 'admin'): ?>
            <a class="btn btn-primary col-lg-2 btn btn-primary" href="?p=backend.users.admin">Administration</a>
        <?php endif; ?>
    </footer>


</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>