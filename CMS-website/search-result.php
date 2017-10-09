
<?php
include('connect.php');

if(isset($_GET['search']) && !empty($_GET['search'])) {
	$productSearch = mysqli_real_escape_string($conn,preg_replace('/[^A-Za-zc\s*a\s*t\s*s\s*\-]/', '', $_GET['search']));   
	$sql = "SELECT * FROM product WHERE productName LIKE '$productSearch%'";  
	$result=mysqli_query($conn,$sql)or die( mysqli_error($conn));
	if(!$result){
		echo "<h3 style='padding:10px; text-decoration:underline;'>No Search Results found</h3>";
		
	}else{
	echo "<h3 style='padding:10px; text-decoration:underline;'>".$rowcount=mysqli_num_rows($result)." Search Results</h3>";
			while ($row=mysqli_fetch_assoc($result)) {
			$productName=$row["productName"];
			$p_id=$row["p_id"];
			$cat =$row["productCategory"];
			$cost =$row["cost"];
			$productDescription =$row["productDescription"];
			$quantity =$row["quantity"];
			$imagepath =$row["imagepath"];
									?>
											<div class="product-container">
												<div class="product-image">
													<img src=CMS-website/<?php echo $imagepath; ?> height="200px" width="250">
												</div>
												<div class="product-content">
													<h4><?php echo"<a href='product-page.php?pid=".$p_id."'>$productName</a>"
?></h4>
													<h5><?php echo"£ ".$cost."";
?></h5>
												</div>
											</div>	<?php			}
	}
}else{


	?>

								<div class="image-banner">
								<img src="images/online-store.jpg" height="350px" width="850px">
							</div>	
							<?php
							$sql="SELECT * FROM product, category  WHERE `category`.`c_id` =  `product`.`productCategory` AND CategoryActive = 0 AND productActive=0 AND quantity>0  ORDER BY  RAND() LIMIT 6";
									$result=mysqli_query($conn,$sql);
									while ($row=mysqli_fetch_assoc($result)) {
										$productName=$row["productName"];
										$p_id=$row["p_id"];
										$cat =$row["productCategory"];
										$cost =$row["cost"];
										$productDescription =$row["productDescription"];
										$quantity =$row["quantity"];
										$imagepath =$row["imagepath"];
										?>
											<div class="product-container">
												<div class="product-image">
													<img src=CMS-website/<?php echo $imagepath; ?> height="200px" width="250">
												</div>
												<div class="product-content">
													<h4><?php echo"<a href='product-page.php?pid=".$p_id."'>$productName</a>"
?></h4>
													<h5><?php echo"£ ".$cost."";
?></h5>
												</div>
											</div>										



										<?php
																			}
									

}
?>