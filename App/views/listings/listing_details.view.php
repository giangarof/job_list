
<?php loadPartials('head'); ?>

<?php loadPartials('navbar'); ?>

<section class="container my-5">
    <a href="/" class="btn btn-primary rounded-3 mb-3">Go back</a>

    <div class="card border-0 shadow-sm rounded-4 p-4 position-relative">

        <div class="position-absolute top-0 end-0 m-3 d-flex gap-2">
            <a href="/listings/edit/<?= $listing->job_id ?>" 
               class="btn btn-sm btn-warning rounded-3">
                ✏️ Update
            </a>

            <form action="/listings/delete/<?= $listing->job_id ?>" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" 
                        class="btn btn-sm btn-danger rounded-3"
                        >
                    🗑 Delete
                </button>
            </form>
        </div>

        <!-- Job Info -->
        <h4 class="fw-bold mb-3">💼 About the Job</h4>

        <p><strong>Role:</strong> <?= $listing->role ?></p>

        <p>
            <strong>Salary:</strong>
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                $<?= number_format($listing->salary) ?>
            </span>
        </p>

        <p>
            <strong>Requirements:</strong><br>
            <small class="text-muted">
                <?= $listing->requirements ?>
            </small>
        </p>

        <!-- Remote badge -->
        <div class="mb-4">
            <?php if ($listing->remote == "Yes") : ?>
                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                    🌍 Remote
                </span>
            <?php elseif ($listing->remote == "Hybrid") : ?>
                <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">
                    Hybrid
                </span>
            <?php else : ?>
                <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">
                    🏢 Onsite
                </span>
            <?php endif ?>
        </div>

        <hr>

        <!-- Company Info -->
        <h4 class="fw-bold mb-3">🏢 About the Company</h4>

        <p><strong><?= $listing->company_name ?></strong></p>

        <p class="text-muted">📍 <?= $listing->job_location ?></p>

        <p><?= $listing->company_about ?></p>

        <div class="mb-4">
            <strong>What we offer</strong>
            <ul class="mt-2 ps-3">
                <?php 
                $benefits = explode(',', $listing->benefits);
                foreach($benefits as $benefit): ?>
                    <li>✅ <?= trim($benefit) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Apply Button -->
        <a href="/apply/<?= $listing->id ?>" 
           class="btn btn-primary w-100 rounded-3 mt-3">
            Apply Now 
        </a>

    </div>
</section>

<?php loadPartials('footer'); ?>