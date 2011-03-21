<?php 
include ('customerManipulation.php');

$customerManipulation = new CustomerManipulation();
?>

<<html>
	<?php include "cssImport.php"?>
	<body>
	
			<?php 
			include "header.php";
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
			<?php 
			include "footer.php";
			?>
	</body>
</html>