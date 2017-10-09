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
	$sql="DELETE FROM category WHERE c_id='$h'";
	$result=mysqli_query($conn,$sql);
	if ($result === false) {
		$sql1 = "UPDATE category SET  CategoryActive = 1 WHERE c_id = $h";
		$result1=mysqli_query($conn,$sql1);
		echo "action cannot be done, as the data is required for the report, but the product realated to the category has been hidden";

	}
	}else if (isset($_GET['active']))
		{
		$h =$_GET['active'];
		$sql1 = "UPDATE category SET  CategoryActive = 0 WHERE c_id = $h";
		echo "Category has been Activated";
		$result1=mysqli_query($conn,$sql1);
	
	}


?>




		<?php
		$sql="SELECT * FROM category";
		$result=mysqli_query($conn,$sql);
		echo "<table   border='1' padding='4 px'><tr>
    		<th>Category Name</th>
    		<th>Status</th>
    		<th></th>
    		<th></th>

  		</tr>";
		while ($row=mysqli_fetch_assoc($result)) {
			$categoryName=$row["Category"];
			$c_id=$row["c_id"];
			$status =$row["CategoryActive"];
			    echo "<tr>
                    <td>$categoryName</td>";
					if($status ==0){
						echo"<td>Active</td>

                    <td><a href='edit-category.php?edit=".$c_id."'>edit</a>
                    	
                    </td>
                    
                <td><a href='manage-category.php?remove=".$c_id."'>delete</a></td>

            	 </tr>";

					}else{
						echo"<td>currently not Active</td>   
						<td><a href='manage-category.php?active=".$c_id."'> Activate </a></td>
						                   		 <td></td>

             		</tr>";

					}
				

		} 
		
		     echo"   </table>";
?>

<?php 

}?>

				</div>

			</section>
<?php

include('footer.php');
?>