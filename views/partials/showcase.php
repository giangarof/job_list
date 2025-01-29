
<section>

	<div class="first-section">
		<a href=''>
			<button class="btn-first-section">Recent Jobs</button>
		</a>
	</div>

	<?php foreach($listings as $list) : ?>
	
	<div class="second-section"> 
		<div class="card"> 
			<p>Software Engineer</p>
			<p>We are looking a skilled Software Engineer with expertise in cloud enviroments.</p>
			<div class="inner-card">
				<p>Salary: $80.000</p>
				<p>Location: Montana</p>
				<p>Tags: Developent, Coding</p>
			</div>
			<button class="btn-details">Details</button>
		</div>
	</div>

	<?php endforeach; ?>

	<div class="third-section">
		<a href="/listings"> 
			<button class="btn-first-section">Show all jobs</button>
		</a>

	</div>


</section>