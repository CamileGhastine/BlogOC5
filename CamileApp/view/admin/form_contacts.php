<div class="admin">
    <div class="row">
        <div class="py-4 px-5 col-sm-8 text-center text-md-left">
            <h1 id="title">Consultation des formulaires de contacts</h1>
        </div>
        <div class="col-sm-4 text-center text-md-right px-5 pt-2 pb-4 py-md-4">
            <a href="index.php?route=admin.home" class="btn btn-secondary">Retour au tableau de bord</a>
        </div>
    </div>

    <div class="row pb-3">
        <table class="col table table-striped table-responsive">
            <thead>
            <tr>
                <th >Nom</th>
                <th >Prénom</th>
                <th >Courriel</th>
                <th >Date d'envoi</th>
                <th >Objet</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($form_contacts as $form_contact):
                $first_name = $form_contact->getFirst_name();
                $last_name = htmlspecialchars($form_contact->getLast_name());
                $email = htmlspecialchars($form_contact->getEmail());
                $date = htmlspecialchars($form_contact->getDate_submission());
                $subject = $form_contact->getSubject();
                $content = $form_contact->getContent();
                ?>

                <tr>
                    <td><?= $first_name ?></td>
                    <td><?= $last_name ?></td>
                    <td><?= $email ?></td>
                    <td><?= $date ?></td>
                    <td><?= $subject ?></td>
                </tr>
            <tr>
                <th>Message</th>
                <td colspan=4><?= $content ?></td>
            </tr>
            <?php endforeach ?>

            </tbody>
        </table>
    </div>
</div>