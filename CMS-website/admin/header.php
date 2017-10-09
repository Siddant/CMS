<?php 
session_start();

include('connect.php');
?>
<!DOCTYPE html>
	<html>
		<head>
			<title>E-Commerce website</title>
			<link rel="stylesheet" type="text/css" href="css/myStyle.css">
			<script type="text/javascript" src="script/validate.js"></script>
			<script type="text/javascript" src="script/ajax.js"></script>

		</head>
		<body>
			<header>

				<nav>
					<div class="navigation-container">
								<div class="store-name">
<?php
						if (isset($_SESSION["manager"])) {
							echo "<h1>Welcome ".$_SESSION["manager"]."</h1>";	
						}else{


						}
				?>								</div>
								<div class="search">
			
								</div>
								<div class="navigation">
						<ul>
							<li><a href="index.php">home</a></li>
							<li><a href="insert-catergory.php">add category</a></li>
							<li><a href="insert-product.php">add product</a></li>
							<li><a href="manage-product.php">manage products</a></li>
							<li><a href="manage-category.php">manage category</a></li>
							<li><a href="admin_logout.php?logout=logadminout">log out</a></li>

						</ul>	

								</div>

				</nav>

				
			</header>
		