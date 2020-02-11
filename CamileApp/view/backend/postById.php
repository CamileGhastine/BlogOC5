<?php
require '../CamileApp/view/frontend/required/post.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card my-4">
                <h5 id="comments" class="card-header">Réagissez ici</h5>
                <div class="card-body text-center">
                    <form method="post" action="index.php?route=back.addComment&id=<?= $postId ?>#comments">

                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                        <div class="form-group">
                            <input name="post_id" type="hidden" value="<?= $postId ?>">
                            <textarea class="form-control" name="content" rows="3" required><?= $contentUnvalid ?></textarea>
                        </div>
                        <div class="message-form pb-3"><?= $contentMessage ?></div>

                        <button type="submit" class="btn btn-primary text-center" id="btn-perso1">Réagir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require '../CamileApp/view/frontend/required/comments.php';
?>