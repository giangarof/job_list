<?php loadPartials('head'); ?>
<?php loadPartials('navbar'); ?>


<section class="py-5">

    <div class="container">

        <!-- Profile header -->
        <div class="mx-auto mb-4" style="max-width: 700px;">
            <p class="fw-bold mb-1"><?= $user['user']->name ?></p>
            <p class="text-muted">Contact: <?= $user['user']->email ?></p>
            <p class="fw-semibold mt-3" role="button" data-bs-toggle="modal" data-bs-target="#savedJobsModal">
                Saved jobs: <?= count($saved) ?>
            </p>
            <p class="fw-semibold mt-3" role="button" data-bs-toggle="modal" data-bs-target="#appliedJobsModal">
                Applied jobs: <?= count($applied) ?>
            </p>

            <p class="fw-semibold mt-3" role="button" data-bs-toggle="modal" data-bs-target="#applicantsJobsModal">
                Applicants Table 
            </p>
        </div>

        <!-- Jobs -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <?php if(count($jobs) >= 1 ) : ?>
                    <p><strong>Your posts:</strong></p>
                    <?php foreach($jobs as $job) : ?>
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">

                            <!-- Title -->
                            <div class="mb-2">
                                <h5 class="mb-1 fw-bold">
                                    <?= $job->role ?>
                                </h5>
                                <small class="text-muted">
                                    @<?= $job->company_name ?> <br> 
                                    <?= date('M d, Y', strtotime($job->updated_at)) ?>
                                </small>
                            </div>
                            

                            <!-- Description -->
                            <div class="bg-light rounded-3 p-3 mb-3">
                                <small class="text-secondary">
                                    <?= $job->description ?>
                                </small>
                            </div>

                            <!-- Tags -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                    $<?= number_format($job->salary); ?>
                                </span>

                                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                    Remote: <?= $job->modality ?>
                                </span>
                            </div>

                            <!-- Actions -->
                            <div class="d-flex mb-3 gap-3">
                                <form method="POST" action="/job/save/<?= $job->job_id ?>">

                                    <button class="btn btn-light border rounded-circle">
                                        <i class="fa-solid fa-bookmark"></i>
                                    </button>
                                </form>

                                <button class="btn btn-light border rounded-circle">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </button>

                                
                            </div>

                            <!-- Apply -->
                            <a href="/job/job_details/<?= $job->job_id ?>" 
                            class="btn btn-primary w-100 rounded-3">
                            Job Details
                            </a>

                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <strong><p>No posts yet... <a href="/job/create">Start adding</a></p></strong>
                <?php endif; ?>

            </div>
        </div>

    </div>

</section>



<!-- Saved Jobs -->
<?php loadPartials('modals/saved', [
    'saved' => $saved,
    'applied_ids' => $applied_ids
]); ?>


<!-- Applications -->
<?php loadPartials('modals/applied', [
    'applied' => $applied
    
]); ?>

<!-- Applicants -->
 <?php loadPartials('modals/applicants', [
    'applicants' => $applicants
    
]); ?>