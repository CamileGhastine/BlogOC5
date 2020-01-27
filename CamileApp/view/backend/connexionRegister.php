<?php
$showConnexion = 'show';
$showRegister = '';

$pseudoConnect = isset($pseudoRegister) ? $pseudoRegister : null;
{

    if(isset($formRegisterMessage))
    {
        $showRegister = 'show';
        $showConnexion = '';
        $pseudoMessage = isset($formRegisterMessage['pseudo']) ? $formRegisterMessage['pseudo'] : '';
        $emailMessage = isset($formRegisterMessage['email']) ? $formRegisterMessage['email'] : '';
        $passMessage = isset($formRegisterMessage['pass']) ? $formRegisterMessage['pass'] : '';
        $passConfirmMessage = isset($formRegisterMessage['passConfirm']) ? $formRegisterMessage['passConfirm'] : '';
        $pseudo = $postRegister['pseudo'];
        $email = $postRegister['email'];
        $pass = $postRegister['pass'];
        $passConfirm = $postRegister['passConfirm'];
    }
    else
    {
        $pseudoMessage = '';
        $emailMessage = '';
        $passMessage = '';
        $passConfirmMessage = '';
        $pseudo = '';
        $email = '';
        $pass = '';
        $passConfirm = '';
    }
}
?>
<?php if(isset($success) && $success): ?>
    <div class="alert alert-success">
        <div class=row>
            <div class="col-sm-10">
                L'enregistrement a été réalisé avec succès. Une fois validé par l'admistrateur, vous pourrez profiter de toutes les fonctionnalités du site.
            </div>
            <div class="col-sm-2">
                <a href="index.php" class="btn btn-success">Retour à l'accueil</a>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="accordion row py-4" id="accordion">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header" id="headingConnect">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseConnect" aria-expanded="true" aria-controls="collapseConnect">
                        Se connecter
                    </button>
                </h2>
            </div>
            <div id="collapseConnect" class="collapse <?= $showConnexion ?>" aria-labelledby="headingConnect" data-parent="#accordion">
                <div class="card-body">
                    <form action="?route=back.connect" method="post">
                        <div class="form-group">
                            <label for="pseudo">Pseudonyme</label>
                            <input class="form-control" type="text" name="pseudo" value="<?= $pseudoConnect ?>" required="required">
                        </div>

                        <div class="form-group">
                            <label for="pass">Mot de passe</label>
                            <input class="form-control" type="password" name="pass" required="required" pattern=".{6}" required="required" title="au moins 6 caractères">
                        </div>

                        <button class="btn btn-primary" type="submit" name="connexion">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header" id="headingRegister">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseRegister" aria-expanded="false" aria-controls="collapseRegister">
                        S'enregistrer
                    </button>
                </h2>
            </div>
            <div id="collapseRegister" class="collapse <?= $showRegister ?>" aria-labelledby="headingRegister" data-parent="#accordion">
                <div class="card-body">
                    <form action="index.php?route=back.register" method="post">
                        <div class="form-group">
                            <label for="pseudo">Pseudonyme</label>
                            <input class="form-control" type="text" name="pseudo" value="<?= $pseudo ?>" required="required">
                            <?= $pseudoMessage ?>
                        </div>

                        <div class="form-group">
                            <label for="pseudo">Courriel</label>
                            <input class="form-control" type="text" name="email" value="<?= $email ?>" required="required">
                            <?= $emailMessage ?>
                        </div>

                        <div class="form-group">
                            <label for="pass">Mot de passe</label>
                            <input class="form-control" type="password" name="pass" required="required">
                            <?= $passMessage ?>
                        </div>

                        <div class="form-group">
                            <label for="passConfirm">Confirmer le mot de passe</label>
                            <input class="form-control" type="password" name="passConfirm" required="required">
                            <?= $passConfirmMessage ?>
                        </div>

                        <button class="btn btn-primary" type="submit" name="connexion">S'enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

