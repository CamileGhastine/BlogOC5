<?php
$formMessage = isset($formMessage) ? $formMessage['email'] : null;
$email = isset($post) ? $post['email'] : null;
?>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card my-4">
                <p id="comments" class="card-header">Entrez votre adresse courriel pour réinitialiser votre mot de passe.</p>
                <div class="card-body">
                    <form method="post" action="index.php?route=front.forgottenPassword">

                        <div class="form-group">
                            <input class="form-control" name="email" value="<?= $email ?>">
                        </div>
                        <p><?= $formMessage ?></p>

                        <button type="submit" class="btn btn-primary" value="réagir">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>