
<?php loadPartials('head'); ?>

<?php loadPartials('navbar'); ?>

<section class="container my-5">
    <a href="/" class="btn btn-primary rounded-3 mb-3">Go back</a>

    <div class="card border-0 shadow-sm rounded-4 p-4 position-relative">

        <?php if(Framework\Session::isOwner($job->user_id)) : ?>
        <div class="position-absolute top-0 end-0 m-3 d-flex gap-2">
            <a href="/job/edit/<?= $job->job_id ?>" 
               class="btn btn-sm btn-warning rounded-3">
                ✏️ Update
            </a>

            <form method="POST" action="/job/delete/<?= $job->job_id ?>">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" 
                        class="btn btn-sm btn-danger rounded-3"
                        >
                    🗑 Delete
                </button>
            </form>
        </div>
        <?php endif; ?>

        <!-- Job Info -->
        <h4 class="fw-bold mb-3">💼 About the Job</h4>

        <p><strong>Role:</strong> <?= $job->role ?></p>

        <p>
            <strong>Job Description:</strong><br>
            <span class="text-muted">
                <?= $job->description ?>
            </span>
        </p>

        <p>
            <strong>Salary:</strong>
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                $<?= number_format($job->salary) ?>
            </span>
        </p>

        <p>
            <strong>Requirements:</strong><br>
            <small class="text-muted">
                <?= $job->requirements ?>
            </small>
        </p>

        <!-- Remote badge -->
        <div class="mb-4">
            <?php if ($job->modality == "Remote") : ?>
                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                    🌍 Remote
                </span>
            <?php elseif ($job->modality == "Hybrid") : ?>
                <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">
                    Hybrid
                </span>
            <?php else : ?>
                <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">
                    🏢 Onsite
                </span>
            <?php endif ?>
        </div>

         <small class="text-muted mt-2">
            🕒 Posted on <?= date('M d, Y', strtotime($job->created_at)) ?>
        </small>

        <hr>

        <!-- Company Info -->
        <h4 class="fw-bold mb-3">🏢 The company</h4>

        <p>
            <strong><?= $job->company_name ?></strong>
        </p>

        <p>
            <strong>About us:</strong> <br>
            <?= $job->company_about ?>
        </p>

        <p>
            <strong>Location:</strong> <br>
            <span class="text-muted">
                <?= $job->job_location ?>
            </span>
        </p>


        <div class="mb-4">
            <strong>What we offer:</strong>
            <ul class="mt-2 ps-3">
                <?php 
                $benefits = explode(',', $job->benefits);
                foreach($benefits as $benefit): ?>
                    <li>✅ <?= trim($benefit) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="d-flex mb-2 gap-3">

            <!-- Save -->
            <form method="POST" action="/job/save/<?= $job->job_id ?>">
                <button class="btn btn-light border rounded-circle">
                    <i class="fa-solid fa-bookmark"></i>
                </button>
            </form>

            <!-- Share -->
            <button class="btn btn-light border rounded-circle">
                <i class="fa-solid fa-share-nodes"></i>
            </button>

        </div>
        
        <?php if($exists) : ?>
            <!-- Apply Button -->
            <form method="POST" action="/job/apply/<?= $job->job_id ?>">
                <button class="btn btn-outline-danger w-100 rounded-3">Cancel application</button>
            </form>

        <?php else : ?>
            <!-- Apply Button -->
            <form method="POST" action="/job/apply/<?= $job->job_id ?>">
                <button class="btn btn-primary w-100 rounded-3 mt-3">Apply Now</button>
            </form>

        <?php endif; ?>
        

    </div>
</section>

<?php loadPartials('footer'); ?>