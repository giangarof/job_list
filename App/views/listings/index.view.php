<?php loadPartial('css'); ?>
<?php loadPartial('navbar'); ?>

<section class="sub-header">
	<div class="inner-sub-header">
		<h2>Unlock your carrer potential.</h2>
		<h3>Discover the right career oportunity for you.
	</div>
</section>

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
				<p>Salary: <?= formatSalary($list->salary) ?></p>
				<p>Location: <?= $list->city ?>, <?= $list->state ?></p>
				<p>Tags: <?= $list->tags ?></p>
			</div>
			<a class="btn-to-details" href="/listing/<?= $list->id ?>">
				<button class="btn-details">Details</button>
			</a>
		</div>
	<?php endforeach; ?>
	</div>

</section>


<?php loadPartial('footer'); ?>