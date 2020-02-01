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
    <a href="index.php?p=backend.users.add" class="btn btn-success mt-3">Ajouter un utilisateur</a>
    <a href="index.php?p=backend.users.validate"
       class="btn btn-success mt-3 ml-5 <?= ($numberUsersUnvalidated == 0) ? 'disabled' : null ?>">
        <?= $numberUsersUnvalidated . (($numberUsersUnvalidated <= 1) ? ' utilisateur à valider' : ' utilisateurs à valider') ?>
    </a>
</p>

<div class="pb-3">
    <table class="table table-striped ">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Pseudo</th>
            <th scope="col">Courriel</th>
            <th scope="col">Date Inscription</th>
            <th scope="col">Statut</th>
            <th scope="col">Action</th>
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
                <td><?= $userId ?></td>
                <td><?= $pseudo ?></td>
                <td><?= $email ?></td>
                <td><?= $date ?></td>
                <td><?= $statut ?></td>
                <td><a href="index.php?p=backend.users.edit&id=<?= $userId ?>" class="btn btn-primary">Modifier les
                        informations</a>

                    <?php
                    if(!isset($_GET['delete']))
                    {
                        echo '<a href="?p=backend.users.usersAdmin&delete=' . $userId . '" class="btn btn-danger">Supprimer</a>';
                    }
                    else
                    {
                        ?>
                        <a href="" class="<?= $_GET['delete'] == $userId ? 'btn btn-secondary' : 'btn btn-danger' ?>">Supprimer</a>

                        <?php
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if(isset($_GET['delete']) && $_GET['delete'] == $userId)
                    {
                        ?>
                        <form action="?p=backend.users.delete" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $userId ?>">
                            <button type="submit" class="btn btn-danger">Confirmer</button>
                        </form>
                        <a href="?p=backend.users.usersAdmin" class="btn btn-success">Annuler</a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>
</div>

