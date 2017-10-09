<?php 
include('header.php');?>
			<section class="body-container">

<?php
include('report.php');
?>
					<div class="body-content">
<?php
if(!isset($_SESSION["manager"])){
	echo "you are not suppost to be here";

}else{

?>

									<div class="body-content">


					
<form action="" method="post" id="addCategory"  enctype="multipart/form-data"  onSubmit="return validateCategory(this)"> 
		<ul class="form-style-1">		

	<li>
        <label for="category name">Category name:</label>
        <input class="field-long" type="text" name="categoryName" id="categoryName" required />		</li>

   		<li><input type="submit" name="submit" value="Add Category"  /></li>
   	</ul>
</form>      
<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	
	
}else{


	$category =mysqli_real_escape_string($conn,preg_replace('/[^A-Za-z]/', '',$_POST['categoryName']));
	$errors = array(); 
	if(!$category)
    {
      		      $errors[] = 'Please enter a catergory name';

	}   else{
			    ;
        if(is_numeric ($category))
        {
            $errors[] = 'The catregory name should only contain letters';
        }
		if(!empty($errors)) 
		{
				echo 'Uh-oh.. a couple of fields are not filled in correctly..';
				echo '<ul>';
				foreach($errors as $key => $value) 
				{
					echo '<li>' . $value . '</li>'; 
				}
      
		}else{
		
				$sql= "SELECT * FROM category WHERE Category = '".$category."'";
				$result=mysqli_query($conn,$sql);

				if(mysqli_num_rows($result)!=0)
					{
						echo"name already exists";
					}
				else
					{  
						$sql = "INSERT INTO category(c_id, Category, CategoryActive ) VALUES('','$category',0)";                       
						$result = mysqli_query($conn,$sql);
						if(!$result)
							{
								echo 'Something went wrong while registering. Please try again later.';
								
							}
						else
							{
								echo 'Category '.$category .'has been sucessfully inserted';
							}
				}	
		}


	}
	
		
	}
}

?>	
</div>
		</section>

<?php 
include('footer.php');
?>