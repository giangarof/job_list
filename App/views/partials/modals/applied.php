<!-- Applications -->
 <div class="modal fade" id="appliedJobsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-lg modal-dialog-scrollable">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title">Applied Jobs</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">

        <?php if (empty($applied)) : ?>
            <p class="text-muted">No applied jobs yet.</p>
        <?php else : ?>

            <?php foreach($applied as $job) : ?>
                <div class="card border-0 shadow-sm rounded-3 p-3 mb-3">

                    <h6 class="fw-bold mb-1">
                        <?= $job->role ?>
                    </h6>

                    <small class="text-muted">
                        <?= $job->company_name ?>
                    </small>

                    <small class="text-muted">
                        Status: <?= $job->status ?>
                    </small>

                    <small class="text-muted">
                        Applied: <?= date('M d, Y', strtotime($job->applied_at)) ?>
                    </small>

                    <div class="mt-3 d-flex flex-column gap-2">

                    <!-- Top action -->
                    <div class="d-flex justify-content-between align-items-center">

                        <a href="/job/<?= $job->job_id ?>" 
                        class="btn btn-sm btn-outline-primary">
                            View Details
                        </a>

                    </div>

                    <!-- Cancel application -->
                    <form method="POST" action="/job/apply/<?= $job->job_id ?>" class="m-0">
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-3">
                            Cancel application
                        </button>
                    </form>

                </div>

                </div>
            <?php endforeach; ?>

        <?php endif; ?>

      </div>

    </div>
  </div>
</div>