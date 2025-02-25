<?php if(isset($_SESSION['success_message'])) : ?>
		<div>
			<p>
				<?= $_SESSION['success_message'] ?>
			</p>
		</div>
		<?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if(isset($_SESSION['error_message'])) : ?>
		<div>
			<p>
				<?= $_SESSION['error_message'] ?>
			</p>
		</div>
		<?php unset($_SESSION['error_message']); ?>
	<?php endif; ?>