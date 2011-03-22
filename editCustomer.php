<?php 
include ('mysql_connect.php');
include ('includes/function_cleaner.php');
	 

	
	//	Store anything bad in this array. We'll let the user know 
	//	something bad has come up from it.
	$error_message	=	array();
	
	//	Value storing for later use.
	$oldValues		=	array();
	$newValues		=	array();
	
	// 	We will need these to make sure that invalid data is removed.
	// 	Sessions will hold this data, then terminate it when the update
	//	of data is complete.
	//  This method also reduces database transactions, which is good
	//  in the long run. 
	$_SESSION['EditConfirm'] = false;
	$_SESSION['DeleteConfirm'] = false;
	
	//	Make sure that we have data to post. Else, skip this statement
	if(isset($_POST['submit'])){
	
		//Sanitize the data, remove any possibility of injection.
		$userID   =   $_SESSION['U_ID'];
		
		//  Trims whitespace from the data, gets rid of any special characters
		//  that is entered, strips any tags entered into the data.
		$forename =   trim(strip_tags($_POST['Forename']));
		$surname  =   trim(strip_tags($_POST['Surname']));
		$phoneNo  =   trim(strip_tags($_POST['PhoneNum']));
		
		//  Instead of using HTMLStripSpecialChars, I am instead using some Regex
		//  to have a greater degree of control over the input.
		$regExp   = ("/[\!\"\£\$\%\^\&\*\(\)]/");
		
		//Explode the input, which will allow to see if the user has entered any spaces.
		
		//if the value posted is empty/null
		if(!$forename){
	        $forename 	=	$_SESSION['forename'];
	        $error_message['forename_error']	=	"You must enter a forename";
		}
		//  Make sure the entry doesn't have any of those nasty characters I 
		//  mentioned above.
		if(preg_match_all($regExp, $forename,$matches)){
			$forename 	=	$_SESSION['forename'];
			$error_message['forename_error']  = "There was an error with your request, please try again";
		}
		
		if(exploder($forename)){
		    $forename 	=	$_SESSION['forename'];
		    $error_message['forename_error']  = "Please enter your forename without any spaces";
		}
		
		if(!$surname){
	        $surname	=	$_SESSION['surname'];
	        //  Reference for the error-Session.
	        $error_message['surname_error']	=	"You must enter a surname";
		}
		
		if(preg_match_all($regExp, $surname,$matches)){
	        $surname 	=	$_SESSION['surname'];
	        $error_message['surname_error']  = "There was an error with your request, please try again";
		}
		
		if(exploder($surname)){
		    $surname 	=	$_SESSION['surname'];
		    $error_message['surname_error']  = "Please enter your surname without any spaces";
		}
			
		if(!$phoneNo){
			$phoneNo	=	$_SESSION['phoneNo'];
			//Reference for the error-Session.
			$error_message['phoneNo'] = "You must enter a phone number";
		}
		
		if(preg_match_all($regExp, $phoneNo,$matches)){
      $phoneNo 	=	$_SESSION['phoneNo'];
      $error_message['phoneNo_Error']  = "There was an error with your request, please try again";
		}
    
		if(exploder($phoneNo)){
        $phoneNo 	=	$_SESSION['phoneNo'];
        $error_message['phoneNo']  = "Please enter your phone number without any spaces";
		}
		
		$_SESSION['Error'] = $error_message;
		
		If(count($_SESSION['Error'])==0){
        foreach($error_message  as $key){
          echo $key;
        }
        $sqlUpdateQry = "UPDATE USER SET U_FIRST_NAME = '$forename', U_SURNAME= '$surname', U_PHONE_NO= '$phoneNo'  WHERE U_ID = '$userID'";	
        mysql_query($sqlUpdateQry) or die(mysql_error());
        $_SESSION['EditConfirm']=True;
		}
		unset($_SESSION['EditConfirm']);
		unset($_SESSION['DeleteConfirm']);
		unset($_SESSION['forename']);
		unset($_SESSION['surname']);
		unset($_SESSION['phoneNo']);
	}
	 
	if(isset($_GET['id'])){
	
		//Get the ID of the post. We will use this later to $_POST back to this page
		
		//	Get the data from the database. Pull only one, since we
		//	only need one. The query is limited for some rudimentary
		//	protection in some far off case that someone circumvents the 
		//	other protections.
		$getter = $_GET['id'];
		
		$userDataQry = "SELECT * FROM USER WHERE U_ID='$getter' LIMIT 1";
		$result = mysql_query($userDataQry);
		$row = mysql_fetch_array($result);
		
		//	Give the data some variables to work from. We'll use this to 
		//	pass the values through to our results table. 
		$_SESSION['U_ID']     =   $row['U_ID'];
		$_SESSION['forename'] =   $row['U_FIRST_NAME'];
		$_SESSION['surname']  =   $row['U_SURNAME'];
		$_SESSION['phoneNo']  =   $row['U_PHONE_NO'];
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
							//	Use our session we set earlier to determine if we should inform
							//	the user that they've changed the data.  
							if ($_SESSION['EditConfirm']==True){
						
							echo "<p>You have successfully updated your details.</p>";
						
						}?>
						<?php 
              if(isset($_SESSION['Error'])){
            
                foreach($_SESSION['Error'] as $error){
                    echo "<div id='error'>$error</div>";
                 }
              
              unset($_SESSION['Error']);
              }
						?>
						<label for="Forename">Forename</label><input type="text" id="Forename" name="Forename" value="<?php echo $_SESSION['forename'];?>"/>
						<label for="Surname">Surname</label><input type="text" id="Surname" name="Surname" value="<?php echo $_SESSION['surname'];?>"/>
						<label for="Phone">Phone #</label><input type="text" id="PhoneNum" name="PhoneNum" value="<?php echo $_SESSION['phoneNo'];?>"/>
						<?php if ($_SESSION['userType']== "admin"){echo "<label for='delete'>Delete User</label> <input type='checkbox' value='true' name='deleteUser'/>";}?>																		
						<input type="submit" id="update" name="submit"/>
					</form>		
				</div>
			</div>
			<?php 
		

?>
	</body>
</html>