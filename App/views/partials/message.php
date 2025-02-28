<?php
	use Framework\Session;
?>


<!-- success -->
<?php
	$successMessage =  Session::getFlashMessage('success_message')
?>

<?php if ($successMessage !== null) : ?>
	<div>
		<p>
			<?= $successMessage ?>
		</p>
	</div>
<?php endif; ?>




<!-- error -->
<?php
	$errorMessage =  Session::getFlashMessage('error_message')
?>

<?php if ($errorMessage !== null) : ?>
	<div>
		<p>
			<?= $errorMessage ?>
		</p>
	</div>
<?php endif; ?>