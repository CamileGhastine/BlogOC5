<div class="row pt-4">
    <div class="col-sm-8">
        <h1>Utilisateurs à valider</h1>
    </div>
    <div class="col-sm-4">
        <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>
</div>

<div class="pb-3">
    <table class="table table-striped ">
        <thead>
        <tr>
            <th scope="col">Pseudo</th>
            <th scope="col">Courriel</th>
            <th scope="col">Date inscription</th>
            <th scope="col">Action</th>
            <th scope="col"><a href="index.php?route=admin.users" class="btn btn-primary">Annuler</a></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($users as $user):
            $id = $user->getId();
            $pseudo = $user->getPseudo();
            $email = $user->getEmail();
            $date_inscription = $user->getDate_inscription();
            ?>
            <tr>
                <td><?= $pseudo; ?></td>
                <td><?= $email; ?></td>
                <td><?= $date_inscription; ?></td>
                <td>
                    <form method="post" action="index.php?route=admin.validateUsers&id=<?= $id ?>">
                        <div class="form-group">
                            <input type="hidden" name="validated" value="1">
                            <button type="submit" class="btn btn-success">Valider</button>
                        </div>
                    </form>
                </td>
                <td>
                    <?php
                    if(!isset($_GET['delete']))
                    {
                        echo '<a href="?route=admin.validateUsers&delete=' . $id . '" class="btn btn-danger">Supprimer</a>';
                    }
                    else
                    {
                        ?>
                        <a href="" class="<?= $_GET['delete'] == $id ? 'btn btn-secondary' : 'btn btn-danger' ?>">Supprimer</a>

                        <?php
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if(isset($_GET['delete']) && $_GET['delete'] == $id)
                    {
                        ?>
                        <form action="?route=admin.delete" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button id="delete" type="submit" class="btn btn-danger">Confirmer</button>
                        </form>
                        <a href="?route=admin.validateUsers" class="btn btn-success">Annuler</a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>
</div>

