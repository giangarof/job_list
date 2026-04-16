<?php loadPartials('head'); ?>
<?php loadPartials('navbar'); ?>

<section class="py-5">
    <div class="container">
        <?= loadPartials('errors_form', [
            'errors' => $errors ?? []
        ]) ?>
        <h1>Did you forget your password?</h1>
        <p>If your email is with us, we'll send you an email confirmation</p>

        <form method="POST" action="/request_token">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="email" name="email">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
            <p class="mt-3">If you know you credentials, <a href="/user/login">Login!</a></p>
        </form>
    </div>
</section>