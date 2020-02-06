<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card my-4">
                <h4 id="comments" class="card-header">Commentaires (<?= $numberComments ?>)</h4>
                <div class="card-body">
                    <?php
                    foreach($comments as $comment)
                    {
                        $pseudo = htmlspecialchars($comment->getPseudo());
                        $dateComment = 'le ' . htmlspecialchars($comment->getDate_creation());
                        $content = $comment->getValidated() == null ? '<B><I>Ce commentaire est en cours de validation.</I></B>' : htmlspecialchars($comment->getContent())
                        ?>
                        <p><?= '<U><B>' . $pseudo . '</B> (<small>' . $dateComment . '</small>) :</U> ' . $content ?></p>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>