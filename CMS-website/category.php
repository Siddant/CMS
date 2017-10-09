






				<aside>
					<h1>Category Section</h1>
					<div class="category-section">
						
						<ul>
	


	<?php
		$sql="SELECT * FROM category";
		$result=mysqli_query($conn,$sql);
			while ($row=mysqli_fetch_assoc($result)) {
				if($row["CategoryActive"]==1){

				}else{
					$sql="SELECT * FROM product where productCategory = ".$row["c_id"]."";
					if((mysqli_num_rows(mysqli_query($conn,$sql)))>0){
						$c_id=$row["c_id"];
						$categoryName=$row["Category"];
						echo"<li><a href='javascript:changeCategory($c_id)'>".$categoryName."</a></li>";
																		/*	category-page.php?cat=".$c_id."'>".$categoryName."</a></li>";*/


					}
				}
				
			}

?>
				</ul>					
					</div>
				</aside>

