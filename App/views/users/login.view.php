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
			<h1>Log in</h1>
			<h3>Start finding your new job</h3>
		</div>

		<div class="inner-form">
			<?php if(isset($errors)) : ?>
				<?php foreach($errors as $error) : ?>
					<p> <?= $error ?> </p>
				<?php endforeach; ?>
			<?php endif; ?>
			<input name="email" placeholder="Email"  /> 
			<input name="password" placeholder="Password"  />  
		</div>

		<div class="form-btns">
			<div class="inner-form-btns">
				<button class="save">Log in</button>
				<p>You don't have an account yet? <a style="color:black;" href="/auth/register">Sign up</a> </p>
			</div>
		</div>


	</form>
</section>

<?php loadPartial('footer'); ?>