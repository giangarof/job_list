<?php loadPartials('head'); ?>
<?php loadPartials('navbar'); ?>

<section class="py-5">
    <div class="container">
        <?= loadPartials('errors_form', [
            'errors' => $errors ?? []
        ]) ?>
        <h1>Login</h1>

        <form method="POST" action="/auth/loginPost">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <p>Don't you have an account yet? <a href="/user/signup">Sign up here!</a></p>
            <button type="submit" class="btn btn-primary">Submit</button>
            <p class="mt-3">Forgot your password? <a href="/request">Restore it!</a></p>
        </form>
    </div>
</section>