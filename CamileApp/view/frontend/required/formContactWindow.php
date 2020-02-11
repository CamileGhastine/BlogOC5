<?php

$firstName = isset($post['first_name']) ? htmlspecialchars($post['first_name']) : null ;
$lastName = isset($post['last_name']) ? htmlspecialchars($post['last_name']) : null ;
$email = isset($post['email']) ? htmlspecialchars($post['email']) : null ;
$subject = isset($post['subject']) ? htmlspecialchars($post['subject']) : null ;
$content = isset($post['content']) ? htmlspecialchars($post['content']) : null ;

$firstNameMessage = isset($formMessage['first_name']) ? $formMessage['first_name'] : null ;
$lastNameMessage = isset($formMessage['last_name']) ? $formMessage['last_name'] : null ;
$emailMessage = isset($formMessage['email']) ? $formMessage['email'] : null ;
$subjectMessage = isset($formMessage['subject']) ? $formMessage['subject'] : null ;
$contentMessage = isset($formMessage['content']) ? $formMessage['content'] : null ;

$userId = isset($_SESSION['id']) ? $_SESSION['id'] : 2;
?>
<div class="card my-4">
    <h4 id="comments" class="card-header text-center">Contactez-moi</h4>
    <div class="card-body">
        <form method="post" action="index.php?route=front.contact" class="mx-4 my-3">
            <div class="form-group">
                <input type="hidden" name="user_id" value="<?= $userId ?>">
                <div class="form-group text-center">
                    <label for="first_name">Prénom</label>
                    <input class="form-control" type="text" name="first_name" value="<?= $firstName ?>">
                    <div class="message-form pb-2"><?= $firstNameMessage ?></div>
                </div>
                <div class="form-group text-center">
                    <label for="last_name">Nom</label>
                    <input class="form-control" type="text" name="last_name" value="<?= $lastName ?>">
                    <div class="message-form pb-2"><?= $lastNameMessage ?></div>
                </div>
                <div class="form-group text-center">
                    <label for="email">Courriel</label>
                    <input class="form-control" type="text" name="email" value="<?= $email ?>">
                    <div class="message-form pb-2"><?= $emailMessage ?></div>
                </div>
                <div class="form-group text-center">
                    <label for="subject">Objet</label>
                    <input class="form-control" type="text" name="subject" value="<?= $subject ?>">
                    <div class="message-form pb-2"><?= $subjectMessage ?></div>
                </div>
                <div class="form-group text-center">
                    <label for="content">Message</label>
                    <textarea class="form-control" type="text" name="content"><?= $content ?></textarea>
                    <div class="message-form pb-2"><?= $contentMessage ?></div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" id="btn-perso1">Envoyer</button>
            </div>
        </form>
    </div>
</div>
