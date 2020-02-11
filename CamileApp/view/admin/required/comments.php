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
                        $commentId = $comment->getId();
                        $dateComment = 'le ' . htmlspecialchars($comment->getDate_creation());
                        $content = htmlspecialchars($comment->getContent());
                        $validate = $comment->getValidated() == null ? '<a href="index.php?route=admin.comments&id='.$_GET['id'].'#comments" class="btn-sm btn-success mt-3">Valider</a>' : null;
                        ?>
                        <p><?= '<spann id="commentDate">' . $dateComment . '</spann> - <B>' . $pseudo . '</B>  : ' . $content ?> <?= $validate ?></p>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
