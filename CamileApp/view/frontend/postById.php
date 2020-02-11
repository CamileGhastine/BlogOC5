<?php
require 'required/post.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card my-4">
                <h5 id="comments" class="card-header"><B>Connectez-vous pour commenter l'article</B></h5>
                <div class="card-body text-center">
                    <a href="index.php?route=front.connectionRegister" id="register-connection">Enregistrement/connexion</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require 'required/comments.php';
?>
