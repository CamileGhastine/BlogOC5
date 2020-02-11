<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card my-4">
                <h4 id="comments" class="card-header">Commentaires (<?= $numberComments ?>)</h4>
                <div class="card-body comments-post">
                    <?php if($numberComments == 0) : ?>
                        <p>Aucun Commentaire</p>
                    <?php else :
                    foreach($comments as $comment)
                    {
                        $pseudo = htmlspecialchars($comment->getPseudo());
                        $dateComment = 'le ' . htmlspecialchars($comment->getDate_creation());
                        $content = $comment->getValidated() == null ? '<I>Ce commentaire est en cours de validation.</I>' : htmlspecialchars($comment->getContent())
                        ?>
                        <p><?= '<spann id="commentDate">' . $dateComment . '</spann> - <B>' . $pseudo . '</B>  : ' . $content ?></p>

                    <?php }
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>