<?php loadPartials('head'); ?>
<?php loadPartials('navbar'); ?>

<section class="py-5">
    <div class="container">
        <h1>Post a Job</h1>

        <!-- display errors -->

        <?= loadPartials('errors_form', [
            'errors' => $errors ?? []
        ]) ?>

        <form method="POST" action="/job/create">
            <div>
                <h2>About the job</h2>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" name="role" aria-describedby="role" value="<?= $job['role'] ?? "" ?>"/>
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" class="form-control" name="salary" aria-describedby="salary" value="<?= $job['salary'] ?? "" ?>">
                </div>
                
                <div class="mb-3">
                    <label for="requirements" class="form-label">Requirements</label>
                    <input type="text" class="form-control" name="requirements" aria-describedby="requirements" value="<?= $job['requirements'] ?? "" ?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Job descripttion</label>
                    <input type="text" class="form-control" name="description" aria-describedby="description" value="<?= $job['description'] ?? "" ?>">
                </div>
                <div>
                    <h2>Modality</h2>
                    <div class="mb-3 form-check">
                        <input type="radio" class="form-check-input" name="modality" value="Onsite" id="onsite">
                        <label class="form-check-label" for="modality">Onsite opportunity</label>
                     </div>
                    <div class="mb-3 form-check">
                        <input type="radio" class="form-check-input" name="modality" value="Remote" id="remote">
                        <label class="form-check-label" for="modality">Remote opportunity</label>
                     </div>
                     <div class="mb-3 form-check">
                        <input type="radio" class="form-check-input" name="modality" value="Hybrid" id="hybrid">
                        <label class="form-check-label" for="modality">Hybrid opportunity</label>
                     </div>
                </div>

            </div>
            <div>
                <h2>About the company</h2>

                <div class="mb-3">
                    <label for="company_name" class="form-label">Company name</label>
                    <input type="text" class="form-control" name="company_name" aria-describedby="company_name" value="<?= $job['company_name'] ?? "" ?>">
                </div>
                <div class="mb-3">
                    <label for="job_location" class="form-label">Job location</label>
                    <input type="text" class="form-control" name="job_location" aria-describedby="job_location" value="<?= $job['job_location'] ?? "" ?>">
                </div>
                <div class="mb-3">
                    <label for="company_about" class="form-label">Company descripttion</label>
                    <input type="text" class="form-control" name="company_about" aria-describedby="company_about" value="<?= $job['company_about'] ?? "" ?>">
                </div>
                <div class="mb-3">
                    <p>Benefits</p>
                    <div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="benefits[]" value="401k">
                            <label class="form-check-label" id="401k">401K</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="benefits[]" value="vacations">
                            <label class="form-check-label" id="vacations">Paid vacations</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="benefits[]" value="parental leave">
                            <label class="form-check-label" id="parental_leave">Parental leave</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="benefits[]" value="pto">
                            <label class="form-check-label" id="pto">PTO</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="benefits[]" value="employee discount">
                            <label class="form-check-label" id="employee_discount">Employee discount</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="benefits[]" value="relocation">
                            <label class="form-check-label" id="relocation">Relocation asistance if needed</label>
                        </div>

                    </div>
                </div>
               
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>