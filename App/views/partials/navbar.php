<?php
	use Framework\Session;
?>

<nav>
		<div>
			<h1><a href="/">Job List</a></h1>
		</div>

		<div class="nav-right">
			<?php if(Session::has('user')) : ?>
				<p>Welcome, <?= Session::get('user')['name'] ?></p>
				<form method="POST" action="/auth/logout">
					<button type="submit">Logout</button>
				</form>
				<a href="/listings/create">
					<button>
						Post a Job
					</button>
				</a>

			<?php else: ?>
				<p>
					<a href=/auth/login>Login</a>
				</p>
				<p>
					<a href="/auth/register">Register</a>
				</p>

			<?php endif; ?>
		</div>
		
</nav>