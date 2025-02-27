<?php loadPartial('css'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('header'); ?>

<section class="show-view-section">
	<div class="outer-card"> 
		<div class="card-1 general">
			<?= loadPartial("message") ?>
			<?php if(Framework\Authorization::isOwner($listing->user_id)) : ?>
			<div class="top-card">
				<a href="/listings"> <- Go back to listings</a>
				<div>
					<a href='/listings/edit/<?= $listing->id ?>'><button class="btn-show save">Edit</button></a>
					<form method="POST">
						<input type="hidden" name="_method" value="delete">
						<button class="btn-show cancel">Delete</button>
					</form>					
				</div>
			</div>
			<?php endif; ?>

			<div class="">
				<p><strong><?= $listing->title ?> </strong></p>
				<p><?= $listing->description ?></p>
				<div class="inner-card">
					<p>Salary:  <?= formatSalary($listing->salary) ?></p>
					<p>Location: <?= $listing->address ?>, <?= $listing->city ?>, <?= $listing->state ?></p>
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
			<a href="#"> 
				<button class="btn-first-section">Apply Now</button>
			</a>

		</div>
	</div>


</section>

<?php loadPartial('footer'); ?>