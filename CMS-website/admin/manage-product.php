<?php 
include('header.php');
?>
			<section class="body-container">

<?php
include('report.php');
?>
					<div class="body-content">
<?php
if(!isset($_SESSION["manager"])){
	echo "you are not suppost to be here";

}else{

if (isset($_GET['remove']))
{
		$h =$_GET['remove'];
		$sql2="SELECT * FROM product where p_id='$h'";
		$result2=mysqli_query($conn,$sql2);
		if ($result2 === false) {
			
		}else{
			while ($row=mysqli_fetch_assoc($result2)) {
				$path =$row["imagepath"];
				$name = $row["productName"];
				$sql="DELETE FROM product WHERE p_id='$h'";
				$result=mysqli_query($conn,$sql);
				if ($result === false) {
					$sql1 = "UPDATE product SET  productActive = 1 WHERE p_id = $h";
					$result1=mysqli_query($conn,$sql1);
					echo "action cannot be done, as the data is required for the report, but the product has been hidden";
				}
				else{
					if (file_exists($path)) {
						if($path =='../images/1.jpeg'){
							
						}else{
							unlink($path);
						}
					}
					echo $name .' has been deleted';
				}
			}			
		}
		
}else if (isset($_GET['productACtive']))
		{
		$h =$_GET['productACtive'];
		$sql1 = "UPDATE product SET  productActive = 0 WHERE p_id = $h";
		echo "Product has been Activated";
		$result1=mysqli_query($conn,$sql1);
	
	}


?>


		<?php
		$sql="SELECT * FROM product";
		$result=mysqli_query($conn,$sql);
		echo "<table   border='1' padding='4 px'><tr>
    		<th>Product Name</th>
    		<th>Cost</th>
    		<th>Category</th>
    		<th>Quantity</th>
    		<th>Status</th>
    		<th></th>
    		<th></th>

  		</tr>";
		while ($row=mysqli_fetch_assoc($result)) {
			$productName=$row["productName"];
			$p_id=$row["p_id"];
			$productCategory=$row["productCategory"];
			$Cost=$row["cost"];
			$quantity=$row["quantity"];
			$status =$row["productActive"];
			$path = $row["imagepath"];
			$sqll="SELECT * FROM category where c_id =$productCategory";
			
			$resultl=mysqli_query($conn,$sqll);
			while ($row=mysqli_fetch_assoc($resultl)) {
				$category =$row["Category"];
			}
			 echo "<tr>
                    <td>$productName</td>
                    <td>£ $Cost</td>
					<td>$category</td>
                    <td>$quantity</td>
					
					
					
					";
					
					if($status ==0){
						echo"<td>Active</td>
                    <td><a href='edit-product.php?edit-product=".$p_id."'>edit</a></td>
                    <td><a href='manage-product.php?remove=".$p_id."'>delete</a></td>

                </tr>
						";

					}else{
						echo"<td>currently not Active</td>
                   		 <td><a href='manage-product.php?productACtive=".$p_id."'>Activate</a></td>
                   		 <td></td>
						</tr>

						";

					}

		} 
		?>
		        </table>


<?php
}?>

				</div>

			</section>
<?php

include('footer.php');
?>