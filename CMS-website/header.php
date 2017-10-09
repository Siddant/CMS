<?php 
include('connect.php');
session_start(); 
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>E-Commerce website</title>
	<link rel="stylesheet" type="text/css" href="admin/css/myStyle.css">
	<script type="text/javascript" src="script/ajax.js"></script>
	<script type="text/javascript" src="script/validate.js"></script>

</head>
<body>
	<div class="container">
			<header>
					<nav>
						<div class="navigation-container">
								<div class="store-name">
									<h1>Store Name</h1>
								</div>
								<div class="search">
										<form class="checkOutForm" name="checkOutForm" method="get" action="search-result.php">
										            <input   onkeyup="searchProduct()" name="search" id="search" />
													<button id="search-button" class="submit" type="submit" value="Submit Order">Search</button>

										</form>
								</div>
								<div class="navigation">
										<ul>
											<li><a href="index.php">home</a></li>
											<li><a href="cart.php">shopping cart</a></li>
											<li><a href="admin_login.php">Admin side</a></li>
										</ul>
								</div>
						</div>
					</nav>
			</header>
