<?php 
include('header.php');
?>
			<section class="body-container">

<?php
include('report.php');
?>
					<div class="body-content">
<?php
if(!isset($_REQUEST['edit']) || !isset($_SESSION["manager"])){
	
	echo "you are not suppost to be here";
}else{

	$id = mysqli_real_escape_string($conn,$_REQUEST['edit']);
if($_SERVER['REQUEST_METHOD'] != 'POST'){


	
}else{
	
	$Categoryname = mysqli_real_escape_string($conn,preg_replace('/[^A-Za-z]/', '',$_POST['categoryName']));

	$errors = array(); 
	if(!$Categoryname)
    {
		 $errors[] =  'Please enter a catergory name';

	}   else{
		 if(is_numeric ( preg_replace('#[^A-Za-z]#i', '', $Categoryname)))
        {
            $errors[] = 'The catregory name should not contain numbers';
        }
		if(!empty($errors))
		{
				echo 'Uh-oh.. a couple of fields are not filled in correctly..';
				echo '<ul>';
				foreach($errors as $key => $value) {
					echo '<li>' . $value . '</li>'; 
				}
				
      
		}else{



				$sql= "SELECT * FROM category WHERE Category = '".$Categoryname."'";
				$result=mysqli_query($conn,$sql);

				if(mysqli_num_rows($result)!=0)
					{
						echo"name already exists";
					}
				else{

					$sql = "UPDATE category SET  Category = '$Categoryname' WHERE c_id = $id";
					$result=mysqli_query($conn,$sql);
					if(!$result)
					{
						echo 'Something went wrong while registering. Please try again later.';
					}
					else
					{
						echo 'Category '.$Categoryname .'has been sucessfully updated';
					}

				}
		}
	}
}
?>

<?php
			$sql="SELECT * FROM category where c_id =$id";
			$result=mysqli_query($conn,$sql);
			while ($row=mysqli_fetch_assoc($result)) {
			$categoryName=$row["Category"];
			$c_id=$row["c_id"];
			$status =$row["CategoryActive"];

			}
				?>
		<form action="" method="post" id="updateCategory"  enctype="multipart/form-data"  onSubmit="return validateCategory(this)">
					<ul class="form-style-1">								
						<li><label for="category name">Category name:</label>
						<input class="field-long" type="text" name="categoryName" id="categoryName" value="<?=$categoryName?>" required/></li>
						<li><input type="submit" name="submit" value="update Category" /></li>
					</ul>
		</form>    

<?php 
			
}
?>	
</div>
		</section>

<?php 
include('footer.php');
?>