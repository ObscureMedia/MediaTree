<?php 
	include ('customerManipulation.php');
	
	/** Initiate the variables. We'll use this for storing and passing to the classes. 
	 *	
	 *	@author 	James Bach
	 *	@version	0.90 
	 */
	
	$customerManipulation = new CustomerManipulation();
	$error_message	=	array();
	$oldValues		=	array();
	$newValues		=	array();
	$_SESSION['EditConfirm'] = false;
	$_SESSION['DeleteConfirm'] = false;
	
	
	if(isset($_POST['submit'])){
	
		$customerManipulation->setNewValues('u_id',$_POST['userID']);
		$customerManipulation->setNewValues('forename',$_POST['Forename']);
		$customerManipulation->setNewValues('surname',$_POST['Surname']);
		$customerManipulation->setNewValues('phoneNo',$_POST['PhoneNum']);
		
		$oldValues=$customerManipulation->getOldValues();
		$newValues=$customerManipulation->getNewValues();
		
		$customerManipulation->editCustomers($newValues);
	}
	 
	if(isset($_GET['id'])){
		$customerManipulation->setCustomer($_GET['id']);
		$getter = $customerManipulation ->getCustomer();
		$userDataQry = "SELECT * FROM USER WHERE U_ID='$getter' LIMIT 1";
		$result = mysql_query($userDataQry);
		$row = mysql_fetch_array($result);
		
		$customerManipulation->setOldValues('forename', $row['U_FIRST_NAME']);
		$customerManipulation->setOldValues('surname', $row['U_SURNAME']);
		$customerManipulation->setOldValues('phoneNo', $row['U_PHONE_NO']);
		$oldValues=$customerManipulation->getOldValues();

?>
			<div id="content">
				<div id="ContentWrapper">
					<h1>Edit Details</h1>
					<form method="post" action="editCustomer.php?id=<?php echo $getter?>">
						<?php if ($_SESSION['EditConfirm']==True){
						
							echo "<p>You have successfully updated your details.</p>";
						
						}?>
						<input type="hidden" name="userID" id="userID" value="<?php echo $row['U_ID'];?>" />
						<label for="Forename">Forename</label><input type="text" id="Forename" name="Forename" value="<?php echo $oldValues['forename'];?>"/>
						<label for="Surname">Surname</label><input type="text" id="Surname" name="Surname" value="<?php echo $oldValues['surname'];?>"/>
						<label for="Phone">Phone #</label><input type="text" id="PhoneNum" name="PhoneNum" value="<?php echo $oldValues['phoneNo'];?>"/>
						<?php if ($_SESSION['userType']== "admin"){echo "<label for='delete'>Delete User</label> <input type='checkbox' value='true' name='deleteUser'/>";}?>																		
						<input type="submit" id="update" name="submit"/>
					</form>		
				</div>
			</div>
			<?php 
		}

?>
	</body>
</html>