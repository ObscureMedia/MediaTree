<?php
// This uses the value of the button pressed on the ViewUser.php to  determine which  edit page to load.
if(!isset($_SESSION))
{
session_start();
}
switch ($_POST['changeAddress']) {
      case 'Edit Address':
      	$_SESSION['Address_Number'] = $_POST['Address'];
      		include'EditAddress.php';
		break;
   
      case 'Delete Address':
      	$_SESSION['Dcounter']=$_POST['Dcounter'];
  			include'ChangePassword.php';
    	 break;
	
}
?>