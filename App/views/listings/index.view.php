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
		<!-- <a href=''> -->
			<button class="btn-first-section">
				<?php if(isset($keywords)) : ?>
					Search results for: <?= htmlspecialchars($keywords) ?>
				<?php else : ?>
					All Jobs
				<?php endif; ?>
			</button>
		<!-- </a> -->
	</div>

	<?= loadPartial("message") ?>
	
	<div class="grid"> 
	<?php foreach($listings as $list) : ?>
		<div class="card"> 
			<p><?= $list->title ?></p>
			<p><?= $list->description ?></p>
			<div class="inner-card">
				<p>Salary: <?= formatSalary($list->salary) ?></p>
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

	<div class="first-section">
		<a href='/'>
			<button class="btn-first-section">Home page</button>
		</a>
	</div>

</section>


<?php loadPartial('footer'); ?>