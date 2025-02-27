<?php if(isset($errors)) : ?>
	<?php foreach($errors as $error) : ?>
		<p> <?= $error ?> </p>
	<?php endforeach; ?>
<?php endif; ?>