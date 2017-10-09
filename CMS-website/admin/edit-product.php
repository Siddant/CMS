<?php 
include('header.php');?>
			<section class="body-container">

				<?php
include('report.php');
?>
					<div class="body-content">
<?php
if(!isset($_REQUEST['edit-product']) || !isset($_SESSION["manager"])){
	echo "you are not suppost to be here";
}else{
		$id = mysqli_real_escape_string($conn,$_REQUEST['edit-product']);
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
	
	
	}else{
		$id = mysqli_real_escape_string($conn, $_POST['p_id']); 
		$path = mysqli_real_escape_string($conn, $_POST['hiddenImages']);
		$productName = mysqli_real_escape_string($conn,preg_replace('/[^A-Za-z]/', '',$_POST['ProductName']));
		$description = mysqli_real_escape_string($conn,$_POST['ProductDescription']);
		$price = mysqli_real_escape_string($conn,$_POST['Cost']);
		$quantity = mysqli_real_escape_string($conn,$_POST['Quantity']);
		$category = mysqli_real_escape_string($conn, $_POST['categoryId']);
		$errors = array(); 

		if(!$productName||!$description||!$price||!$quantity||!$category)
	    {
			if(!$productName){
					$errors[]="Product name missing";

			}
			if(!$description){
					$errors[]="Product description missing";
				
			}
			if(!$price){
					$errors[]="product price missing";
				
			}
			if(!$quantity){
					$errors[]="product quantity missing";
				
			}
			if(!$category){
					$errors[]="product category missing";
				
			}
	}else{
		if(!is_numeric($price) || !is_numeric($quantity) ){
            $errors[] = 'Please enter a numeric value in Quantity or Price ';
		
		}if($price<0 || $quantity<0 ){
            $errors[] = 'price or quntity cannot be below 0 ';
		
		}
		if(is_numeric (  $productName)){

			$errors[] = 'The product name should only contain numbers';

		}

		$sql= "SELECT * FROM product WHERE productName = '".$productName."'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>=1){
					while ($row = mysqli_fetch_assoc($result)) {
							$pid = $row["p_id"];
					}					
					if($pid != $id){
						$errors[]="product already exists";
					}
		}
		$uploadOk = 1;
		$target_dir = "../images/";

		if(!$_FILES["Images"]["type"]) {
			$uploadOk = 0;
			
		} else {
		$check = getimagesize($_FILES["Images"]["tmp_name"]);
			if($check == false) {
				$errors[]= "File is not an image";
				$uploadOk = 0;
			} else {
				if ($_FILES["Images"]["size"] > 1000000) {
						$errors[]= "Sorry, your file is too large.";
						$uploadOk = 0;
				}		
				if($_FILES["Images"]["type"] = "image/jpg"){
						$imageFileType = 'jpg';
				}else if($_FILES["Images"]["type"] = "image/png"){
						$imageFileType ='png';
				}else if($_FILES["Images"]["type"] = "image/jpeg"){
						$imageFileType ='jpeg';
				}else{
						$errors[]= "Sorry, only JPG, JPEG or PNG  files are allowed.";
						$uploadOk = 0;
				}
				$target_file = $target_dir . basename($_FILES["Images"]["name"]);
				if (file_exists($target_file)) {
						$errors[]= "Sorry, file already exists.";
						$uploadOk = 0;
				}				
			}

					
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

		if ($uploadOk == 0) {
			if($path == "../images/1.jpeg"){
				$sql = "UPDATE product SET productName ='$productName',productCategory='$category',cost='$price',productDescription='$description', quantity='$quantity' WHERE p_id = $id";
				$result=mysqli_query($conn,$sql);
				if(!$result)
				{
					echo 'Something went wrong while registering. Please try again later.';
				}
				else
				{
					echo 'product '.$productName .' has been sucessfully updated';

				}
			}else{

				$sql= "SELECT * FROM category WHERE Category = '".$productName."'";
				$result=mysqli_query($conn,$sql);

				if(mysqli_num_rows($result)!=0)
					{
						echo"name already exists";
					}
				else{

						$sql = "UPDATE product SET productName ='$productName',productCategory='$category',cost='$price',productDescription='$description', quantity='$quantity' WHERE p_id = $id";
							$result=mysqli_query($conn,$sql);
						if(!$result)
						{
							echo 'Something went wrong while registering. Please try again later.';
						}
						else
						{
							echo 'product '.$productName .' has been sucessfully updated';
						}	

					}



			}
		} else {
			if($path == "../images/1.jpeg"){
				move_uploaded_file($_FILES["Images"]["tmp_name"], $target_file);
				$sql = "UPDATE product SET productName ='$productName',productCategory='$category',cost='$price',productDescription='$description', quantity='$quantity',imagepath = '$target_file' WHERE p_id = $id";
				$result=mysqli_query($conn,$sql);
				if(!$result)
				{
					echo 'Something went wrong while registering. Please try again later.';
				}
				else
				{
					echo 'product '.$productName .' has been sucessfully updated';

				}
			}else{
				unlink($path);
				move_uploaded_file($_FILES["Images"]["tmp_name"], $target_file);
								
				$sql = "UPDATE product SET productName ='$productName',productCategory='$category',cost='$price',productDescription='$description', quantity='$quantity',imagepath = '$target_file' WHERE p_id = $id";
				$result=mysqli_query($conn,$sql);
				if(!$result)
				{
					echo 'Something went wrong while registering. Please try again later.';
				}
				else
				{
					echo 'product '.$productName .' has been sucessfully updated';

				}
				

			}
		}

		}
}
}

?>

				<?php
			$sql="SELECT * FROM product where p_id =$id";
			$result=mysqli_query($conn,$sql);
			while ($row=mysqli_fetch_assoc($result)) {
			$productName=$row["productName"];
			$p_id=$row["p_id"];
			$cat =$row["productCategory"];
			$cost =$row["cost"];
			$productDescription =$row["productDescription"];
			$quantity =$row["quantity"];
			$imagepath =$row["imagepath"];
			
			
			}
				?>
	<form action="" method="post" id="add-product" enctype="multipart/form-data" onSubmit="return validate(this)">
		<ul class="form-style-1">		
			<li><input type="hidden" name="add" value="true" required/>   	
	        <label for="ProductName">Product name:</label>
	        <input class="field-long" type="text" name="ProductName" id="ProductName" value="<?php echo $productName; ?>" required /></li>
			
			<li><label for="category name">Category name:</label>
			<?php
			$sql="SELECT Category, c_id FROM category";
			$result=mysqli_query($conn,$sql);
			$options="";
			while ($row=mysqli_fetch_assoc($result)) {
				$categoryName=$row["Category"];
				$c_id=$row["c_id"];
				$options.="<OPTION VALUE=$c_id>$categoryName</OPTION>";
			} 
			?>
			<SELECT class="field-long" name="categoryId" id="categoryId" value=<?php echo $cat; ?>>
			<?php echo $options ?>
			</SELECT></li>
				
			<li><label for="Cost">Cost:</label>
	        <input onkeypress="return isNumberKey(event)" class="field-long" type="text" name="Cost" id="Cost" value="<?php echo $cost; ?>" required/></li>

			<li><label for="Quantity">Quantity:</label>
	        <input  onkeypress="return isNumberKey(event)" class="field-long" type="text" name="Quantity" id="Quantity" value="<?php echo $quantity; ?>" required/></li>	
			
			<li><label for="Product Description">Product Description:</label>
	        <input class="field-long" type="text" name="ProductDescription" id="ProductDescription" value="<?php echo $productDescription; ?>"  required/></li>
			
			<li><label for="Images">Image:</label>
	        <input type='file' name='Images'  id="Images"/>	
			<input type ="hidden" name="hiddenImages"  id="hiddenImages" value="<?php echo $imagepath; ?>" required/>   	
			<input type ="hidden" name="p_id"  id="p_id" value="<?php echo $p_id; ?>" required/></li>   	

			<li><input type="submit" name="submit" value="update product" /></li>
		</ul>
	</form>     

<?php 
			
}?>
</div>
		</section>
<?php 
include('footer.php');
?>