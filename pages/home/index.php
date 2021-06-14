<div class="container mt-2">
	<div class="flex">
		<a href="<?= $context->route()->generate('post:create') ?>">
			<button class="mdl-button mdl-js-button mdl-button--raised">Create new post</button>
		</a>
	</div>

	<div class="grid3">
        <?php foreach ($posts as $post): ?>
			<div class="card mdl-card mdl-shadow--2dp">
				<div class="mdl-card__title mdl-card--expand">
					<h2 class="mdl-card__title-text"><?= $post->getTitle(); ?></h2>
				</div>
				<img src="https://picsum.photos/1920/1080" alt="" height="200">
				<div class="mdl-card__supporting-text">
                    <?= $post->getTitle(); ?>
				</div>
				<div class="mdl-card__supporting-text">
                    Author: <?= $post->getAuthor()->getName(); ?>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<div class="flex flex-row">
						<a href="<?= $context->route()->generate('post:view', ['id' => $post->getId()]) ?>" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
							View
						</a>

                        <?php if($context->auth()->user()->getId() === $post->getAuthorId()): ?>
							<a class="ml-2" href="<?= $context->route()->generate('post:delete', ['id' => $post->getId()]) ?>">
								<button style="color: #ff433f" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Delete</button>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
        <?php endforeach; ?>
	</div>
</div>
