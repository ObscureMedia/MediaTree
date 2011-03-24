<?php
// This uses the value of the button pressed on the ViewUser.php to  determine which  edit page to load.
switch ($_POST['changeDetails']) {
      case 'Edit Details':
      		include'EditDetails.php';
		break;
   
      case 'Change Password':
  			include'ChangePassword.php';
    	 break;

      case 'Change Email Address':
      		include'ChangeEmailAddress.php';
		break;      
}
?>