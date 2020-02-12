<?php
$id = $user->getId();
$pseudo = htmlspecialchars($user->getPseudo());
$email = htmlspecialchars($user->getEmail());
$tdEmail = '
            <td>' . $email . '</td>
            <td><a href="index.php?route=back.account&modification=email#emailAccount" class="btn btn-sm btn-primary btn-perso1">Modifier</a></td>';
$pass = '**********';
$tdPass = '
            <td>' . $pass . '</td>
            <td><a href="index.php?route=back.account&modification=password#emailAccount" class="btn btn-sm btn-primary btn-perso1" >Modifier</a></td>';
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
    <form method="post" action="index.php?route=back.updateEmail&id=<?= $id ?>&modification=email&token=<?= $_SESSION['token'] ?>">
        <div class="form-group">
            <td>
                <input type="hidden" name="pseudo" value="<?= $pseudo ?>">
                <input type="hidden" name="statut" value="<?= $statut ?>">
                <div class="form-group">
                    <input type="text" class="form-control" name="email" value="<?= $email ?>">
                    <p class="message-form pb-2"><?= $emailMessage ?></p>
                </div>
                <div class="form-group">
                    <label for="email">Mot de passe</label>
                    <input type="password" class="form-control" name="pass">
                    <p class="message-form pb-2"><?= $passMessage ?></p>

                </div>
            </td>
            <td class="d-flex flex-column">
                <a href="index.php?route=back.account#title" class="my-1 text-center btn-sm btn-danger">Annuler</a>
                <button type="submit" class=" mt-5 btn-sm btn-success">Confirmer</button>
            </td>
        </div>
    </form>
    <?php $tdEmail = ob_get_clean();
}
elseif(isset($_GET['modification']) AND $_GET['modification'] == 'password') // password modification
{
    ob_start();
    ?>
    <form method="post" action="index.php?route=back.updatePass&id=<?= $id ?>&modification=password&token=<?= $_SESSION['token'] ?>">
        <div class="form-group">
            <td>
                <input type="hidden" name="pseudo" value="<?= $pseudo ?>">
                <input type="hidden" name="statut" value="<?= $statut ?>">
                <input type="hidden" name="email" value="<?= $email ?>">
                <div class="form-group">
                    <label for="pass">Nouveau mot de passe</label>
                    <input type="password" class="form-control" name="pass">
                    <p class="message-form pb-2"><?= $passMessage ?></p>
                </div>
                <div class="form-group">
                    <label for="passConfirm">Confirmation du nouveau mot de passe</label>
                    <input type="password" class="form-control" name="passConfirm">
                    <p><?= $passConfirmMessage ?></p>
                </div>
                <div class="form-group">
                    <label for="oldPass">Ancien mot de passe</label>
                    <input type="password" class="form-control" name="oldPass">
                    <p class="message-form pb-2"><?= $oldPassMessage ?></p>

                </div>
            </td>
            <td class="d-flex flex-column">
                <a href="index.php?route=back.account#title" class="my-5 mb5 text-center btn-sm btn-danger">Annuler</a>
                <button type="submit" class="my-5 btn-sm btn-success">Confirmer</button>
            </td>
        </div>
    </form>
    <?php $tdPass = ob_get_clean();
}
?>

<div class="row pt-4">
    <div class="col-lg-12 pl-5 py-4">
        <h1 id="title">Mes informations</h1>
    </div>


    <?php if(isset($_GET['modification']) AND $_GET['modification'] == 'success') : ?>
        <div class="col-lg-12 px-5">
            <div class="alert alert-success text-center">
                La modification a été réalisée avec succès
            </div>
        </div>
    <?php endif ?>

    <div class="px-5 pb-3 col-lg-12 table-responsive">
        <table class="table  table-striped ">
            <tr>
                <th scope="col">Pseudo</th>
                <td><?= $pseudo ?></td>
                <td></td>
            </tr>
            <tr>
                <th scope="col" id="emailAccount">Courriel</th>
                <?= $tdEmail ?>
            </tr>
            <tr>
                <th scope="col">Mot de passe</th>
                <?= $tdPass ?>
            </tr>
            <tr>
                <th scope="col">Statut</th>
                <td><?= $statut ?></td>
                <td></td>
            </tr>
            <tr>
                <th scope="col">Date d'inscription</th>
                <td><?= $date_inscription ?></td>
                <td></td>
            </tr>
        </table>
    </div>
</div>

<?php if($_SESSION['statut'] != 'admin'): ?>
<div id="deleteAccount" class="my-3 mx-5">
    <a href="index.php?route=back.account&deleteAccount=first#deleteAccount" class="btn btn-perso1" >Supprimer définitivement le compte</a>
    <?php if(isset($_GET['deleteAccount']) AND $_GET['deleteAccount'] == 'first'): ?>
        <a href="index.php?route=back.account&deleteAccount=second#deleteAccount" class="btn btn-danger" >Etes-vous sûr de vous ? Cette action est irreversible.</a>
        <a href="index.php?route=back.account" class="btn btn-perso1" >Annuler</a>
    <?php endif ?>
    <?php if(isset($_GET['deleteAccount']) AND $_GET['deleteAccount'] == 'second'): ?>
        <a href="index.php?route=back.account&deleteAccount=last#deleteAccount" class="btn btn-danger" >Vraiment sûr ???</a>
        <a href="index.php?route=back.account" class="btn btn-perso1" >Annuler</a>
    <?php endif ?>
    <?php if(isset($_GET['deleteAccount']) AND $_GET['deleteAccount'] == 'last'): ?>
        <a href="index.php?route=admin.deleteAccount&id=<?= $_SESSION['id'] ?>&token=<?= $_SESSION['token'] ?>" class="btn btn-danger" >Sûr et certain ???????</a>
        <a href="index.php?route=back.account" class="btn btn-perso1" >Annuler</a>
    <?php endif ?>

</div>
<?php endif ?>
