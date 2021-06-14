<div class="container">
	<div class="flex-section mt-4 flex-center">
		<div class="flex mt-2">
			<a href="<?= $context->route()->generate('home:index') ?>">
				<button class="mdl-button mdl-js-button mdl-button--raised">Back</button>
			</a>
		</div>

		<h1>Create new Post</h1>

		<form action="<?= $context->route()->generate('post:create') ?>" method="post">
			<div class="row mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="title" name="title" value="<?= $title ?>">
				<label class="mdl-textfield__label" for="title">Name</label>
			</div>

			<div class="mdl-textfield mdl-js-textfield">
				<textarea class="mdl-textfield__input" rows= "10" id="content" name="content"><?= $content ?></textarea>
				<label class="mdl-textfield__label" for="content">Content..</label>
			</div>

			<div>
				<button class="mdl-button mdl-js-button mdl-button--raised" type="submit" name="submit">Create</button>
			</div>
		</form>
	</div>
</div>
