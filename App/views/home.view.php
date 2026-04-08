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
        <a href="/jobs" class="">
                See the latets jobs
        </a>
    </div>
</div>

    <!-- display randomly some jobs here -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 m-4">

    <?php foreach($jobs as $job) : ?>
    <div class="col">

        <div class="card border-0 shadow-sm rounded-4 p-3 h-100 hover-shadow position-relative">

        <?php if(in_array($job->job_id,$applied_ids)): ?>
            <span class="position-absolute top-0 end-0 m-3 badge rounded-pill bg-success shadow-sm px-3 py-2">Applied</span>
        <?php endif ?>

            <!-- Title -->
            <div class="mb-2">
                <h5 class="mb-1 fw-bold">
                    <?= $job->role ?>
                </h5>

                <small class="text-muted d-block">
                    @<?= $job->company_name ?>
                </small>

                <small class="text-muted">
                    🕒 Posted on <?= date('M d, Y', strtotime($job->created_at)) ?>
                </small>
            </div>

            <!-- Description -->
            <div class="bg-light rounded-3 p-2 mb-3 text-truncate">
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
                    Modality: <?= $job->modality ?>
                </span>
            </div>

            <div class="d-flex mb-2 gap-3">

                    <!-- Save -->
                    <form method="POST" action="/job/save/<?= $job->job_id ?>">
                        
                        <button class="btn btn-light border rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= in_array($job->job_id, $saved_ids) ? 'Unsave job' : 'Save job' ?>">
                            <i class="fa-solid fa-bookmark" style="color: <?= in_array($job->job_id, $saved_ids) ? 'green' : 'none' ?>"></i>
                        </button>
                         
                    </form>

                    <!-- Share -->
                    <button class="btn btn-light border rounded-circle">
                        <i class="fa-solid fa-share-nodes"></i>
                    </button>

                </div>

            <!-- Button -->
            <a href="/job/job_details/<?= $job->job_id ?>" class="btn btn-primary w-100 rounded-3">
                Job Details
            </a>

        </div>
    </div>
    <?php endforeach; ?>

</div>





    
<?php loadPartials('footer'); ?>
