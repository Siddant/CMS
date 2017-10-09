
<?php
include('connect.php');

if(!isset($_REQUEST['cat'])){
	
	echo "you are not suppost tobe here";
}else{
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	$id = mysqli_real_escape_string($conn,$_REQUEST['cat']);
	
}else{
	
	
			
}
	$sql="SELECT * FROM product where productCategory =$id AND productActive=0 AND quantity>0";
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
			//echo "<a href='product-page.php?pid=".$p_id."'>".$productName."</a>";
			//echo "<br>";
			}
}
mysqli_close($conn);

?>
