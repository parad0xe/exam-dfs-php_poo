<div class="container">
    <div class="flex-section mt-4 flex-center">
        <div class="flex mt-2">
            <a href="<?= $context->route()->generate('post:view', ['id' => $comment->getPostId()]) ?>">
                <button class="mdl-button mdl-js-button mdl-button--raised">Back</button>
            </a>
        </div>

        <h1>Update Comment</h1>

        <form action="<?= $context->route()->generate('post:edit:comment', ['comment_id' => $comment->getId()]) ?>" method="post">
            <div class="mdl-textfield mdl-js-textfield">
                <textarea class="mdl-textfield__input" rows= "10" id="content" name="content"><?= $comment_content ?></textarea>
                <label class="mdl-textfield__label" for="content">Content..</label>
            </div>

            <div>
                <button class="mdl-button mdl-js-button mdl-button--raised" type="submit" name="submit">Update</button>
            </div>
        </form>
    </div>
</div>
