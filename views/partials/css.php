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
/*			border-radius: 10px;*/
			border:none;
			height: 1.7rem;
			padding: .7rem;
		}

		input:focus{
			outline: none;
		}

		.header-btn{
			background-color: royalblue;
			height: 1.7rem;
			border-radius: 0px;
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

		.grid{
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			grid-gap: 1rem;
			place-items: center;
			padding: 2rem 0 2rem 0;
		}

		.outer-card{
			
			display: flex;
			flex-direction: row;
			justify-content: center;
			margin: 10px 0 10px 0;
			
		}

		.card{
			width: 100%;
			background-color: #e8e8e8;
			padding: 1rem;
			border-radius: 10px;
		}

		.inner-card{
			padding: .5rem;
			margin: 1rem 0 1rem 0;
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

		.third-section{
			text-align: center;
		}

		/*	CREATE.VIEW (JOB LISTING)	*/

		.create-job{
			background-color: #e8e8e8;
			display: flex;
			flex-direction: row;
			justify-content: center;
			padding: 3rem 0 2rem 0;

		}

		.top-form{
			padding: 2rem 0 2rem 0;
		}

		.top-form>h1, .top-form>h3{
			color: #000;
			text-align: center;
		}

		.create-form{
			background-color: #fff;
			width: 500px;
			border-radius: 10px;
			box-shadow: 0px 1px 4px 0px;
		}

		.inner-form{
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: 1.3rem;
		}

		.inner-form > input{
			border:1px solid #5e5e5e;
			width: 95%;
			border-radius: 4px;
			height: 1.8rem;
		}

		.form-btns{
			display: flex;
			flex-direction: row;
			justify-content: center;
			padding: 2rem 0 2rem 0;
		}

		.inner-form-btns{
			display: flex;
			flex-direction: column;
			width: 98%;
			gap: 1rem;
		}

		.inner-form-btns>button{
			border-radius: initial;
			height: 2.4rem;
		}

		.save{
			background-color: green;
		}
		.cancel{
			background-color: red;
		}


		/*	ERROR MESSAJE	*/

		.err-msg{
			display: flex;
			flex-direction: row;
			justify-content: center;
		}

		.inner-err{
			text-align: center;
			padding: 2rem;
			line-height: 4rem;
		}



		/*	SHOW VIEW	*/
		

		
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