<?php
$numberUsersUnvalidated = $numberUsersUnvalidated->number;
$numberUsersBlocked = $numberUsersBlocked->number;
?>

<div class="admin">
    <div class="row">
        <div class="py-4 px-5 col-sm-8 text-center text-md-left">
            <h1 id="title">Administration des utilisateurs</h1>
        </div>
        <div class="col-sm-4 text-center text-md-right px-5 pt-2 pb-4 py-md-4">
            <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
        </div>
    </div>

    <div class="row">
        <?php if($display == 'all') : ?>
            <div class="col-md-4 text-center">
                <a href="index.php?route=admin.addUser" class="btn btn-success">Ajouter un utilisateur</a>
            </div>
        <?php else : ?>
            <div class="col-md-4 text-center">
                <a href="index.php?route=admin.users" class="btn btn-success">Tous les utilisateurs</a>
            </div>
        <?php endif ?>
        <div class="col-md-4 my-3 my-md-0 text-center">
            <a href="index.php?route=admin.validateUsers&action=valide" class="btn btn-primary <?= ($numberUsersUnvalidated == 0) ? 'disabled' : null ?>">
                <?= $numberUsersUnvalidated . (($numberUsersUnvalidated <= 1) ? ' utilisateur à valider' : ' utilisateurs à valider') ?>
            </a>
        </div>
        <div class="col-md-4 text-center">
            <a href="index.php?route=admin.unlockUsers&action=active" class="btn btn-primary <?= ($numberUsersBlocked == 0) ? 'disabled' : null ?>">
                <?= $numberUsersBlocked . (($numberUsersBlocked <= 1) ? ' compte bloqué' : ' comptes bloqués') ?>
            </a>
        </div>
    </div>
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
            case('unlock') :
                $message = 'Ce compte a été débloqué avec succès.';
                break;
        }
        ?>
    <div class="alert alert-success text-center">
        <div>
            <?= isset($message) ? $message : null ?>
        </div>
    </div>
    <?php endif ?>
    </p>
    <div class="row pb-3">
        <table class="col table table-striped table-responsive">
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
                $userStatut = $user->getStatut();
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
                            <a href="index.php?route=admin.validateUsers&id=<?= $userId ?>&action=valide&token=<?= $_SESSION['token'] ?>" class="btn-sm btn-success">Valider</a>
                        </td>
                    <?php elseif($try >= 5 ) : ?>
                        <td>
                            <a href="index.php?route=admin.unlockUsers&id=<?= $userId ?>&action=active&token=<?= $_SESSION['token'] ?>" class="btn-sm btn-danger">Debloquer</a>
                        </td>
                    <?php else : ?>
                        <td></td>
                    <?php endif ?>
                    <td><?= $pseudo ?></td>
                    <td><?= $email ?></td>
                    <td><?= $date ?></td>                <td><?= $statut ?></td>
                    <td class="text-center">
                        <a href="index.php?route=admin.updateUser&id=<?= $userId ?>" class="btn-sm btn-primary">Modifier</a>

                        <?php
                        if(!isset($_GET['delete']) )
                        {
                            if($userStatut != 'admin') echo '<a href="?route=admin.users&delete=' . $userId . '#delete" class="btn-sm btn-danger">Supprimer</a>';
                        }
                        else
                        {
                            if($userStatut != 'admin')
                            { ?>
                                <a id="delete" href="" class="<?= $_GET['delete'] == $userId ? 'btn-sm btn-secondary' : 'btn-sm btn-danger' ?>">Supprimer</a>

                                <?php
                            }


                        }
                        ?>
                    </td>
                    <td class="text-center">
                        <?php
                        if(isset($_GET['delete']) && $_GET['delete'] == $userId)
                        {
                            ?>
                            <a id="deleteConfirmation" href="index.php?route=admin.deleteuser&id=<?= $userId ?>&token=<?= $_SESSION['token'] ?>" class="btn-sm btn-danger mb-3">Confirmer</a>
                            <a href="?route=admin.users#title" class="btn-sm btn-success">Annuler</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach ?>

            </tbody>
        </table>
    </div>
</div>

