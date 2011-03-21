<?php 

/**
 * Lists a user-specified amount of users, and links 
 * automatically generated links for editing access.
 * 
 *  @author 	James Bach	(i7983164)
 *  @version	0.90
 */

include ('customerManipulation.php');

$customerManipulation = new CustomerManipulation();


?>


<div id="content">
	<div id="ContentWrapper">
		<h1>View Customers</h1>
		<form method="post" action="viewCustomer.php">
			<label for="userID">UserID</label><input type="text" id="userID" name="userID"></input>
			<label for="range"></label><input type="text" name="range"></input>
			<input type="submit" id="submit" name="submit"></input>
		</form>					
		
		<?php 
			//	This nested if pulls the data from the database. If there is no range for the query 
			//	to work from, automatically set it to 0, and assume that the user wants only a 
			//	specific user. If 0 range, will automatically redirect the admin to the page 
			//	they need.
			if(isset($_POST['userID'])){
				$customerManipulation->setCustomer($_POST['userID']);
				if(isset($_POST['range'])){
					$range = $_POST['range'];
					$customerManipulation->viewCustomers($customerManipulation->getCustomer(),$range);
				}
				else{
					$customerManipulation->viewCustomers($customerManipulation->getCustomer());
		
				}
			}
				
		?>
	</div>
</div>
