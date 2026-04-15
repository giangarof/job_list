<!-- Applicants Modal -->
<div class="modal fade" id="applicantsJobsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-xl modal-dialog-scrollable">
    <div class="modal-content border-0">

      <!-- Header -->
      <div class="modal-header px-4 py-3">
        <h5 class="modal-title fw-bold">Applicants</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>


      <!-- Body -->
      <div class="modal-body px-4 py-3">

        <?php if(empty($applicants)) : ?>
            <p class="text-muted">No applicants yet.</p>
        <?php else : ?>

        <div class="table-responsive">
          <table class="table align-middle table-hover">

            <thead class="table-light">
              <tr>
                <th># Application</th>
                <th># User</th>
                <th>Name</th>
                <th>Role</th>
                <th>Company</th>
                <!-- <th>Salary</th> -->
                <th style="min-width: 220px;">Update</th>
                <th>Cancel Application</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($applicants as $a): ?>

                <?php
                  $colors = [
                    'Pending' => 'secondary',
                    'Reviewing' => 'info',
                    'Interviewing' => 'warning',
                    'Accepted' => 'success',
                    'Rejected' => 'danger'
                  ];
                ?>

                <tr>
                  <td class="fw-semibold"><?= $a->id ?></td>
                  <td class="fw-semibold"><?= $a->user_id ?></td>
                  <td class="fw-semibold"><?= $a->user_name ?></td>
                  <td><?= $a->role ?></td>
                  <td class="text-muted"><?= $a->company_name ?></td>
                  <!-- <td>$<?= number_format($a->salary) ?></td> -->

                  <!-- Status -->

                  <!-- Update -->
                  <td>
                    <form method="POST" action="/job/application/update-status/<?= $a->job_id ?>" class="d-flex gap-2">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="applicant_id" value="<?= $a->user_id ?>">
                        <select name="status" class="form-select form-select-sm">
                            <option value="Pending" <?= $a->status == 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Reviewing" <?= $a->status == 'Reviewing' ? 'selected' : '' ?>>Reviewing</option>
                            <option value="Interviewing" <?= $a->status == 'Interviewing' ? 'selected' : '' ?>>Interviewing</option>
                            <option value="Accepted" <?= $a->status == 'Accepted' ? 'selected' : '' ?>>Accepted</option>
                            <option value="Rejected" <?= $a->status == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                        </select>

                        <button type="submit" class="btn btn-sm btn-primary">
                            Update
                        </button>

                    </form>
            
                  </td>
                  <td>
                    <form method="POST" action="/job/application/delete/<?= $a->job_id ?>"  >
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="applicant_id" value="<?= $a->user_id ?>">
                        <button type="submit" 
                                class="btn btn-sm btn-outline-danger "
                                style="width: 36px; height: 36px;"
                                title="Cancel application">

                            <i class="fa-solid fa-xmark"></i>

                        </button>

                    </form>
                </td>
                </tr>

              <?php endforeach; ?>
            </tbody>

          </table>
        </div>

        <?php endif; ?>

      </div>

    </div>
  </div>
</div>