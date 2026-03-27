<?php loadPartials('head'); ?>
<?php loadPartials('navbar'); ?>


<section class="py-5">
    <div class="container">
        <h1>Signup</h1>

        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Your name</label>
                <input type="name" class="form-control" id="name" aria-describedby="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="email">
                <div id="email" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="passwordConfirmation" class="form-label">Password Confirmation</label>
                <input type="password" class="form-control" id="passwordConfirmation">
            </div>
            <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="agreement">
                    <label class="form-check-label" for="agreement">You do agree that your data might be used to improve our website</label>
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>