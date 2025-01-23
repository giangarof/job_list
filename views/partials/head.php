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

		/*	NAVBAR	*/
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

		/*	HEADER	*/

		header{
			padding: 1rem;
			background-color: #5d6784;
			display: flex;
			flex-direction: row;
			justify-content: center;

		}

		.header-h1{
			cursor: inherit;
		}

		.inner-header{
			width: 30%;
			text-align: center;
		}

		form{
			display: flex;
			flex-direction: column;
			gap: .3rem;
		}

		input{
			border-radius: 10px;
			border:none;
			height: 1.4rem;
			padding: .7rem;
		}

		input:focus{
			outline: none;
		}

		.header-btn{
			background-color: royalblue;
			height: 1.4rem;
		}

		.sub-header{
			background-color: royalblue;
			display: flex;
			flex-direction: row;
			justify-content: center;

		}
		.inner-sub-header{
			padding: 10px 0 10px 0;
			width: 300px;
			text-align: center;
			color: #fff;

		}

		/*	CARD	*/
		section{
			display: flex;
			flex-direction: column;
			padding: 10px 0 10px 0;
		}
		.first-section{
			display: flex;
			flex-direction: row;
			justify-content: center;
		}
		.btn-first-section{
			height: 3rem;
			font-size: 22px;
			width: 350px;
			border-radius: initial;
			background-color: transparent;
			color: #000;
			border: 2px solid #e8e8e8;
		}
		.second-section{
			display: flex;
			flex-direction: row;
			justify-content: center;
			margin: 10px 0 10px 0;
		}

		.card{
			display: flex;
			flex-direction: column;
			gap: .3rem;
			width: 350px;
			background-color: #e8e8e8;
			padding: 1rem;
			border-radius: 10px;
		}

		.inner-card{
			padding: .5rem;
			background-color: #fff;
			border-radius: 10px;
			display: flex;
			flex-direction: column;
			gap: .5rem;
		}

		.btn-details{
			border-radius: 5px;
			background-color: red;
			height: 2rem;
			font-size: 20px;
			background-color:  #559aff4d;
			color: #493bca
		}

		/*	FOOTER	*/

		footer{
			padding: 1rem;
			background-color: lightgrey;
			display: flex;
			flex-direction: row;
			justify-content: space-around;
			align-items: center;
		}

		.footer-left{
			display: flex;
			flex-direction: column;
			gap: .3rem;
		}


	</style>
</head>
<body>