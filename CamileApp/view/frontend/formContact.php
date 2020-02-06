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

$userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;

if(!empty($result)) : ?>
    <div class="py-4">
        <div class="alert alert-<?= ($result === 'ok') ? 'success' : 'danger' ?>">
            <div class="row">
                <div class="col-lg-6">
                    <?= ($result === 'ok') ? 'Le formulaire de contact a bien été envoyé.' : 'Une erreur est survenue et le formualire n\'a pas pu être envoyé.' ?>
                </div>
                <div class="col-lg-6">
                    <a href="index.php" class="btn btn-success">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card my-4">
                    <h4 id="comments" class="card-header text-center">Contactez-moi</h4>
                    <div class="card-body">
                        <form method="post" action="index.php?route=front.contact">
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="<?= $userId ?>"
                                <div class="form-group">
                                    <label for="first_name">Prénom</label>
                                    <input class="form-control" type="text" name="first_name" value="<?= $firstName ?>">
                                    <p><?= $firstNameMessage ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Nom</label>
                                    <input class="form-control" type="text" name="last_name" value="<?= $lastName ?>">
                                    <p><?= $lastNameMessage ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="email">Courriel</label>
                                    <input class="form-control" type="text" name="email" value="<?= $email ?>">
                                    <p><?= $emailMessage ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Objet</label>
                                    <input class="form-control" type="text" name="subject" value="<?= $subject ?>">
                                    <p><?= $subjectMessage ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="content">Message</label>
                                    <textarea class="form-control" type="text" name="content"><?= $content ?></textarea>
                                    <p><?= $contentMessage ?></p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>


