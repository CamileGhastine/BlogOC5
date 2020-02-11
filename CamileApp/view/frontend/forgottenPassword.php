<?php
$formMessage = isset($formMessage) ? $formMessage['email'] : null;
$email = isset($post) ? $post['email'] : null;
?>



<div class="container">
    <div class="row justify-content-center pt-5">
        <div class="card">
            <h2 id="comments" class="card-header">Mot de passe Oublié</h2>
            <div class="card-body">
                <form method="post" action="index.php?route=front.forgottenPassword" class="mx-4 mb-3">
                    <div class="form-group">
                        <p class="text-center">Entrez votre adresse courriel pour réinitialiser votre mot de passe.</p>
                        <input class="form-control" name="email" required value="<?= $email ?>">
                        <div class="message-form text-center" ><?= $formMessage ?></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" value="réagir" id="btn-perso1">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>