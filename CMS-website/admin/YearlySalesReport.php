
<?php

if(!isset($_SESSION["manager"])){
	echo "you are not suppost to be here";

}else{
?>

						<?php
	
$sql="SELECT *, YEAR(order_date) as `year`,SUM(`order_details`.`subtotal`) as `Yealy Sales`, ROUND(AVG(`order_details`.`subtotal`),2) as `Yealy Average Sales` FROM orders, order_details where `orders`.`orderdetails_id` = `order_details`.`orderdetails_id` GROUP BY YEAR(`orders`.`order_date`)";
		$result=mysqli_query($conn,$sql) or die(mysqli_connect_error());
		echo "<table   border='1' padding='4 px'><tr>
    		<th>Year</th>
    		<th>Sales</th>
    		<th>Avergae Sales</th>
  		</tr>";
		while ($row=mysqli_fetch_assoc($result)) {
			$date=$row["year"];
			$profit=$row["Yealy Sales"];
			$average =$row["Yealy Average Sales"];
			    echo "<tr>
                    <td>$date</td>
                    <td>$profit</td>
                    <td>$average</td>


                    ";
					
			}
				

		
		
		       echo" 
		       </tr>
		       </table>";



}





?>
				