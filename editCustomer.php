<?php 
require_once ("ConnectAndSelect.php");
include ("Includes/function_cleaner.php");
include ("Includes/validation.php");
	 
	//	Store anything bad in this array. We'll let the user know 
	//	something bad has come up from it.
	$error_message	=	array();
	
	// 	We will need these to make sure that invalid data is removed.
	// 	Sessions will hold this data, then terminate it when the update
	//	of data is complete.
	//  This method also reduces database transactions, which is good
	//  in the long run. 
	$_SESSION['EditConfirm'] 	= false;
	$_SESSION['DeleteConfirm'] 	= false;
	$_SESSION['NotFound']		= false;
	//	Make sure that we have data to post. Else, skip this statement
	if(isset($_POST['submit'])){
		
		//Sanitize the data, remove any possibility of injection.
		$userID   =   $_SESSION['U_ID'];
		//  Trims whitespace from the data, gets rid of any special characters
		//  that is entered, strips any tags entered into the data.
		$forename =   $_POST['Forename'];
		$surname  =   $_POST['Surname'];
		$phoneNo  =   $_POST['PhoneNum'];
		$email	  =   $_POST['Email'];
		
		if(isset($_POST['deleteUser']) && $_POST['deleteUser'] == true){
			$_SESSION['DeleteConfirm'] = true;
			$sqlDeleteQry = "DELETE FROM USER WHERE U_ID = '$userID'";	
			mysql_query($sqlDeleteQry) or die(mysql_error());
			header("location: CustomerControlPanel.php");
		}
		//FORENAME CHECKNIG
		//	if the value posted is empty/null
		if(!$forename){
			//	When we return to the page, make sure the value is 
			//	what is was before we entered any data.
	        $forename 	=	$_SESSION['forename'];
			//	Make it so that the error gives some sort of identifier.
	        $error_message['forename_error']	=	"You must enter a forename";
		}
		//  Make sure the entry doesn't have any of those nasty characters I 
		//  mentioned above.
		if(!inputCleaner($forename)){
			$forename 	=	$_SESSION['forename'];
			$error_message['forename_error']  = "There was an error with your request, please try again";
		}
		//	If there is any whitespace in the value...
		if(delimiterTester($forename,' ', 0)){
		    $forename 	=	$_SESSION['forename'];
		    $error_message['forename_error']  = "Please enter your forename without any spaces";
		}
		
		//SURNAME CHECKING
		if(!$surname){
	        $surname	=	$_SESSION['surname'];
	        //  Reference for the error-Session.
	        $error_message['surname_error']	=	"You must enter a surname";
		}
		
		if(!inputCleaner($surname)){
	        $surname 	=	$_SESSION['surname'];
	        $error_message['surname_error']  = "There was an error with your request, please try again";
		}
		
		if(delimiterTester($surname,' ',0)){
		    $surname 	=	$_SESSION['surname'];
		    $error_message['surname_error']  = "Please enter your surname without any spaces";
		}
			
		//PHONE NUMBER CHECKING
		if(!$phoneNo){
			$phoneNo	=	$_SESSION['phoneNo'];
			//Reference for the error-Session.
			$error_message['phoneNo'] = "You must enter a phone number";
		}
		
		if(!inputCleaner($phoneNo)){
			$phoneNo 	=	$_SESSION['phoneNo'];
			$error_message['phoneNo_Error']  = "There was an error with your request, please try again";
		}
    
		if(delimiterTester($phoneNo,' ', 0)){
			$phoneNo 	=	$_SESSION['phoneNo'];
			$error_message['phoneNo_error']  = "Please enter your phone number without any spaces";
		}
				
		//EMAIL CHECKING
		
		if(delimiterTester($email,' ',0)){
			$email		=	$_SESSION['email'];
			$error_message['email_error']	=	"please enter an email with no spaces.";
		}
		
		if(!emailValid($email)){
			$email		=	$_SESSION['email'];
			$error_message['email_error']	=	"please enter a valid email";
		
		}
		
		If(count($error_message)>0){
			$_SESSION['Error'] = $error_message;
			//Putting a header here will never get rid of the message. Ever.
			//header("location: editCustomer.php?id=$userID");
        }
		else{
			$sqlUpdateQry = "UPDATE USER SET U_FIRST_NAME = '$forename', U_SURNAME= '$surname', U_PHONE_NO= '$phoneNo', U_EMAIL_ADDRESS = '$email'  WHERE U_ID = '$userID'";	
			mysql_query($sqlUpdateQry) or die(mysql_error());
			$_SESSION['EditConfirm']=True;
			unset($_SESSION['DeleteConfirm']);
			//Get rid of these, since we don't need them any more.
			unset($_SESSION['forename']);
			unset($_SESSION['surname']);
			unset($_SESSION['phoneNo']);
			unset($_SESSION['email']);
			unset($_SESSION['Error']);
			header("location: viewCustomer.php");
		}
	}
	
	//	Get the ID of the post. We will use this later to $_POST back to this page. 
	//	If it isn't set, redirect to 404.
	if(isset($_GET['id'])){
		//	If it's set, then check if someone has inserted any bad 
		//	values into the ID. If they have, redirect to 404.
		if(is_numeric($_GET['id'])){
			
			//	Get the data from the database. Pull only one, since we
			//	only need one. The query is limited for some rudimentary
			//	protection in some far off case that someone circumvents the 
			//	other protections.
			$getter = $_GET['id'];
			
			$userDataQry = "SELECT * FROM USER WHERE U_ID='$getter' LIMIT 1";
			$result = mysql_query($userDataQry);
			$row = mysql_fetch_array($result);
			//if there is no user at this point...
			if(count($row['U_ID'])==''){
				$_SESSION['NotFound']		= true;
				//redirect to viewCustomer with the error.
				header("location: viewCustomer.php");
			}
			else{
				//	Give the data some variables to work from. We'll use this to 
				//	pass the values through to our results table. 
				$_SESSION['U_ID']     =   inputCleaner($row['U_ID']);
				$_SESSION['forename'] =   inputCleaner($row['U_FIRST_NAME']);
				$_SESSION['surname']  =   inputCleaner($row['U_SURNAME']);
				$_SESSION['phoneNo']  =   inputCleaner($row['U_PHONE_NO']);
				$_SESSION['email']	  =	  $row['U_EMAIL_ADDRESS'];
			}
		}
		else{
			if(isset($_SESSION['Error'])){unset($_SESSION['Error']);}
			header("location: 404.php");
		}
	}
	else{
		if(isset($_SESSION['Error'])){unset($_SESSION['Error']);}
		header("location: 404.php");
	}
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
						if(isset($_SESSION['Error']['forename_error'])){
							$error = $_SESSION['Error']['forename_error'];
							echo "<div id='error'>$error</div>";
						}
						if(isset($_SESSION['Error']['surname_error'])){
							$error = $_SESSION['Error']['surname_error'];
							echo "<div id='error'>$error</div>";
						}
						if(isset($_SESSION['Error']['phoneNo_error'])){
							$error = $_SESSION['Error']['phoneNo_error'];
							echo "<div id='error'>$error</div>";
						}
						if(isset($_SESSION['Error']['email_error'])){
							$error = $_SESSION['Error']['email_error'];
							echo "<div id='error'>$error</div>";
						}
						if(isset($_SESSION['Error'])){unset($_SESSION['Error']);}
					?>
					<label for="Forename">Forename</label><input type="text" id="Forename" name="Forename" value="<?php echo $_SESSION['forename'];?>"/>

					<label for="Surname">Surname</label><input type="text" id="Surname" name="Surname" value="<?php echo $_SESSION['surname'];?>"/>

					<label for="Phone">Phone #</label><input type="text" id="PhoneNum" name="PhoneNum" value="<?php echo $_SESSION['phoneNo'];?>"/>
					
					<label for="Email">Email</label><input type="text" id="Email" name="Email" value="<?php echo $_SESSION['email'];?>"/>
					
					<label for='delete'>Delete User</label> <input type='checkbox' value='true' name='deleteUser' id='deleteUser'/>
					
					<input type="submit" id="update" name="submit"/>
				</form>	
			</div>
		</div>
	</body>
</html>