<?php loadPartial('css'); ?>
<?php loadPartial('navbar'); ?>

<section class="sub-header">
	<div class="inner-sub-header">
		<h2>Unlock your carrer potential.</h2>
		<h3>Discover the right career oportunity for you.
	</div>
</section>

<section class="create-job">

	<form class="create-form" method="POST" action="/auth/register">
		<div class="top-form">
			<h1>Sign up</h1>
			<h3>create an account</h3>
		</div>

		<div class="inner-form">
			<?= loadPartial('errors', ['errors' => $errors ?? [] ]) ?>
			<input name="name" placeholder="Full name" value="<?= $user['name'] ?? '' ?>" />
			<input name="email" placeholder="Email" value="<?= $user['email'] ?? '' ?>" /> 
			<input name="city" placeholder="City"  value="<?= $user['city'] ?? '' ?>"/> 
			<input name="state" placeholder="State" value="<?= $user['state'] ?? '' ?>"/> 
			<input name="password" placeholder="Password"  />  
			<input name="passwordConfirmation" placeholder="Confirm Password" /> 
		</div>

		<div class="form-btns">
			<div class="inner-form-btns">
				<button class="save">Sign up</button>
				<p>Already have an account? <a style="color:black;" href="/auth/login">Log in </a> </p>
			</div>
		</div>


	</form>
</section>

<?php loadPartial('footer'); ?>