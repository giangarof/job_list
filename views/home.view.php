<?php loadPartials('head'); ?>

<?php loadPartials('navbar'); ?>

<!-- Header -->

<div class="text-center text-bg-light p-5">
    <div class="d-flex flex-column gap-3">
        <h1>Find your dream job</h1>
        <h2>Connect with companies and recruiters</h2>
        <h3>Start looking for the latest jobs</h3>
        <i class="fa-solid fa-arrow-down fs-1"></i>

    </div>
    
    <?php loadPartials('search'); ?>
        <div class="mt-5 border border-dark p-3">
            <a href="/listings/index" class="">

                See the latets jobs
            </a>
        </div>
    </div>

    <!-- display randomly some jobs here -->
    
<?php loadPartials('footer'); ?>
