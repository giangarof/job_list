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
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 m-4">

    <?php foreach($listings as $job) : ?>
    <div class="col">

        <div class="card border-0 shadow-sm rounded-4 p-3 h-100 hover-shadow">

            <!-- Title -->
            <div class="mb-2">
                <h5 class="mb-1 fw-bold">
                    <?= $job->role ?>
                </h5>
                <small class="text-muted">
                    @<?= $job->company_name ?>
                </small>
            </div>

            <!-- Description -->
            <div class="bg-light rounded-3 p-2 mb-3">
                <small class="text-secondary">
                    <?= $job->description ?>
                </small>
            </div>

            <!-- Tags / info -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                    $<?= number_format($job->salary); ?>
                </span>

                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                    Remote: <?= $job->remote ?>
                </span>
            </div>

            <!-- Button -->
            <a href="/listings/listing_details?id=<?= $job->job_id ?>" class="btn btn-primary w-100 rounded-3">
                Apply
            </a>

        </div>
    </div>
    <?php endforeach; ?>

</div>





    
<?php loadPartials('footer'); ?>
