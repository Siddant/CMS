<?php 
include('header.php');

if (isset($_SESSION["manager"])) {
    header("location: admin/index.php"); 
    exit();
}

if (isset($_POST["username"]) && isset($_POST["password"])) {

	  $manager = mysqli_real_escape_string($conn,preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"])); 
    $password = mysqli_real_escape_string($conn,preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"])); 
    $sql = "SELECT a_id FROM admin WHERE user_name='$manager' AND password='$password' LIMIT 1"; 

    $result=mysqli_query($conn,$sql);

    $existCount = mysqli_num_rows($result); 
    if ($existCount == 1) { 
	     while($row = mysqli_fetch_assoc($sql)){ 
             $id = $row["id"];
		 }
		 $_SESSION["manager"] = $manager;
		 header("location: admin/index.php");
      exit();
    } else {
		echo 'That information is incorrect, try again <a href="index.php">Click Here</a>';
		exit();
	}
}

?>    <section class="body-container">

<?php
include('category.php');


?>
      

              <div class="body-content" >
              <div class="login-page">
                <div class="form">
                  <form class="login-form" id="form1" name="form1" method="post" action="admin_login.php">
                    <input name="username" type="text" id="username" placeholder="username"/>
                    <input name="password" type="password" id="password" placeholder="password"/>
                    <button >login</button>
                  </form>
                </div>
              </div>
        </div>
      </section>

<?php 


include('footer.php');
?>