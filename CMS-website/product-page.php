<?php 
include('header.php');

?>
			<section class="body-container">

<?php
include('category.php');
if(!empty($_GET["action"]) ) {
		$p_id= $_POST["p_id"];
		$productName = $_POST["productName"];
		$quantity = $_POST["quantity"];
		$cost = $_POST["cost"];
		$itemquantity= $_POST["item-quantity"];
		$cat = $_POST["productCategory"];
		$code = $productName.$p_id;
		include('cart-action.php');

		echo "<a href='product-page.php?pid=".$_POST["p_id"]."'>return back to ".$_POST["p_id"]."</a>";

}else if(!isset($_REQUEST['pid'])){
	
	echo "you are not suppost to be here";
}else{
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	$id = mysqli_real_escape_string($conn,$_REQUEST['pid']);
	
}else{
	
	
			
}
	$sql="SELECT * FROM product where p_id =$id ";
		$result=mysqli_query($conn,$sql);
			while ($row=mysqli_fetch_assoc($result)) {
				if($row["productActive"]==1){

				}else{
					$productName=$row["productName"];
					$p_id=$row["p_id"];
					$cat =$row["productCategory"];
					$cost =$row["cost"];
					$productDescription =$row["productDescription"];
					$quantity =$row["quantity"];
					$imagepath =$row["imagepath"];?>
					<div class="body-content">
							<div class="image-banner">
								<?php echo "<img src='CMS-website/".$imagepath."' height='350px' width='850px'>"; 
	//echo "<img src='CMS-website/".$imagepath."'alt='Smiley face' height='150' width='150'>";

								?>
							</div>	
							<div class="product-detail-container">					
									<div class="product-detail">
										<h1><?php	echo $productName;?></h1>
											<hr>

											<h2><?php	echo "£ $cost   " ;?></h2><h2><?php	echo "Quantity : $quantity   " ;?></h2>
											<hr>
											<p><?php echo $productDescription;?></p>
											<hr>

										</div>
									
					<?php
					//echo $productDescription;
					//echo $quantity;
				
					echo'<form id="form1" name="form1" method="post" action="product-page.php?action=add">
					<input type="hidden"  name="p_id" id="p_id" value=' . $row['p_id'] . ' />
					<input type="hidden"  name="productName" id="productName" value=' . $row['productName'] . ' />
					<input type="hidden"  name="quantity" id="quantity" value=' . $row['quantity'] . ' />
					<input type="hidden"  name="productCategory" id="productCategory" value=' . $row['productCategory'] . ' />
					<input type="hidden"  name="cost" id="cost" value=' . $row['cost'] . ' />
					<input  type="number"  name="item-quantity" id="item-quantity" value= 1  required/>
												<input type="submit" name="button" id="search-button" value="Add Product to Cart"/>
					</form>';
		}
			}
}
?></div>
				</div>

			</section >

<?php
include('footer.php');
?>