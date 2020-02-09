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
<div class="accordion row py-4" id="accordion">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header" id="headingConnect">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseConnect"
                            aria-expanded="true" aria-controls="collapseConnect">
                        Se connecter
                    </button>
                </h2>
            </div>
            <div id="collapseConnect" class="collapse <?= $showconnection ?>" aria-labelledby="headingConnect"
                 data-parent="#accordion">
                <div class="card-body">
                    <form action="index.php?route=front.connect" method="post">
                        <div class="form-group">
                            <label for="pseudo">Pseudonyme</label>
                            <input class="form-control" type="text" name="pseudo" value="<?= $pseudoConnect ?>"
                                   required="required">
                        </div>

                        <div class="form-group">
                            <label for="pass">Mot de passe</label>
                            <input class="form-control" type="password" name="pass" required="required" pattern=".{6,}"
                                   required="required" title="au moins 6 caractères">
                        </div>

                        <button class="btn btn-primary" type="submit" name="connection">Se connecter</button>
                        <p><?= $connectionMessage ?></p>
                        <a href="index.php?route=front.forgottenPassword">Mot de passe oublié</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!--    Registration-->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header" id="headingRegister">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseRegister" aria-expanded="false" aria-controls="collapseRegister">
                        S'enregistrer
                    </button>
                </h2>
            </div>
            <div id="collapseRegister" class="collapse <?= $showRegister ?>" aria-labelledby="headingRegister"
                 data-parent="#accordion">
                <div class="card-body">
                    <form action="index.php?route=front.register" method="post">
                        <div class="form-group">
                            <label for="pseudo">Pseudonyme</label>
                            <input class="form-control" type="text" name="pseudo" value="<?= $pseudo ?>">
                            <?= $pseudoMessage ?>
                        </div>

                        <div class="form-group">
                            <label for="email">Courriel</label>
                            <input class="form-control" type="text" name="email" value="<?= $email ?>">
                            <?= $emailMessage ?>
                        </div>

                        <div class="form-group">
                            <label for="pass">Mot de passe</label>
                            <input class="form-control" type="password" name="pass">
                            <?= $passMessage ?>
                        </div>

                        <div class="form-group">
                            <label for="passConfirm">Confirmer le mot de passe</label>
                            <input class="form-control" type="password" name="passConfirm">
                            <?= $passConfirmMessage ?>
                        </div>
                        <button class="btn btn-primary" type="submit" name="connection">S'enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

