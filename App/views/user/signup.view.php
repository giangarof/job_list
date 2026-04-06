<?php loadPartials('head'); ?>
<?php loadPartials('navbar'); ?>

<section class="py-5">
    
    <div class="container">
         <?= loadPartials('errors_form', [
            'errors' => $errors ?? []
        ]) ?>
        <h1>Signup</h1>

        <form method="POST" action="/auth/signup">
            <div class="mb-3">
                <label for="name" class="form-label">Your name</label>
                <input type="text" class="form-control" id="name" aria-describedby="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="email" name="email">
                <div id="email" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="passwordConfirmation" class="form-label">Password Confirmation</label>
                <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="agreement" name="agreement" value="agree>
                <label class="form-check-label" for="agreement">You do agree our terms and conditions and our data privacy.</label>
            </div>
            <p>Already have an account? <a href="/user/login">Login Here!</a></p>
            <button type="submit" class="btn btn-primary">Submit</button>
            
        </form>
    </div>
</section>