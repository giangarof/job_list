<?php loadPartial('css'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('header'); ?>

<section class="show-view-section">
	<div class="outer-card"> 
		<div class="card-1 general">
			<div class="top-card">
				<a href="/listings"> <- Go back to listings</a>
				<div>
					<a href='/'><button class="btn-show save">Edit</button></a>
					<a href="/"><button class="btn-show cancel">Delete</button></a>
				</div>
			</div>
			<div class="">
				<p><strong><?= $listing->title ?> </strong></p>
				<p><?= $listing->description ?></p>
				<div class="inner-card">
					<p>Salary:  <?= formatSalary($listing->salary) ?></p>
					<p>Location: <?= $listing->city ?>, <?= $listing->state ?></p>
					<p>Tags: <?= $listing->tags ?></p>
				</div>
			</div>
		</div>
		<div class="card-2 general">
			<h3>Job Details</h3>
			<div class="requirements">
				<p><strong>Requirements:</strong></p>
				<p><?= $listing->requirements ?></p>
				<p><strong>Benefits: </strong></p>
				<p><?= $listing->benefits ?></p>
			</div>
		</div>
		<div class="apply">
			<a href="/listings"> 
				<button class="btn-first-section">Apply Now</button>
			</a>

		</div>
	</div>


</section>

<?php loadPartial('footer'); ?>