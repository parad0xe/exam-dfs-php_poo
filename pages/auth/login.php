<div class="container">
    <div class="flex-section mt-4 flex-center">
        <h1>Login</h1>

        <form action="<?= $context->route()->generate('auth:login') ?>" method="post">
            <div class="row mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="email" id="email" name="email" value="<?= $email ?>">
                <label class="mdl-textfield__label" for="email">Email</label>
            </div>

            <div class="row mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="password" id="password" name="password">
                <label class="mdl-textfield__label" for="password">Password</label>
            </div>

            <div>
                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised" name="submit">Connect</button>
            </div>
        </form>
    </div>
</div>
