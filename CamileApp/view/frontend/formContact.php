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
        <div class="row justify-content-center py-4">
            <div class="col-lg-8">
                <div class="card my-4">
                    <h4 id="comments" class="card-header text-center">Contactez-moi</h4>
                    <div class="card-body">
                        <form method="post" action="index.php?route=front.contact" class="mx-4 my-3">
                            <input type="hidden" name="user_id" value="<?= $userId ?>">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm text-center" for="first_name">Prénom</label>
                                <div class="col-sm-8">
                                    <input class="form-control form-control-sm" type="text" name="first_name" value="<?= $firstName ?>" required>
                                    <div class="message-form pb-2"><?= $firstNameMessage ?></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm text-center" for="last_name">Nom</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="last_name" value="<?= $lastName ?>" required>
                                    <div class="message-form pb-2"><?= $lastNameMessage ?></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm text-center" for="email">Courriel</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="email" value="<?= $email ?>" required>
                                    <div class="message-form pb-2"><?= $emailMessage ?></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm text-center" for="subject">Objet</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="subject" value="<?= $subject ?>" required>
                                    <div class="message-form pb-2"><?= $subjectMessage ?></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm text-center" for="content">Message</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" type="text" name="content" required><?= $content ?></textarea>
                                    <div class="message-form pb-2"><?= $contentMessage ?></div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="btn-perso1">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
<?php endif ?>


