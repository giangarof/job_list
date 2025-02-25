<?php loadPartial('css'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('header'); ?>

<section>
	<div class="first-section">
		<a href=''>
			<button class="btn-first-section">Recent Jobs</button>
		</a>
	</div>

	<div class="grid">
		<?php foreach($listings as $list) : ?>
			<div class="card"> 
				<p><?= $list->title ?></p>
				<p><?= $list->description ?></p>
				<div class="inner-card">
					<p>Salary:  <?= formatSalary($list->salary) ?></p>
					<p>Location: <?= $list->city ?>, <?= $list->state ?></p>
					<?php if(!empty($list->tags)) : ?>
						<!-- <li> -->
							<p>Tags: <?= $list->tags ?></p>
						<!-- </li> -->
					<?php endif; ?>
				</div>
				<a class="btn-to-details" href="/listings/<?= $list->id ?>">
				<button class="btn-details">Details</button>
				</a>

			</div>
		<?php endforeach; ?>
	</div>

	<div class="third-section">
		<a href="/listings"> 
			<button class="btn-first-section">Show all jobs</button>
		</a>

	</div>


</section>

<?php loadPartial('footer'); ?>