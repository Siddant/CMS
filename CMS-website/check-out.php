<?php
include('header.php');
?>
			<section class="body-container">

<?php
include('category.php');
if(empty($_SESSION["cart_item"]) ) {
	header("Location: cart.php ");
}else{
	if($_SERVER['REQUEST_METHOD'] != 'POST'){
	
	

	?>
	<div class="body-content">

	<form  method="post" id="check-out"   enctype="multipart/form-data" onSubmit="return validate(this)">
        <input type="hidden" name="checkOut" value="true"  />
	<ul class="form-style-1">		

	<li>
         <h3>Customer Billing Information</h2>
		</li>
			
		<li>
            <label>Full Name <span class="required">*</span></label>
            <input type="text" name="fName" id="fName"  class="field-divided"  />&nbsp;<input type="text" name="lName" id="lName" class="field-divided"   />
		</li>
		
		
		<li>
            <label>Phone Number <span class="required">*</span></label>
            <input onkeypress="return isNumberKey(event)" type="Number" name="phoneNumber" id="phoneNumber" rows="5" cols="40" maxlength="100"  class="field-long">
		</li>
		<li>
            <label>Email <span class="required">*</span></label>
            <input type="email" name="email" id="email" rows="5" cols="40" maxlength="100"  class="field-long" />
		</li>
<li>
            <label for="delivery address">Delivery Address:<span class="required">*</span></label>
            <input name="deliveryAddress" id="deliveryAddress" rows="5" cols="40" maxlength="100"  class="field-long"></textarea>
		</li>

	

		<li>	
           <label>City <span class="required">*</span></label>
            <input   name="city" id="city" size="11" maxlength="11"  class="field-long"/>
		</li>
		

		<li>	
            <label>Post code <span class="required">*</span></label>
            <input   name="postcode" id="postcode" size="11" maxlength="11"  class="field-long" />
		</li>
		

		<li>	
            <label>Country <span class="required">*</span></label>
            <input   name="country" id="country" size="11" maxlength="11"  class="field-long"/>
		</li>
	
		
							    <li>
							        <input type="submit" value="Submit" />
							    </li>
		
	</ul>
    </form>
	
	<?php
	}else{
		if(empty($_SESSION["cart_item"]) ) {
			header("Location: cart.php ");
		}else{
		if(isset($_POST['checkOut'])){

			$fName = mysqli_real_escape_string($conn,preg_replace('/[^A-Za-z]/', '',$_POST['fName']));
			$lName = mysqli_real_escape_string($conn,preg_replace('/[^A-Za-z]/', '',$_POST['lName']));
			$contactNumber = mysqli_real_escape_string($conn,$_POST['phoneNumber']);
			$email = mysqli_real_escape_string($conn,$_POST['email']);
			$deliveryAddress = mysqli_real_escape_string($conn,preg_replace('/[^A-Za-z0-9c\s*a\s*t\s*s\s*\-]/', '', $_POST['deliveryAddress']));
			$city = mysqli_real_escape_string($conn,preg_replace('/[^A-Za-z]/', '',$_POST['city']));
			$postcode = mysqli_real_escape_string($conn,preg_replace('/[^A-Za-z0-9c\s*a\s*t\s*s\s*\-]/', '', $_POST['postcode']));
			$country = mysqli_real_escape_string($conn,preg_replace('/[^A-Za-z]/', '',$_POST['country']));
			$order_date = date("Y-m-d");

			$errors = array();
									
			if(!$fName||!$lName||!$contactNumber||!$email||!$deliveryAddress||!$city||!$postcode||!$country)
			    {
					if(!$fName){
							$errors[]="First name missing";

					}
					if(!$lName){
							$errors[]="Last name  missing";
						
					}
					if(!$contactNumber){
							$errors[]= "Contact Number  missing";
						
					}
					if(!$email){
							$errors[]= "Email  missing";
						
					}
					if(!$deliveryAddress){
							$errors[] ="Delivery Address  missing";
						
					}					
					if(!$city){
							$errors[] ="City missing";
						
					}					
					if(!$postcode){
							$errors[] ="post code missing";
						
					}					
					if(!$country){
							$errors[] ="country missing";
						
					}
			    }else{
			    	if(is_numeric($fName)||is_numeric($lName)){
						$errors[]="First name or Last namecannot be number";
					}
					if(!is_numeric($contactNumber)){
							$errors[]= "Contact Number  missing";
					}		

					if(is_numeric($city)){
							$errors[] ="City can not be numeric";
						
					}    
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						      $errors[]="Invalid email format"; 
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


						$sql = "INSERT INTO customer(customer_id, fname, lname, phone, email, addressline,  city, postcode, country)VALUES ('', '$fName', '$lName', '$contactNumber', '$email', '$deliveryAddress', '$city', '$postcode', '$country')";
						$result=mysqli_query($conn,$sql);
						$last_id = mysqli_insert_id($conn);
						echo $last_id ;
					
						foreach ($_SESSION["cart_item"] as $each_product) {
								$productorderPrice = $each_product['quantity'] * $each_product['price'];
								$productQuantity = $each_product['quantity'];
								$p_id = $each_product['pid'];
								
								$sql1 = "SELECT * FROM product WHERE p_id = $p_id";
								$result1=mysqli_query($conn,$sql1)or die( mysqli_error($conn));		

								while ($row = mysqli_fetch_assoc($result1)) {
										$quantity = $row["quantity"];
								}					
								

								$sql2 = "INSERT INTO order_details(orderdetails_id, quantity, subtotal, product_id, customer_id) VALUES ('', '$productQuantity',$productorderPrice ,'$p_id','$last_id')";
								
								$res = mysqli_query($conn,$sql2)or die( mysqli_error($conn));
								$last_order_id = mysqli_insert_id($conn);

								$sqlres = "INSERT INTO orders(order_id, order_date, customer_id, orderdetails_id) VALUES ('', '$order_date' , '$last_id',$last_order_id )";
								$results = mysqli_query($conn,$sqlres)or die( mysqli_error($conn));
								if($quantity -$productQuantity ==0 || $quantity -$productQuantity<=0){
											$sql3 = "UPDATE product SET quantity = ($quantity - $productQuantity) WHERE p_id = '$p_id' ";
											$res3	= mysqli_query($conn,$sql3) or die(mysqli_error($conn));
									
								}else{
											$sql4 = "UPDATE product SET quantity = ($quantity - $productQuantity) WHERE p_id = '$p_id' ";
											$res4	= mysqli_query($conn,$sql4) or die(mysqli_error($conn));
								}

											unset($_SESSION["cart_item"]);

						}

					
					echo "thank you for odering with us";
				}


}

		
	}
}
}
?>				</div>

			</section>

<?php
include('footer.php');

?>