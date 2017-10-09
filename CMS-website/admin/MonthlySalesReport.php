<?php
session_start();

include('connect.php');
if(!isset($_SESSION["manager"])){
	echo "you are not suppost to be here";

}else{
$sql="SELECT *, YEAR(order_date) as `year`, MONTH(order_date)as `month`, SUM(`order_details`.`subtotal`) as `month Sales`, ROUND(AVG(`order_details`.`subtotal`),2) as `month Average Sales` FROM orders, order_details where `orders`.`orderdetails_id` = `order_details`.`orderdetails_id` GROUP BY YEAR(`orders`.`order_date`) , MONTH(`orders`.`order_date`)";
		$result=mysqli_query($conn,$sql) or die(mysqli_connect_error());
		echo "<table   border='1' padding='4 px'><tr>
    		<th>Year</th>
    		<th>Month</th>
    		<th>Sales</th>
    		<th>Avergae Sales</th>
  		</tr>";
		while ($row=mysqli_fetch_assoc($result)) {
			$yeardate=$row["year"];
			$monthdate=$row["month"];
			$profit=$row["month Sales"];
			$average =$row["month Average Sales"];
			    echo "<tr>
                    <td>$yeardate</td>
                    <td>$monthdate</td>
                    <td>£ $profit</td>
                    <td>£ $average</td>

                    ";
					
			}
				

		
		
		       echo" 
		       </tr></table>";
}


mysqli_close($conn);

?>
