<?php
if(!isset($update)) // add user
{
    $pseudo = isset($post['pseudo']) ? $post['pseudo'] : null;
    $pass = isset($post['pass']) ? $post['pass'] : null;
    $email = isset($post['email']) ? $post['email'] : null;
    $statutUser = isset($post['statut']) ? $post['statut'] : 'user';
    $action = 'index?route=admin.addUser';
    $titlePage = 'Ajouter un utilisateur';
    $btn = 'Ajouter';
}
else // update user
{
    if(isset($user)) // update users (form not submit)
    {
        $pseudo = $user->getPseudo();
        $pass = 'password1';
        $email = $user->getEmail();
        $statutUser = $user->getStatut();
        $action = 'index?route=admin.updateUser&id='.$user->getId();
    }
    if(isset($postUpdate)) // update user (form already submit)
    {
        $pseudo = $postUpdate['pseudo'];
        $pass = 'password1';
        $email = $postUpdate['email'];
        $statutUser = $postUpdate['statut'];
        $action = 'index?route=admin.updateUser&id='.$postUpdate['id'];
    }
    $titlePage = 'Modifier l\'utilisateur';
    $btn = 'Modifier';
}

$pseudoMessage = isset($formMessage['pseudo']) ? $formMessage['pseudo'] : null;
$passMessage = isset($formMessage['pass']) ? $formMessage['pass'] : null;
$emailMessage = isset($formMessage['email']) ? $formMessage['email'] : null;
$statutMessage = isset($formMessage['statut']) ? $formMessage['statut'] : null;

?>

<div class="row">
    <div class="col-lg-12 mt-3">

        <div class="row pt-4">
            <div class="col-sm-8">
                <h1><?= $titlePage ?></h1>
            </div>
            <div class="col-sm-4">
                <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
            </div>
        </div> <?php if(isset($result)): ?>
            <div class="alert alert-success">
                <div class=row>
                    <div class="col-sm-6">
                        L'utilisateur a bien été ajouté.
                    </div>
                    <div class="col-sm-6">
                        <a href="index.php?p=backend.users.usersAdmin" class="btn btn-success">Retour au tableau de
                            bord</a>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <form method="post" action="<?= $action ?>" class="pb-3">

                <div class="form-group">
                    <label for="title">Pseudo</label>
                    <input type="text" class="form-control" name="pseudo" value="<?= $pseudo ?>">
                    <p><?= $pseudoMessage ?></p>
                </div>

                <div class="form-group">
                    <label for="chapo">Mot de passe</label>
                    <input type="password" class="form-control" name="pass" value="<?= $pass ?>" <?= isset($update) ? 'readOnly="readOnly"' : null ?>>
                    <p><?= $passMessage ?></p>
                </div>

                <div class="form-group">
                    <label for="chapo">Courriel</label>
                    <input type="text" class="form-control" name="email" value="<?= $email ?>">
                    <p><?= $emailMessage ?></p>
                </div>
                <div class="form-group ">
                    <label for="statut">Statut</label>
                    <SELECT class="form-control" name="statut" size="1" >
                        <?php foreach($statuts as $statut) :
                            $statut = htmlspecialchars($statut->getStatut());
                            ?>
                            <OPTION <?= $statut != $statutUser ? null : 'selected' ?>>
                                <?= $statut ?>
                            </OPTION>
                        <?php endforeach; ?>
                    </SELECT>
                    <p><?= $statutMessage ?></p>
                </div>

                <input type="hidden" name="token" id="token" value="<?= $_SESSION['token']; ?>" />

                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-danger"><?= $btn ?></button>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-end">
                        <?php if(!isset($result)) : ?>
                            <a class="btn btn-success " href="index.php?route=admin.users">Annuler</a>
                        <?php endif ?>
                    </div>
                </div>

            </form>
        <?php endif ?>
    </div>
</div>