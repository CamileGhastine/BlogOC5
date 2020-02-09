<?php
$id = $user->getId();
$pseudo = htmlspecialchars($user->getPseudo());
$email = htmlspecialchars($user->getEmail());
$tdEmail = '
            <td>' . $email . '</td>
            <td><a href="index.php?route=back.account&modification=email"><button class="btn-sm btn-primary" >Modifier</button></a></td>';
$pass = '**********';
$tdPass = '
            <td>' . $pass . '</td>
            <td><a href="index.php?route=back.account&modification=password"><button class="btn-sm btn-primary" >Modifier</button></a></td>';
$statut = $user->getStatut() == 'user' ? 'Utilisateur' : htmlspecialchars(ucfirst($user->getStatut()));
$date_inscription = htmlspecialchars($user->getDate_inscription());
$emailMessage = isset($formMessage['email']) ? $formMessage['email'] : null;
$passMessage = isset($formMessage['pass']) ? $formMessage['pass'] : null;
$passConfirmMessage = isset($formMessage['passConfirm']) ? $formMessage['passConfirm'] : null;
$oldPassMessage = isset($formMessage['oldPass']) ? $formMessage['oldPass'] : null;

if(isset($_GET['modification']) AND $_GET['modification'] == 'email') // Email Modification
{
    ob_start();
    ?>
    <form method="post" action="index.php?route=back.updateEmail&id=<?= $id ?>&modification=email">
        <div class="form-group">
            <td>
                <input type="hidden" name="pseudo" value="<?= $pseudo ?>">
                <input type="hidden" name="statut" value="<?= $statut ?>">
                <div class="form-group">
                    <input type="text" class="form-control" name="email" value="<?= $email ?>">
                    <p><?= $emailMessage ?></p>
                </div>
                <div class="form-group">
                    <label for="email">Mot de passe</label>
                    <input type="password" class="form-control" name="pass">
                    <p><?= $passMessage ?></p>

                </div>
            </td>
            <td>
                <button type="submit" class="btn-sm btn-success">Confirmer</button>
                <a href="index.php?route=back.account" class="btn-sm btn-danger">Annuler</a>
            </td>
       </div>
    </form>
    <?php $tdEmail = ob_get_clean();
}
elseif(isset($_GET['modification']) AND $_GET['modification'] == 'password') // password modification
{
    ob_start();
    ?>
    <form method="post" action="index.php?route=back.updatePass&id=<?= $id ?>&modification=password">
        <div class="form-group">
            <td>
                <input type="hidden" name="pseudo" value="<?= $pseudo ?>">
                <input type="hidden" name="statut" value="<?= $statut ?>">
                <input type="hidden" name="email" value="<?= $email ?>">
                <div class="form-group">
                        <label for="pass">Nouveau mot de passe</label>
                    <input type="password" class="form-control" name="pass">
                    <p><?= $passMessage ?></p>
                </div>
                <div class="form-group">
                    <label for="passConfirm">Confirmation du nouveau mot de passe</label>
                    <input type="password" class="form-control" name="passConfirm">
                    <p><?= $passConfirmMessage ?></p>
                </div>
                <div class="form-group">
                    <label for="oldPass">Ancien mot de passe</label>
                    <input type="password" class="form-control" name="oldPass">
                    <p><?= $oldPassMessage ?></p>

                </div>
            </td>
            <td>
                <button type="submit" class="btn-sm btn-success">Confirmer</button>
                <a href="index.php?route=back.account" class="btn-sm btn-danger">Annuler</a>
            </td>
        </div>
    </form>
    <?php $tdPass = ob_get_clean();
}
?>

<div class="row pt-4">
    <div class="col-lg-12">
        <h1>Mes informations</h1>
    </div>
</div>

<?php if(isset($_GET['modification']) AND $_GET['modification'] == 'success') : ?>
<div class="alert alert-success">
    <div class=row>
        <div class="col-sm-6">
            La modification a été réalisée avec succès
        </div>
    </div>
</div>
<?php endif ?>

<div class="pb-3">
    <table class="table table-striped ">
        <tr>
            <th>Pseudo</th>
            <td><?= $pseudo ?></td>
            <td></td>
        </tr>
        <tr>
            <th>Courriel</th>
            <?= $tdEmail ?>
        </tr>
        <tr>
            <th>Mot de passe</th>
            <?= $tdPass ?>
        </tr>
        <tr>
            <th>Satut</th>
            <td><?= $statut ?></td>
            <td></td>
        </tr>
        <tr>
            <th>Date d'inscription</th>
            <td><?= $date_inscription ?></td>
            <td></td>
        </tr>
    </table>