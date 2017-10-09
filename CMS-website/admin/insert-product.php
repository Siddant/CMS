<?php 
include('header.php');?>
			<section class="body-container">

				<?php
include('report.php');
if(!isset($_SESSION["manager"])){
	echo "you are not suppost to be here";

}else{
?>


						<div class="body-content">

 
 	<form action="" method="post" id="add-product" enctype="multipart/form-data" onSubmit="return validate(this)">
 				<ul class="form-style-1">		

    	<li><input  class="field-long" type="hidden" name="add" value="true" required/>   	
        <label for="ProductName">Product name:</label>
        <input  class="field-long" type="text" name="ProductName" id="ProductName" required/></li>
		
		<li><label class="field-long" for="category name">Category name:</label>
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
		<SELECT class="field-long"  name="categoryId" id="categoryId" value="<?php echo $categoryName; ?>" >
		<?php echo $options ?>
			</SELECT></li>
				
			<li><label for="Cost">Cost:</label>
	        <input onkeypress="return isNumberKey(event)" class="field-long"   name="Cost" id="Cost" required/></li>

			<li><label for="Quantity">Quantity:</label>
	        <input  onkeypress="return isNumberKey(event)" class="field-long" type="number"  name="Quantity" id="Quantity" required/>	</li>
			
			<li><label for="Product Description">Product Description:</label>
	        <input  class="field-long" type="text" name="ProductDescription" id="ProductDescription" /></li>
			
			<li><label for="Images">Image:</label>
	        <input  class="field-long" type='file' name='Images'  id="Images"/>	</li>

		
		
		
   			<lI> <input type="submit" name="submit" value="Add Product" /></lI>
	</ul>
</form>  
 
 
 
 <?php

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	
	
}else{
	$productName = mysqli_real_escape_string($conn,preg_replace('/[^A-Za-z]/', '',$_POST['ProductName']));
	$description = mysqli_real_escape_string($conn,$_POST['ProductDescription']);
	$price = mysqli_real_escape_string($conn,$_POST['Cost']);
	$quantity = mysqli_real_escape_string($conn,$_POST['Quantity']);
	$category = $_POST['categoryId'];

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
				$errors[]= "product price missing";
			
		}
		if(!$quantity){
				$errors[]= "product quantity missing";
			
		}
		if(!$category){
				$errors[] ="product category missing";
			
		}
	}else{
		if(is_numeric($productName)){
				$errors[]="Product name cannot be number";

		}
		if(!is_numeric($price) || !is_numeric($quantity) ){
            $errors[] = 'Please enter a numeric value in Quantity or Price ';
		
		}if($price<0 || $quantity<0 ){
            $errors[] = 'price or quntity cannot be below 0 ';
		
		}
		$sql= "SELECT * FROM product WHERE productName = '".$productName."'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)!=0){
				$errors[]="product already exists";
		}
		$uploadOk = 1;
		$target_dir = "../images/";

		// Check if image file is a actual image or fake image
		if(!$_FILES["Images"]["type"]) {
			$uploadOk = 0;
			
		} else {
		$check = getimagesize($_FILES["Images"]["tmp_name"]);
			if($check == false) {
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
				//$check = getimagesize($_FILES["Images"]["tmp_name"]);
				if (file_exists($target_file)) {
						$errors[]= "Sorry, file already exists. Therefore image has been set to default you can change it.";
						$uploadOk = 0;
				}				
			}

			
		// Check if $uploadOk is set to 0 by an error
		
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
				//default image
				$target_file = $target_dir ."1.jpeg";
		} else {
				move_uploaded_file($_FILES["Images"]["tmp_name"], $target_file);

		}
						
						$sql = "INSERT INTO product(p_id, productName, productCategory,cost,productDescription,quantity,imagepath,productActive ) 
								VALUES('','$productName','$category','$price','$description','$quantity','$target_file',0)";                       
						$result = mysqli_query($conn,$sql);
						if(!$result)
							{
								echo 'Something went wrong while registering. Please try again later.';
							}
						else
							{
								echo 'product '.$productName .' has been sucessfully inserted';
							}
		}
}

}
}?>
</div>
		</section>
<?php 
include('footer.php');
?>