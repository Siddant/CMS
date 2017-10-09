
<?php
session_start();

include('connect.php');
if(!isset($_SESSION["manager"])){
	echo "you are not suppost to be here";

}else{
$sql="SELECT *,SUM(`order_details`.`subtotal`) as `Product total Sales`, SUM(`order_details`.`quantity`) as `Quantity sold`, ROUND(AVG(`order_details`.`subtotal`),2) as `Average sales`  FROM order_details, product where `order_details`.`product_id` =  `product`.`p_id` GROUP BY `product`.`p_id` ";
		$result=mysqli_query($conn,$sql) or die(mysqli_connect_error());
		echo "<table   border='1' padding='4 px'><tr>
    		<th>Prduct name</th>
    		<th>Quantity sold</th>
      		<th>total Sales</th>
    		<th>Avergae Sales</th>
  		</tr>";
		while ($row=mysqli_fetch_assoc($result)) {
			$name=$row["productName"];
			$quantity=$row["Quantity sold"];
			$total=$row["Product total Sales"];
			$average =$row["Average sales"];
			    echo "<tr>
                    <td>$name</td>
                    <td>$quantity</td>
                    <td>£ $total</td>
                    <td>£ $average</td>


                    ";
					
			}
				

		
		
		       echo" </table>";

}


mysqli_close($conn);

?>
