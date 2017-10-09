<?php 
include('header.php');
?>
			<section class="body-container">

<?php
include('category.php');
?>

<?php
if(!empty($_GET["action"])) {
		include('cart-action.php');


}

if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>	
				<div class="body-content">

				<div class="shopping-Cart"><h1>Shopping Cart: <?php if(!isset($_SESSION["cart_item"])){echo"   0";}else{    echo array_sum(array_column($_SESSION['cart_item'], 'quantity'));}?> Items</h1> <h1><a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a></h1></div><br/>
<table >
<tbody>

<tr>
<th ><strong>Name</strong></th>
<th ><strong>Quantity</strong></th>
<th ><strong>Price</strong></th>
<th ><strong>Total Price</strong></th>
<th ><strong>Action</strong></th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td ><strong><?php echo $item["productName"]; ?></strong></td>
				<td ><?php echo $item["quantity"]; ?></td>
				<td ><?php echo "£ ".$item["price"]; ?></td>
				<td ><?php echo "£ ".$item["price"]*$item["quantity"]; ?></td>
				<td ><a href="cart.php?action=remove&code=<?php echo $item["productName"].$item["pid"]; ?>" class="btnRemoveAction">Remove Item</a></td>
				</tr>
				<?php
        $item_total += ($item["price"]*$item["quantity"]);
		}
		?>
<tr>
												<td></td>
												<td></td>
												<td></td>
<td ><strong>Total:</strong> <?php echo "£ ".$item_total; ?>  </td>
<td ><strong><a href="check-out.php" class="Check-out">Check-out</a></strong>  </td>
</tr>
</tbody>
</table>



<?php
}

?>


				</div>

			</section>
<?PHP
include('footer.php');

?>





