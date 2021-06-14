<div>

    <div class="container mv-2">
        <div class="flex mt-2">
            <a href="<?= $context->route()->generate('home:index') ?>">
                <button class="mdl-button mdl-js-button mdl-button--raised">Back</button>
            </a>
        </div>

        <img src="https://picsum.photos/1920/1080" width="100%" height="300" alt="" class="mt-2">

        <div class="post">
            <h2><?= $post->getTitle(); ?></h2>
            <p class="post-content"><?= $post->getContent(); ?></p>
            <p>Posted by, <?= $post->getAuthor()->getName(); ?></p>
        </div>

        <?php if($context->auth()->user()->getId() === $post->getAuthorId()): ?>
            <div class="actions flex flex-row mt-2">
                <a href="<?= $context->route()->generate('post:update', ['id' => $post->getId()]) ?>">
                    <button style="background: #8686e4; color: white" class="mdl-button mdl-js-button mdl-button--raised">Update post</button>
                </a>

                <a class="ml-2" href="<?= $context->route()->generate('post:delete', ['id' => $post->getId()]) ?>">
                    <button style="background: #ff433f; color: white" class="mdl-button mdl-js-button mdl-button--raised">Delete this post</button>
                </a>
            </div>
        <?php endif; ?>

        <hr>

        <div class="comments">
            <h2>Comments</h2>
            <?php if(count($post->getComments()) > 0): ?>
                <?php foreach ($post->getComments() as $comment): ?>
                    <div>
                        <div>Comment: <?= $comment->getComment(); ?></div>
                        <div>Author: <?= $comment->getAuthor()->getName(); ?></div>

                        <?php if($context->auth()->user()->getId() === $comment->getAuthorId()): ?>
                            <div class="flex flex-row">
                                <a href="<?= $context->route()->generate('post:edit:comment', ['comment_id' => $comment->getId()])?>">
                                    Edit
                                </a>

                                <a class="ml-2" href="<?= $context->route()->generate('post:remove:comment', ['comment_id' => $comment->getId()])?>">
                                    Remove
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <br>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alerts">
                    <div class="alert alert-warnings">
                        <p>No comments</p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="mt-4 flex-center">
                <h4>Add comment</h4>

                <form action="<?= $context->route()->generate('post:add:comment', ['post_id' => $post->getId()]) ?>" method="post">
                    <div class="mdl-textfield mdl-js-textfield">
                        <textarea class="mdl-textfield__input" rows= "10" id="comment" name="comment"></textarea>
                        <label class="mdl-textfield__label" for="comment">Comment..</label>
                    </div>

                    <div>
                        <button class="mdl-button mdl-js-button mdl-button--raised" type="submit" name="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
