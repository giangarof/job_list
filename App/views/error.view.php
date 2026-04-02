<?php loadPartials('head'); ?>
<?php loadPartials('navbar'); ?>


<div class="text-center pt-5">
    <h1 class='text-danger'><?= $status ?></h1>
    <p><?= $message ?></p>
    <a class="nav-link" href="/">
        <button class="btn btn-primary">Go Home</button>
    </a>
    
</div>