CREATE DATABASE CMS;



 CREATE TABLE IF NOT EXISTS `admin` (
	`a_id` int NOT NULL AUTO_INCREMENT, 
	`user_name` VARCHAR(30) NOT NULL,
	`password` VARCHAR(30) NOT NULL,
	PRIMARY KEY (`a_id`));

INSERT INTO `admin` (`a_id`, `user_name`, `password`) VALUES (NULL, 'Admin', 'Adminnumber');


 
 CREATE TABLE IF NOT EXISTS `category` (
	`c_id` int NOT NULL AUTO_INCREMENT, 
	`Category` VARCHAR(30) NOT NULL,
	`CategoryActive` int NOT NULL,
	PRIMARY KEY (`c_id`));



CREATE TABLE IF NOT EXISTS `product` (
		`p_id` int NOT NULL AUTO_INCREMENT, 
		`productName` CHAR(30) NOT NULL,
		`productCategory` INT NULL, 
		`cost` float NOT NULL,
		`productDescription` Text  NOT NULL,
		`quantity` int NOT NULL,
		`imagepath` CHAR(150) NOT NULL,
		`productActive` int NOT NULL,
		PRIMARY KEY (`p_id`),
		CONSTRAINT `fk_catagory` FOREIGN KEY (`productCategory`) REFERENCES category(`c_id`));




CREATE TABLE IF NOT EXISTS `customer`(
		`customer_id` int(11) NOT NULL AUTO_INCREMENT,
		`fname` varchar(40) NOT NULL,
		`lname` varchar(40) NOT NULL,
		`phone` varchar(35) NOT NULL,
		`email` varchar(45) NOT NULL,
		`addressline` varchar(50) NOT NULL,
		`city` varchar(45) NOT NULL,
		`postcode`varchar(10) NOT NULL,
		`country` varchar(40) NOT NULL,
		PRIMARY KEY(`customer_id`));



CREATE TABLE IF NOT EXISTS `order_details`(
	`orderdetails_id` int(11) NOT NULL AUTO_INCREMENT,
	`quantity` SMALLINT NOT NULL,
	`subtotal` decimal(10,2) NOT NULL,
	PRIMARY KEY(orderdetails_id),
	`product_id` int(11) NOT NULL,
	`customer_id` int(11) NOT NULL,
	FOREIGN KEY(customer_id) REFERENCES
	customer(customer_id),
	FOREIGN KEY(product_id) REFERENCES
	product(p_id));



CREATE TABLE IF NOT EXISTS `orders`(
	`order_id` int(11) NOT NULL AUTO_INCREMENT,
	`order_date` DATE NOT NULL,
	PRIMARY KEY(order_id),
	customer_id int(11)NOT NULL,
	orderdetails_id int(11)NOT NULL,
	FOREIGN KEY (customer_id) REFERENCES
	customer(customer_id),
	FOREIGN KEY (orderdetails_id) REFERENCES
	order_details(orderdetails_id));
