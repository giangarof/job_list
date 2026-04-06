<?php loadPartials('head'); ?>
<?php loadPartials('navbar'); ?>

<section class="py-5">
    <div class="container">
        <h1>Login</h1>

        <form method="POST" action="/auth/login">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <p>Don't you have an account yet? <a href="/user/signup">Sign up here!</a></p>
            <button type="submit" class="btn btn-primary">Submit</button>
            <p class="mt-3">Forgot your password? <a href="">Restore it!</a></p>
        </form>
    </div>
</section>