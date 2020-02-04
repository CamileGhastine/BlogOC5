<?php if(!empty($result)) : ?>
    <div class="py-4">
        <div class="alert alert-<?= ($result === 'ok') ? 'success' : 'danger' ?>">
            <div class="row">
                <div class="col-lg-6">
                    <?= ($result === 'ok') ? 'Le formulaire de contact a bien été envoyé.' : 'Une erreur est survenue et le formualire n\'a pas pu être envoyé.' ?>
                </div>
                <div class="col-lg-6">
                    <a href="index.php" class="btn btn-success">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card my-4">
                    <h4 id="comments" class="card-header text-center">Contactez-moi</h4>
                    <div class="card-body">
                        <form method="post" action="#">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="first_name">Prénom</label>
                                    <input class="form-control" type="text" name="first_name">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Nom</label>
                                    <input class="form-control" type="text" name="last_name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Courriel</label>
                                    <input class="form-control" type="text" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="subject">Objet</label>
                                    <input class="form-control" type="text" name="subject">
                                </div>
                                <div class="form-group">
                                    <label for="content">Message</label>
                                    <textarea class="form-control" type="text" name="content"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>


