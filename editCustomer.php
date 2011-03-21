<?php 
	include ('customerManipulation.php');
	
	$customerManipulation = new CustomerManipulation();
	$error_message	=	array();
	$oldValues		=	array();
	$newValues		=	array();
	if(isset($_POST['submit'])){
	
//		$newValues['forename'] 	= $_POST['Forename'];
//		$newValues['surname']	= $_POST['Surname'];
//		$newValues['phoneNo']	= $_POST['PhoneNum'];
		$uname		=	$_POST['userID'];
		$forename 	=	$_POST['Forename'];
		$surname	=	$_POST['Surname'];
		$phoneNum	=	$_POST['PhoneNum'];
		
		$sqlUpdateQry = "UPDATE USER SET U_FIRST_NAME = '$forename', U_SURNAME= '$surname', U_PHONE_NO= '$phoneNum'
									 WHERE U_ID = '$uname' ";	
		
		$result = mysql_query($sqlUpdateQry) or die(mysql_error());
	}
	 
	if(isset($_GET['id'])){
		$customerManipulation->setCustomer($_GET['id']);
		$getter = $customerManipulation ->getCustomer();
		$userDataQry = "SELECT * FROM USER WHERE U_ID='$getter' LIMIT 1";
		$result = mysql_query($userDataQry);
		while($row = mysql_fetch_array($result)){		
			$oldValues['forename'] 	= $row['U_FIRST_NAME'];
			$oldValues['surname']	= $row['U_SURNAME'];
			$oldValues['phoneNo']	= $row['U_PHONE_NO'];
?>
<<html>
	<?php include "cssImport.php"?>
	<body>
	
			<?php 
			include "header.php";
			?>
			<div id="content">
				<div id="ContentWrapper">
					<h1>Edit Details</h1>
					<form method="post" action="editCustomer.php?id=<?php echo $getter?>">
						<input type="hidden" name="userID" id="userID" value="<?php echo $row['U_ID'];?>" />
						<label for="Forename">Forename</label><input type="text" id="Forename" name="Forename" value="<?php echo $oldValues['forename'];?>"/>
						<label for="Surname">Surname</label><input type="text" id="Surname" name="Surname" value="<?php echo $oldValues['surname'];?>"/>
						<label for="Phone">Phone #</label><input type="text" id="PhoneNum" name="PhoneNum" value="<?php echo $oldValues['phoneNo'];?>"/>																		
						<input type="submit" id="update" name="submit"/>
					</form>					
				
				</div>
			</div>
			<?php 
		}
	}
				include "footer.php";
			?>
	</body>
</html>