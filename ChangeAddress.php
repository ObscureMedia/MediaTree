<?php
// This uses the value of the button pressed on the ViewUser.php to  determine which  edit page to load.
if(!isset($_SESSION))
{
session_start();
}
switch ($_POST['changeAddress']) {
      case 'Edit Address':
      	$_POST['Address'];
      foreach ($_POST['Address'] as $cunt)
      {
      echo $cunt;
      echo ",2 ";
      }
      
		break;
   
      case 'Delete Address':
      	$_SESSION['Dcounter']=$_POST['Dcounter'];
  			include'ChangePassword.php';
    	 break;
  
}
?>