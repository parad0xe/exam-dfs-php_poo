<?php

require 'vendor/autoload.php';

use Parad0xeSimpleFramework\Core\SimpleApplication;

$app = new SimpleApplication(__DIR__);
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

	    <!-- Material Design Lite -->
	    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
	    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

	    <link rel="stylesheet" href="/styles.css">
    </head>

    <body>
	    <div class="mdl-layout mdl-layout--fixed-header">
		    <header class="mdl-layout__header">
			    <div class="mdl-layout__header-row">
				    <a href="<?= $app->getContext()->route()->generate('home:index') ?>"><span class="mdl-layout-title">Blog Application</span></a>
				    <div class="mdl-layout-spacer"></div>
				    <nav class="mdl-navigation mdl-layout--large-screen-only">
					    <a class="mdl-navigation__link" href="<?= $app->getContext()->route()->generate('home:index') ?>">Home</a>
					    <?php if($app->getContext()->auth()->isAuth()): ?>
					        <a class="mdl-navigation__link" href="<?= $app->getContext()->route()->generate('auth:logout') ?>">Logout</a>
					    <?php else: ?>
						    <a class="mdl-navigation__link" href="<?= $app->getContext()->route()->generate('auth:login') ?>">Login</a>
					    <?php endif; ?>
				    </nav>
			    </div>
		    </header>
		    <main class="mdl-layout__content">
			    <div class="page-content">
				    <div class="container alerts">
                        <?php foreach (["errors", "success", "warnings", "infos"] as $alert_type): ?>
                            <?php foreach ($app->getContext()->request()->flash()->get($alert_type, []) as $alert): ?>
							    <div class="alert alert-<?= $alert_type ?>">
								    <p><?= $alert ?></p>
							    </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
				    </div>

                    <?= $app->getResponse()->render() ?>
			    </div>
		    </main>
	    </div>
    </body>
</html>
