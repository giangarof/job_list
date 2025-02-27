
<?php loadPartial('css'); ?>
<?php loadPartial('navbar'); ?>

<section class="sub-header">
	<div class="inner-sub-header">
		<h2>Unlock your carrer potential.</h2>
		<h3>Discover the right career oportunity for you.
	</div>
</section>


<section class="create-job">
	<form class="create-form" method="POST" action="/listings/<?= $listing->id ?>">
		<input type="hidden" name="_method" value="PUT" />
		<div class="top-form">
			<h1>Create Job Listing</h1>
			<h3>Job Info</h3>
		</div>

		<div class="inner-form">
			<?= loadPartial('errors', ['errors' => $errors ?? [] ]) ?>
			<input name="title" placeholder="Job Title" value="<?= $listing->title ?? '' ?>" />
			<input name="description" placeholder="Job Description" value="<?= $listing->description ?? '' ?>"/> 
			<input name="salary" placeholder="Annual Salary" value="<?= $listing->salary ?? '' ?>"/> 
			<input name="requirements" placeholder="Requirements" value="<?= $listing->requirements ?? '' ?>"/> 
			<input name="benefits" placeholder="Benefits" value="<?= $listing->benefits ?? '' ?>"/>  
			<input name="tags" placeholder="tags" value="<?= $listing->tags ?? '' ?>"/> 

			<h3>Company Info & Location</h3>
	
			<input name="company" placeholder="Company Name" value="<?= $listing->company ?? '' ?>"/>
			<input name="address" placeholder="Address" value="<?= $listing->address ?? '' ?>"/> 
			<input name="city" placeholder="City" value="<?= $listing->city ?? '' ?>"/> 
			<input name="state" placeholder="State" value="<?= $listing->state ?? '' ?>" /> 
			<input name="phone" placeholder="Phone" value="<?= $listing->phone ?? '' ?>"/>
			<input name="email" placeholder="Email Address For Application" value="<?= $listing->email ?? '' ?>"/>
		</div>

		<div class="form-btns">
			<div class="inner-form-btns">
				<button class="save">Update</button>
				<button class="cancel">
					<a href="/listings/<?= $listing->id ?>">
						Go back
					</a>
				</button>
				
			</div>
		</div>


	</form>
</section>




<?php loadPartial('footer'); ?>