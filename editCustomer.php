<?php 
	include ('customerManipulation.php');
	
	/** Page for editing details, and removing customers from the database.
	 *	
	 *	@author 	James Bach (i7983164)
	 *	@version	0.90 
	 */
	
	$customerManipulation = new CustomerManipulation();
	
	//	Store anything bad in this array. We'll let the user know 
	//	something bad has come up from it.
	$error_message	=	array();
	
	//	Value storing for later use.
	$oldValues		=	array();
	$newValues		=	array();
	
	// 	We will need these to make sure that invalid data is removed.
	// 	Sessions will hold this data, then terminate it when the update
	//	of data is complete.
	$_SESSION['EditConfirm'] = false;
	$_SESSION['DeleteConfirm'] = false;
	
	//	Make sure that we have data to post. Else, skip this statement
	
	if(isset($_POST['submit'])){
		//Sanitize the data, remove any possibility of injection.
		
		$customerManipulation->setNewValues('u_id',$_POST['userID']);
		$customerManipulation->setNewValues('forename',$_POST['Forename']);
		$customerManipulation->setNewValues('surname',$_POST['Surname']);
		$customerManipulation->setNewValues('phoneNo',$_POST['PhoneNum']);
		
		$oldValues=$customerManipulation->getOldValues();
		$newValues=$customerManipulation->getNewValues();
		
		$customerManipulation->editCustomers($newValues);
		//	Unset our edit and delete sessions. We don't need them 
		//	any more.
		
		unset($_SESSION['EditConfirm']);
		unset($_SESSION['DeleteConfirm']);
	}
	 
	if(isset($_GET['id'])){
	
		//Get the ID of the post. We will use this later to $_POST back to this page
		$customerManipulation->setCustomer($_GET['id']);
		$getter = $customerManipulation ->getCustomer();
		
		//	Get the data from the database. Pull only one, since we
		//	only need one. The query is limited for some rudimentary
		//	protection in some far off case that someone circumvents the 
		//	other protections.
		$userDataQry = "SELECT * FROM USER WHERE U_ID='$getter' LIMIT 1";
		$result = mysql_query($userDataQry);
		$row = mysql_fetch_array($result);
		
		//	Give the data some variables to work from. We'll use this to 
		//	pass the values through to our results table. 
		$customerManipulation->setOldValues('forename', $row['U_FIRST_NAME']);
		$customerManipulation->setOldValues('surname', $row['U_SURNAME']);
		$customerManipulation->setOldValues('phoneNo', $row['U_PHONE_NO']);
		$oldValues=$customerManipulation->getOldValues();

?>
			<div id="content">
				<div id="ContentWrapper">
					<h1>Edit Details</h1>
					<?php 
					//	A dirty little trick. We are POST-ing data, but redirecting to a 
					//	GET instance of the said page. This allows no silly modifications
					//	of the database through GET manipulations, and also has the bonus
					//	of automatically updating the values of the text boxes.
					?>
					<form method="post" action="editCustomer.php?id=<?php echo $getter?>">
						<?php
							//	Use our session we set earlier to determine if we should inform
							//	the user that they've changed the data.  
							if ($_SESSION['EditConfirm']==True){
						
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