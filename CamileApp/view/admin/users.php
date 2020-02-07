<?php
$numberUsersUnvalidated = $numberUsersUnvalidated->number;
$numberUsersBlocked = $numberUsersBlocked->number;
?>

<div class="row pt-4">
    <div class="col-sm-8">
        <h1>Administration des utilisateurs</h1>
    </div>
    <div class="col-sm-4">
        <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>
</div>

<p>
    <?php if($display == 'all') : ?>
        <a href="index.php?route=admin.addUser" class="btn btn-success mt-3">Ajouter un utilisateur</a>
    <?php else : ?>
        <a href="index.php?route=admin.users" class="btn btn-success mt-3">Tous les utilisateurs</a>
    <?php endif ?>
    <a href="index.php?route=admin.validateOrUnlockUsers&action=valide" class="btn btn-primary mt-3 ml-5 <?= ($numberUsersUnvalidated == 0) ? 'disabled' : null ?>">
        <?= $numberUsersUnvalidated . (($numberUsersUnvalidated <= 1) ? ' utilisateur à valider' : ' utilisateurs à valider') ?>
    </a>
    <a href="index.php?route=admin.validateOrUnlockUsers&action=active" class="btn btn-primary mt-3 ml-5 <?= ($numberUsersBlocked == 0) ? 'disabled' : null ?>">
        <?= $numberUsersBlocked . (($numberUsersBlocked <= 1) ? ' compte bloqué' : ' comptes bloqués') ?>
    </a>
</p>
<p>
    <?php if(isset($_GET['success'])):
    switch($_GET['success'])
    {
        case('add') :
            $message = 'Le nouvel utilisateur a  été créée avec succès.';
            break;
        case('delete') :
            $message = 'L\'utilisateur a  été supprimée avec succès.';
            break;
        case('update') :
            $message = 'L\'utilisateur a  été modifiée avec succès.';
            break;
        case('validate') :
            $message = 'L\'utilisateur a été validé avec succès.';
            break;
        case('activate') :
            $message = 'Ce compte a été débloqué avec succès.';
            break;
    }
    ?>
    <div class="alert alert-success">
            <div>
                <?= isset($message) ? $message : null ?>
            </div>
    </div>
<?php endif ?>
</p>
<div class="pb-3">
    <table class="table table-striped ">
        <thead>
        <tr>
            <th></th>
            <th scope="col">Pseudo</th>
            <th scope="col">Courriel</th>
            <th scope="col">Date Inscription</th>
            <th scope="col">Statut</th>
            <th scope="col">Action</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($users as $user):
            $userId = $user->getId();
            $pseudo = htmlspecialchars($user->getPseudo());
            $email = htmlspecialchars($user->getEmail());
            $date = htmlspecialchars($user->getDate_inscription());
            $statut = $user->getStatut();
            $validated = $user->getValidated();
            $try = $user->getTry();

            ?>
            <tr>
                <?php if(!$validated) : ?>
                    <td>
                        <a href="index.php?route=admin.validateOrUnlockUsers&id=<?= $userId ?>&action=valide&token=<?= $_SESSION['token'] ?>" class="btn-sm btn-success">Valider</a>
                    </td>
                <?php elseif($try >= 5 ) : ?>
                    <td>
                        <a href="index.php?route=admin.validateOrUnlockUsers&id=<?= $userId ?>&action=active&token=<?= $_SESSION['token'] ?>" class="btn-sm btn-danger">Debloquer</a>
                    </td>
                <?php else : ?>
                <td></td>
                <?php endif ?>
                <td><?= $pseudo ?></td>
                <td><?= $email ?></td>
                <td><?= $date ?></td>                <td><?= $statut ?></td>
                <td>
                    <a href="index.php?route=admin.updateUser&id=<?= $userId ?>" class="btn-sm btn-primary">Modifier</a>

                    <?php
                    if(!isset($_GET['delete']))
                    {
                        echo '<a href="?route=admin.users&delete=' . $userId . '#delete" class="btn-sm btn-danger">Supprimer</a>';
                    }
                    else
                    {
                        ?>
                        <a id="delete" href="" class="<?= $_GET['delete'] == $userId ? 'btn-sm btn-secondary' : 'btn-sm btn-danger' ?>">Supprimer</a>

                        <?php
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if(isset($_GET['delete']) && $_GET['delete'] == $userId)
                    {
                        ?>
                        <a id="deleteConfirmation" href="index.php?route=admin.deleteuser&id=<?= $userId ?>&token=<?= $_SESSION['token'] ?>" class="btn-sm btn-danger mt-3">Confirmer</a>
                        <a href="?route=admin.users" class="btn-sm btn-success">Annuler</a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>
</div>

