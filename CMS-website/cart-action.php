<?php
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$itemArray = array($code =>array('pid'=>$p_id, 'quantity'=>$itemquantity, 'price'=>$cost,'category'=>$cat,'productName'=>$productName, 'code'=>$code ));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($code ,array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($code == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}if(($_SESSION["cart_item"][$k]["quantity"] +$itemquantity)>$quantity){
									echo"too much";
								}else{
									$_SESSION["cart_item"][$k]["quantity"] +=$itemquantity;
								}
							}
					}
				} else {

					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {					
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;

	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
?>