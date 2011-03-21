<?php 

include ('mysql_connect.php');

/** Class for basic customer manipulation, such as viewing a specific range of customers, deleting customers, or editing a customer's details.
 * 
 * @author James Bach
 * @version 0.9
 * 
 */
Class CustomerManipulation {

	var $customerID;
	
	/* Provides the functionality to edit or remove a customer from the database. 
	 * 
	 * */
	public function editCustomers($oldValues, $newValues){
		
	}
	
	/* Provides the functionality to view a single customer, or, to view a range of customers 
	 * and provide paginated entries to that range.
	 * 
	 * */
	
	public function viewCustomers($customerID, $range){
		//if the range is <0
		//else
		$getData = $this->getCustomer();
		$tableData =  "<code> <table>
				<tr>
					<th>User ID</th>
					<th>User Email<th>
					<th>Forename</th>
					<th>Surname</th>
					<th>Phone Number</th>
					<th>User Type</th>
				</tr>";	
		if($range > 0){
			$viewCustomerQry = "SELECT * FROM user 
								WHERE U_ID BETWEEN '$getData' AND '$range' 
								LIMIT 100";
			$result = mysql_query($viewCustomerQry) or die( mysql_error());
			echo $tableData;
			while($row = mysql_fetch_array($result)){
			?>
				<tr>
					<td><a href="EditCustomer.php?id=<?php echo $row['U_ID'];?>"><?php echo $row['U_ID']?></a></td>
					<td><?php echo $row["U_EMAIL_ADDRESS"]?></td>
					<td><?php echo $row["U_FIRST_NAME"]?></td>
					<td><?php echo $row["U_SURNAME"]?></td>
					<td><?php echo $row["U_PHONE_NO"]?></td>
					<td><?php echo $row["U_TYPE"]?></td>
				</tr>
			<?php 
			}
			echo"</table></code>";
		}
		if($range == 0){
			$viewCustomerQry = "SELECT * FROM USER 
								WHERE U_ID = '$getData'";
			$result = mysql_query($viewCustomerQry) or die( mysql_error());
			echo $tableData;
			while($row = mysql_fetch_array($result)){
			?>
				<tr>
					<td><a href="EditCustomer.php?id=<?php echo $row['U_ID'];?>"><?php echo $row['U_ID']?></a></td>
					<td><?php echo $row["U_EMAIL_ADDRESS"]?></td>
					<td><?php echo $row["U_FIRST_NAME"]?></td>
					<td><?php echo $row["U_SURNAME"]?></td>
					<td><?php echo $row["U_PHONE_NO"]?></td>
					<td><?php echo $row["U_TYPE"]?></td>
				</tr>
			<?php 
			}
			echo"</table>";
		}
		
	}

	
	public function removeCustomers($customerID){
		/*If the remove customer box is ticked, then remove
		 * this customer. 
		*/
		$this -> customerID = $customerID;
		$removeCustomerQry = "DELETE LOW PRIORITY FROM GROUP18 
		WHERE U_ID = 'getCustomerID();'";
		$result = mysql_query($removeCustomerQry);
	}
	
	public function setCustomer($customerID){
		$this->customerID = $customerID;
	}
	
	public function getCustomer(){
		return $this->customerID;
	}
}


?>