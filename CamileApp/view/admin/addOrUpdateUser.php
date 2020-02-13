<?php
if(!isset($update)) // add user
{
    $pseudo = isset($post['pseudo']) ? $post['pseudo'] : null;
    $pass = isset($post['pass']) ? $post['pass'] : null;
    $email = isset($post['email']) ? $post['email'] : null;
    $statutUser = isset($post['statut']) ? $post['statut'] : 'user';
    $action = 'index.php?route=admin.addUser';
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
        $action = 'index.php?route=admin.updateUser&id='.$postUpdate['id'];
    }
    $titlePage = 'Modifier l\'utilisateur';
    $btn = 'Modifier';
}

$pseudoMessage = isset($formMessage['pseudo']) ? $formMessage['pseudo'] : null;
$passMessage = isset($formMessage['pass']) ? $formMessage['pass'] : null;
$emailMessage = isset($formMessage['email']) ? $formMessage['email'] : null;
$statutMessage = isset($formMessage['statut']) ? $formMessage['statut'] : null;

?>
<div class="admin">

    <div class="row px-5">
        <div class="col-lg-12">
            <form method="post" action="<?= $action ?>" class="pb-3">
                <div class="form-group text-center text-sm-left">
                    <label for="title">Pseudo</label>
                    <input type="text" class="form-control" name="pseudo" value="<?= $pseudo ?>" required>
                    <p class="message-form"><?= $pseudoMessage ?></p>
                </div>

                <div class="form-group text-center text-sm-left">
                    <label for="chapo">Mot de passe</label>
                    <input type="password" class="form-control" name="pass" value="<?= $pass ?>" <?= isset($update) ? 'readOnly="readOnly"' : null ?> required>
                    <p class="message-form"><?= $passMessage ?></p>
                </div>

                <div class="form-group text-center text-sm-left">
                    <label for="chapo">Courriel</label>
                    <input type="text" class="form-control" name="email" value="<?= $email ?>" required>
                    <p class="message-form"><?= $emailMessage ?></p>
                </div>
                <div class="form-group text-center text-sm-left ">
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
                    <p class="message-form"><?= $statutMessage ?></p>
                </div>

                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                <div class="row px-5">
                    <div class="col-sm-6 text-center text-sm-left mb-3">
                        <button type="submit" class="btn btn-success"><?= $btn ?></button>
                    </div>
                    <div class="col-sm-6 text-center text-sm-right">
                        <?php if(!isset($result)) : ?>
                            <a class="btn btn-danger " href="index.php?route=admin.users">Annuler</a>
                        <?php endif ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>