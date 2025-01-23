<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<style>
		*{
			box-sizing: border-box;
			margin: 0;
		}

		nav{
			background-color: royalblue;
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			padding: 1rem;
		}

		.nav-right{
			display: flex;
			align-items: center;
			gap: 1rem;
		}

		a{
			color: inherit;
			text-decoration: none;
		}

		button{
			border: none;
			border-radius: 10px;
			background-color: orange;
		}

		h1, a, button{
			cursor: pointer;
			color: #fff;
		}
	</style>
</head>
<body>

	<nav>
		<div>
			<h1>Job List</h1>
		</div>

		<div class="nav-right">
			<p>
				<a href=#>Login</a>
			</p>
			<p>
				<a href="#">Register</a>
			</p>
			<button>
				Post a Job
			</button>
		</div>
		

	</nav>
	
	<header>
		

	</header>
</body>
</html>