<div class="row pt-4">
    <div class="col-sm-8">
        <h1>Mes informations</h1>
    </div>
    <div class="col-sm-4">
        <a href="index.php?p=backend.users.index" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>
</div>

<div class="pb-3">
    <table class="table table-striped ">
        <tr>
            <th >Pseudo</th>
            <td><?= $user->getPseudo() ?></td>
            <td></td>
        </tr>
        <tr>
            <th>Courriel</th>
            <td><?= $user->getEmail() ?></td>
            <td><a href="#" class="btn btn-primary">Modifier</a></td>
        </tr>
        <tr>
            <th>Mot de passe</th>
            <td>*************</td>
            <td><a href="#" class="btn btn-primary">Modifier</a></td>
        </tr>
        <tr>
            <th>Satut</th>
            <td><?= $user->getStatut() ?></td>
            <td></td>
        </tr>
        <tr>
            <th>Date d'inscription</th>
            <td><?= $user->getDate_inscription() ?></td>
            <td></td>
        </tr>
    </table>