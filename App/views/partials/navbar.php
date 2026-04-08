<?php
use Framework\Session;
$user = Session::get('user');
?>

     <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid text-white">
            <a class="navbar-brand text-white"  href="/">JobList</a>
            <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            

            <?php if(Session::has('user')) : ?>
                <!-- Left side -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/">Home</a>
                    </li>
                </ul>
    
                <!-- Right side -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/user/profile"><?= $user['user']->name ?></a>
                    </li>
                    <form method="POST" action="/auth/logout">
                        <li class="nav-item">
                            <button class="nav-link text-white">Logout</button>
                        </li>
                    </form>
                </ul>

            <?php else : ?>
                <!-- Left side -->
                <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
                    
                </ul> -->
    
                <!-- Right side -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/user/signup">Signup</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/user/login">Login</a>
                    </li>
                </ul>
            <?php endif; ?>


            </div>
        </div>
    </nav>


<?php loadPartials('message'); ?>



