<?php loadPartial('css'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('header'); ?>

<section>
	<div class="outer-card"> 
		<div class="card-1">
			<div class="top-card">
				<a></a>
				<a><button></button></a>
				<a><button></button></a>
			</div>
			<div class="job-info">
				<p><?= $listing->title ?></p>
				<p><?= $listing->description ?></p>
				<div class="inner-card">
					<p>Salary:  <?= formatSalary($listing->salary) ?></p>
					<p>Location: <?= $listing->city ?>, <?= $listing->state ?></p>
					<p>Tags: <?= $listing->tags ?></p>
				</div>
			</div>
		</div>
		<div class="card-2">
			<h3>Job Details</h3>
			<div class="requirements">
				
			</div>
		</div>
	</div>

	<div class="third-section">
		<a href="/listings"> 
			<button class="btn-first-section">Apply Now</button>
		</a>

	</div>


</section>

<?php loadPartial('footer'); ?>