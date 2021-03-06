<?php 
/**
 * Lists a user-specified amount of users, and links 
 * automatically generated links for editing access.
 * 
 *  @author 	James Bach	(i7983164)
 *  @version	0.90
 */
//search by: postcode, address, email, name, phonenumber/
require_once ('ConnectAndSelect.php');
include ("Includes/function_cleaner.php");
include ("Includes/validation.php");


?>


<div id="content">
	<div id="ContentWrapper">
		<h1>View Customers</h1>
		<?php
			//	Use our session we set earlier to determine if we should inform
			//	the user that they've changed the data.  
			if ($_SESSION['EditConfirm']==True){
				echo "<p id = 'error'>You have successfully updated your details.</p>";
				unset($_SESSION['EditConfirm']);
			}
			if ($_SESSION['DeleteConfirm'] == True){
				echo "<p id='error'>You have successfully deleted this user.</p>";
				unset($_SESSION['DeleteConfirm']);
			}
			if ($_SESSION['NotFound']	== True){
				echo "<p id='error'>The user ID cannot be found.</p>";
				unset($_SESSION['NotFound']);
			}
		?>
		
		<?php
			if(isset($_SESSION['Error'])){
				$error = $_SESSION['Error'];
				
				switch($error){
					case isset($error['idInput']):
						echo "<div id='error'>".$error['idInput']."</div>";
						
					case isset($error['rangeInput']):
						echo "<div id='error'>".$error['rangeInput']."</div>";	
				}
				unset($_SESSION['Error']);
			}
		
		?>
		<form method="post" action="viewCustomer.php">
			<div class = "dataEntry">
				<label for="userID">UserID: </label><input type="text" id="userID" name="userID"/>
				<label for="range">ID Range: </label><input type="text" name="range" />
			</div>
			<div class = "dataEntry">
				<label for="email">Email: </label><input type="text" id="email" name="email"/>
			</div>
			<div class = "dataEntry">
				<label for="phoneNo">Phone Number: </label><input type="text" id="phoneNo" name="phoneNo"/>
			</div>
			
			<input type="submit" id="submit" name="submit" />
		</form>					
		
		<?php 
			//	This nested if pulls the data from the database. If there is no range for the query 
			//	to work from, automatically set it to 0, and assume that the user wants only a 
			//	specific user. If 0 range, will automatically redirect the admin to the page 
			//	they need.

			//	cannot fail, since if no user input is entered, the POST-ed message will be ''
			//	It's good to be sure, though.
			if(isset($_POST['userID'])){
				$getData = $_POST['userID'];
				//Will always pass, but it's good to make sure.			
				if(isset($_POST['range'])){
					
					$error_message = array();
					
					$range 		= inputCleaner($_POST['range']);
					$email		= inputCleaner($_POST['email']);
					$phoneNo	= inputCleaner($_POST['phoneNo']);
					
					
					if(!$getData){
						$_SESSION['userQuery'] = false;
					}
					else{
						$_SESSION['userQuery'] = true;
					}

					if($_SESSION['userQuery'] == true){
						
						//	ERROR CHECKING ON IDS AND RANGE	//
						
						if(!isInteger($getData)){
							$error_message['idInput'] =	"Please enter a valid number";	
						}
						
						if(!isInteger($range)){
							$error_message['rangeInput'] =	"Please enter a valid number";	
						}
						
						//	We always want a range, so we default to 0 
						//	when the range POST-ed is null.
						if(!$range){
							$range = 0;
						}

						//	is the input greater than the range??
						if($range < $getData){
							$error_message['rangeInput'] 	=	"You must input a range that is larger than the user ID";
						}
						
						if(delimiterTester($getData,' ',0)){
							$error_message['idInput']	=	"please enter an ID without any spaces";
						}
						
						if(delimiterTester($range,' ',0)){
							$error_message['rangeInput']	=	"Please insert a range without any spaces";
						}
												
						if(count($error_message)>0){
							unset($_SESSION['Error']);
							$_SESSION['Error'] = $error_message;
							header("location: viewCustomer.php");
						}
						else{
							if($range > 0){
								$viewCustomerQry = "SELECT * FROM USER 
													WHERE U_ID BETWEEN '$getData' AND '$range' 
													LIMIT 100";
								$result = mysql_query($viewCustomerQry) or die( mysql_error());
							}
							if($range == 0){
								$viewCustomerQry = "SELECT * FROM USER 
													WHERE U_ID = '$getData'";
								$result = mysql_query($viewCustomerQry) or die( mysql_error());
							}
						}
					}
				
					if(!$email){
						$_SESSION['emailQuery'] = false;
					}
					else{
						$_SESSION['emailQuery'] = true;
					}
					
					if($_SESSION['emailQuery'] == true){
						//insert email validation here
						
						//If no email is entered
						if(!email){
							$error_message['emailInput'] =	"Please enter a valid number";	
						}
						
						
					}

					//after everything, echo the data.
					$tableData =  "<code> <table>
									<tr>
										<th>User ID</th>
										<th>User Email<th>
										<th>Forename</th>
										<th>Surname</th>
										<th>Phone Number</th>
										<th>User Type</th>
									</tr>";	
					echo $tableData;
					while($row = mysql_fetch_array($result)){
					?>
						<tr>
							<td><a href="editCustomer.php?id=<?php echo $row['U_ID'];?>"><?php echo $row['U_ID']?></a></td>
							<td><?php echo inputCleaner($row["U_EMAIL_ADDRESS"])?></td>
							<td><?php echo inputCleaner($row["U_FIRST_NAME"])?></td>
							<td><?php echo inputCleaner($row["U_SURNAME"])?></td>
							<td><?php echo inputCleaner($row["U_PHONE_NO"])?></td>
							<td><?php echo inputCleaner($row["U_TYPE"])?></td>
						</tr>
					<?php 
					}
					echo"</table>";
				}
			}
			mysql_close();
			?>
	
			
	</div>
</div>
