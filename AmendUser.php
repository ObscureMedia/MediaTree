<html>
<head>
</head>
<?php
if(!isset($_SESSION))
{
session_start();
}
// This uses the value of the button pressed on the EditUser.php to  determine which fields to update and what checks to do.

switch ($_POST['amendDetails']) {
      // if calculate => add
      case 'Save Details':
      		$_SESSION['U_FIRST_NAME'] = $_POST['NEW_U_FIRST_NAME'];
      		$_SESSION['U_SURNAME'] = $_POST['NEW_U_SURNAME'];
      		$_SESSION['U_PHONE_NUMBER'] = $_POST['NEW_U_PHONE_NUMBER'];
 				include 'UpdateUser.php';
            break;

   
      case 'Save Password':
      	// This case checks the password from the form with the password for the session, if it is incorrect then
      	//an message is a sent to the screen and the changes are not made. The user is then returned to the change
      	//password page. If it is correct then the new password is checked
			if ($_POST['U_PASSWORD'] === $_SESSION['U_PASSWORD'])
      		{
      			if ($_POST['NEW_U_PASSWORD'] === $_POST['CONFIRM_U_PASSWORD'])
      	//This checks the new password and confirm password field on the form to check that they are
      	//IDENTICAL. They need to be identical because passwords are case-senstive. If they not the same
      	//a message is displayed and then they are returned to the form. If they are the same then the new password
      	//is updated in the database
      			{
      				$_SESSION['U_PASSWORD'] = $_POST['NEW_U_PASSWORD'];
      				include'UpdateUser.php';
      				}   			
      		}
      		elseif ($_POST['U_PASSWORD'] != $_SESSION['U_PASSWORD'])
      		//This is the message
      		{
      			echo "Incorrect password!<br>";
      			include'ChangeEmailAddress.php';
      		}
            break;

      case 'Save Email Address':
      	//This works in the same way as the 'Save Password' case does.
      	if ($_POST['NEW_U_EMAIL_ADDRESS'] === $_POST['CONFIRM_U_EMAIL_ADDRESS'])
      	{
      		if ($_POST['U_PASSWORD'] === $_SESSION['U_PASSWORD'])
      		{
      			$_SESSION['U_EMAIL_ADDRESS'] = $_POST['NEW_U_EMAIL_ADDRESS'];
      		include 'UpdateUser.php';
      		}
      		elseif ($_POST['U_PASSWORD'] != $_SESSION['U_PASSWORD'])
      		{
      			echo "Paswords do not match!<br>";
      			include'ChangeEmailAddress.php';
      		}
      		
      	}
      	elseif($_POST['NEW_U_EMAIL_ADDRESS'] != $_POST['CONFIRM_U_EMAIL_ADDRESS'])
      	{
      		echo "Email Addresses do not match!<br>";
      			include'ChangeEmailAddress.php';
      	}
            break;
      case 'Cancel':
      	include 'ViewUser.php';
      	break;
}

?>