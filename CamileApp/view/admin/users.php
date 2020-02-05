<?php
$numberUsersUnvalidated = $numberUsersUnvalidated->number;
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
    <a href="index.php?route=admin.addUser" class="btn btn-success mt-3">Ajouter un utilisateur</a>
    <a href="index.php?route=admin.validateUsers"
       class="btn btn-success mt-3 ml-5 <?= ($numberUsersUnvalidated == 0) ? 'disabled' : null ?>">
        <?= $numberUsersUnvalidated . (($numberUsersUnvalidated <= 1) ? ' utilisateur à valider' : ' utilisateurs à valider') ?>
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
    }
    ?>
    <div class="alert alert-success">
            <div>
                <?= $message ?>
            </div>
    </div>
<?php endif ?>
</p>
<div class="pb-3">
    <table class="table table-striped ">
        <thead>
        <tr>
            <th scope="col">Pseudo</th>
            <th scope="col">Courriel</th>
            <th scope="col">Date Inscription</th>
            <th scope="col">Statut</th>
            <th scope="col">Action</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($users as $user):
            $userId = $user->getId();
            $pseudo = htmlspecialchars($user->getPseudo());
            $email = htmlspecialchars($user->getEmail());
            $date = htmlspecialchars($user->getDate_inscription());
            $statut = htmlspecialchars($user->getStatut());

            ?>
            <tr>
                <td><?= $pseudo ?></td>
                <td><?= $email ?></td>
                <td><?= $date ?></td>
                <td><?= $statut ?></td>
                <td><a href="index.php?route=admin.updateUser&id=<?= $userId ?>" class="btn-sm btn-primary">Modifier les
                        informations</a>

                    <?php
                    if(!isset($_GET['delete']))
                    {
                        echo '<a href="?route=admin.users&delete=' . $userId . '#delete" class="btn-sm btn-danger">Supprimer</a>';
                    }
                    else
                    {
                        ?>
                        <a href="" class="<?= $_GET['delete'] == $userId ? 'btn-sm btn-secondary' : 'btn-sm btn-danger' ?>">Supprimer</a>

                        <?php
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if(isset($_GET['delete']) && $_GET['delete'] == $userId)
                    {
                        ?>
                        <form action="?route=admin.delete" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $userId ?>">
                            <button id="delete" type="submit" class="btn-sm btn-danger">Confirmer</button>
                        </form>
                        <a href="?route=admin.users" class="btn-sm btn-success">Annuler</a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>
</div>

