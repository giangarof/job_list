<?php loadPartials('head'); ?>
<?php loadPartials('navbar'); ?>

<section class="py-5">
    <div class="container">
        <h1>Post a Job</h1>

        <form>
            <div>
                <h2>About the job</h2>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" aria-describedby="role">
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" class="form-control" id="salary" aria-describedby="salary">
                </div>
                
                <div class="mb-3">
                    <label for="requirements" class="form-label">Requirements</label>
                    <input type="text" class="form-control" id="requirements" aria-describedby="requirements">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Job descripttion</label>
                    <input type="text" class="form-control" id="description" aria-describedby="description">
                </div>
                <div class="mb-3 form-check">
                     <input type="checkbox" class="form-check-input" id="exampleCheck1">
                     <label class="form-check-label" for="exampleCheck1">Remote opportunity</label>
                 </div>

            </div>
            <div>
                <h2>About the company</h2>

                <div class="mb-3">
                    <label for="company_name" class="form-label">Company name</label>
                    <input type="text" class="form-control" id="company_name" aria-describedby="company_name">
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Job location</label>
                    <input type="text" class="form-control" id="text" aria-describedby="text">
                </div>
                <div class="mb-3">
                    <label for="company_description" class="form-label">Company descripttion</label>
                    <input type="text" class="form-control" id="company_description" aria-describedby="company_description">
                </div>
                <div class="mb-3">
                    <p>Benefits</p>
                    <div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="401k">
                            <label class="form-check-label" for="401k">401K</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="vacations">
                            <label class="form-check-label" for="vacations">Paid vacations</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="parental_leave">
                            <label class="form-check-label" for="parental_leave">Parental leave</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="pto">
                            <label class="form-check-label" for="pto">PTO</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="employee_discount">
                            <label class="form-check-label" for="employee_discount">Employee discount</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="relocation">
                            <label class="form-check-label" for="relocation">Relocation asistance if needed</label>
                        </div>

                    </div>
                </div>
               
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>