<?php
		
		//Connect to the mysql server
		$conn = @mysql_connect("dec20","group18","able7prime7")
			or die ( "Could not connect ");
		//Connect to the our database, group 18
		$rs = @mysql_select_db("group18") 
			or die ( "Could not select database" );
			
		
		if(isset($_POST['P_ID'])){
			$id = $_POST['P_ID'];
			//This deletes from product where the product ID is the same as the $P_ID variable, if the mysql query is invalid it kills the connection and throw an incorrect value					
		}
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		}
		
	$query = "DELETE FROM PRODUCT WHERE P_ID = '$id'";
	mysql_query($query) or die ("Incorrect Values".mysql_error());
	//Closes the mysql connection
	mysql_close();
	header("location:get_product_hopgood.php");
?>
