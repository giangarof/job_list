<!-- Saved Jobs -->
<div class="modal fade" id="savedJobsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-lg modal-dialog-scrollable">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title">Saved Jobs</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        
        <?php if (empty($saved)) : ?>
            <p class="text-muted">No saved jobs yet.</p>
        <?php else : ?>

            <?php foreach($saved as $job) : ?>
                <div class="card border-0 shadow-sm rounded-3 p-3 mb-3">

                    <h6 class="fw-bold mb-1">
                        <?= $job->role ?>
                    </h6>

                    <small class="text-muted">
                        @<?= $job->company_name ?>
                    </small>

                    <small class="text-muted">
                        Created: <?= date('M d, Y', strtotime($job->created_at)) ?>
                    </small>

                    <small class="text-muted">
                        Updated: <?= date('M d, Y', strtotime($job->updated_at)) ?>
                    </small>

                    <small class="text-muted">
                        Saved: <?= date('M d, Y H:i', strtotime($job->saved_at)) ?>
                    </small>

                    <div class="mt-3 d-flex flex-column gap-2">

                    <!-- Top row: View + Save -->
                    <div class="d-flex justify-content-between align-items-center">

                        <!-- View -->
                        <a href="/job/<?= $job->job_id ?>" 
                        class="btn btn-sm btn-outline-primary">
                            View Details
                        </a>

                        <!-- Save -->
                        <form method="POST" action="/job/save/<?= $job->job_id ?>" class="m-0">
                            <button type="submit" class="btn btn-light border rounded-circle d-flex align-items-center justify-content-center"
                                    style="width:38px; height:38px; color:green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Unsave job">
                                <i class="fa-solid fa-bookmark"></i>
                            </button>
                        </form>

                    </div>

                    <!-- Apply (primary action) -->
                    <?php if(in_array($job->job_id, $applied_ids)) : ?>
                        <form method="POST" action="/job/apply/<?= $job->job_id ?>" class="m-0">
                            <button type="submit" class="btn btn-outline-danger w-100 rounded-3">
                                Cancel Application
                            </button>
                        </form>
                    <?php else : ?>
                        <form method="POST" action="/job/apply/<?= $job->job_id ?>" class="m-0">
                            <button type="submit" class="btn btn-primary w-100 rounded-3">
                                Apply Now
                            </button>
                        </form>
                    <?php endif; ?>
                    

                </div>

                </div>
            <?php endforeach; ?>

        <?php endif; ?>

      </div>

    </div>
  </div>
</div>
