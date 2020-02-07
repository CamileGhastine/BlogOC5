<?php
require '../CamileApp/view/frontend/required/post.php';
?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card my-4">
                    <p id="comments" class="card-header">Réagissez ici</p>
                    <div class="card-body">
                        <form method="post" action="index.php?route=back.addComment&id=<?= $postId ?>#comments">

                            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                            <div class="form-group">
                                <input name="post_id" type="hidden" value="<?= $postId ?>">
                                <textarea class="form-control" name="content" rows="3"><?= $contentUnvalid ?></textarea>
                            </div>
                            <P><?= $contentMessage ?></P>

                            <button type="submit" class="btn btn-primary" value="réagir">Réagir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
require 'required/comments.php';
?>