
<?php loadPartial('css'); ?>
<?php loadPartial('navbar'); ?>

<section class="sub-header">
	<div class="inner-sub-header">
		<h2>Unlock your carrer potential.</h2>
		<h3>Discover the right career oportunity for you.
	</div>
</section>


<section class="create-job">
	<form class="create-form" method="POST" action="/listings">
		<div class="top-form">
			<h1>Create Job Listing</h1>
			<h3>Job Info</h3>
		</div>

		<div class="inner-form">
			<input name="title" placeholder="Job Title" />
			<input name="description" placeholder="Job Description" /> 
			<input name="salary" placeholder="Annual Salary" /> 
			<input name="requirements" placeholder="Requirements" /> 
			<input name="benefits" placeholder="Benefits" />  

			<h3>Company Info & Location</h3>
	
			<input name="company-name" placeholder="Company Name" />
			<input name="address" placeholder="Address" /> 
			<input name="city" placeholder="City" /> 
			<input name="state" placeholder="State" /> 
			<input name="phone" placeholder="Phone" />
			<input name="company-email" placeholder="Email Address For Application" />
		</div>

		<div class="form-btns">
			<div class="inner-form-btns">
				<button class="save">Save</button>
				<button class="cancel">Cancel</button>
			</div>
		</div>


	</form>
</section>




<?php loadPartial('footer'); ?>