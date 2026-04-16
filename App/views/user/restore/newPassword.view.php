<?php loadPartials('head'); ?>
<?php loadPartials('navbar'); ?>

<section class="py-5">
    <div class="container">
        <?= loadPartials('errors_form', [
            'errors' => $errors ?? []
        ]) ?>
        <h1>Did you forget your password?</h1>
        <p>If your email is with us, we'll send you an email confirmation</p>

        <form method="POST" action='/updatepsw'>
            <input type="hidden" name="token" value="<?= $token ?>">
            <div class="mb-3">
                <label for="password" class="form-label">New password</label>
                <input type="password" class="form-control" id="password" aria-describedby="password" name="password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm new password</label>
                <input type="password" class="form-control" id="confirm_password" aria-describedby="confirm_password" name="confirm_password">
            </div>
            
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>