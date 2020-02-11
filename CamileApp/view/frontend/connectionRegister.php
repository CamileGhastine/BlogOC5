<?php
// Manage the switch between registration and connection accordion show
$showconnection = 'show';
$showRegister = '';

// Return to form connection after problem
$pseudoConnect = isset($pseudoRegister) ? $pseudoRegister : null;
$connectionMessage = isset($connectionMessage) ? $connectionMessage : null;

// Return to form registration after problem
if(isset($formRegisterMessage))
{
    $showRegister = 'show';
    $showconnection = '';
    $pseudoMessage = isset($formRegisterMessage['pseudo']) ? $formRegisterMessage['pseudo'] : '';
    $emailMessage = isset($formRegisterMessage['email']) ? $formRegisterMessage['email'] : '';
    $passMessage = isset($formRegisterMessage['pass']) ? $formRegisterMessage['pass'] : '';
    $passConfirmMessage = isset($formRegisterMessage['passConfirm']) ? $formRegisterMessage['passConfirm'] : '';
    $pseudo = htmlspecialchars($postRegister['pseudo']);
    $email = htmlspecialchars($postRegister['email']);
    $pass = htmlspecialchars($postRegister['pass']);
    $passConfirm = htmlspecialchars($postRegister['passConfirm']);
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

if(isset($_GET['access']))
{
    switch($_GET['access'])
    {
        case 'adminDenied' :
            $accessMessage = 'Vous ne pouvez pas accéder à cette page sans être connecté en tant qu\'administrateur.';
            break;
        case 'userDenied' :
            $accessMessage ='Vous ne pouvez pas accéder à cette page sans être connecté.';
        case 'token':
            $accessMessage = 'Erreur de vérification. Merci de vous reconnecter.';
            Break;
    }
}

if(isset($success))
{
    $successMessage = ' L\'enregistrement a été réalisé avec succès. Une fois validé par l\'admistrateur, vous pourrez profiter de
                toutes les fonctionnalités du site.';
}
elseif(isset($_GET['success']) && $_GET['success'] == 'unlock')
{
    $successMessage ='Un nouveau mot de passe vous a été envoyé sur votre boite mail.';
}

?>

<?php if(isset($successMessage)) : ?>
    <div class="alert alert-success mt-4">
        <div class=row>
            <div class="col-sm-10">
                <?= $successMessage ?>
            </div>
            <div class="col-sm-2">
                <a href="index.php" class="btn btn-success">Retour à l'accueil</a>
            </div>
        </div>
    </div>
<?php elseif(isset($accessMessage)) : ?>
    <div class="alert alert-danger mt-4">
        <div class=row>
            <div class="col-lg-10">
                <?= $accessMessage ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<!--connexion-->
<div class="accordion row" id="accordion">
    <div class="col-lg-6 pt-5">
        <div class="card">
            <div class="card-header" id="headingConnect">
                <h2>
                    <button class="btn btn-link" id="btn-title" type="button" data-toggle="collapse" data-target="#collapseConnect"
                            aria-expanded="true" aria-controls="collapseConnect">
                        Se connecter
                    </button>
                </h2>
            </div>
            <div id="collapseConnect" class="collapse <?= $showconnection ?>" aria-labelledby="headingConnect"
                 data-parent="#accordion">
                <div class="card-body">
                    <form action="index.php?route=front.connect" method="post" class="mx-4 my-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label col-form-label-sm text-center" for="pseudo">Pseudonyme</label>
                            <div class="col-sm-8">
                                <input class="form-control form-control-sm" type="text" name="pseudo" value="<?= $pseudoConnect ?>" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label col-form-label-sm text-center" for="pass">Mot de passe</label>
                            <div class="col-sm-8">
                                <input class="form-control form-control-sm" type="password" name="pass"
                                       required="required" pattern=".{6,}" title="au moins 6 caractères">
                            </div>
                        </div>
                        <div class="message-form pb-2 text-center"><?= $connectionMessage ?></div>
                        <div class="text-center">
                            <button class="btn btn-primary mb-3" type="submit" name="connection" id="btn-perso1">Se connecter</button>
                        </div>
                        <div class="text-center">
                            <a href="index.php?route=front.forgottenPassword" class="texte-center" id="forgotten-password">Mot de passe oublié</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--    Registration-->
    <div class="col-lg-6 pt-5">
        <div class="card">
            <div class="card-header" id="headingRegister">
                <h2>
                    <button class="btn btn-link collapsed" id="btn-title" type="button" data-toggle="collapse"
                            data-target="#collapseRegister" aria-expanded="false" aria-controls="collapseRegister">
                        S'enregistrer
                    </button>
                </h2>
            </div>
            <div id="collapseRegister" class="collapse <?= $showRegister ?>" aria-labelledby="headingRegister"
                 data-parent="#accordion">
                <div class="card-body">
                    <form action="index.php?route=front.register" method="post" class="mx-4 my-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label col-form-label-sm text-center" for="pseudo">Pseudonyme</label>
                            <div class="col-sm-8">
                                <input class="form-control form-control-sm" type="text" name="pseudo" required value="<?= $pseudo ?>">
                                <div class="message-form pb-2"><?= $pseudoMessage ?></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label col-form-label-sm text-center" for="email">Courriel</label>
                            <div class="col-sm-8">
                                <input class="form-control form-control-sm" type="text" name="email" required value="<?= $email ?>">
                                <div class="message-form pb-2"><?= $emailMessage ?></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label col-form-label-sm text-center" for="pass">Mot de passe</label>
                            <div class="col-sm-8">
                                <input class="form-control form-control-sm" type="password" name="pass" required>
                                <div class="message-form pb-2"><?= $passMessage ?></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label col-form-label-sm text-center" for="passConfirm">Confirmer le mot de passe</label>
                            <div class="col-sm-8">
                                <input class="form-control form-control-sm" type="password" name="passConfirm" required>
                                <div class="message-form pb-2"><?= $passConfirmMessage ?></div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" name="connection" id="btn-perso1">S'enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

