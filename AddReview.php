<?php 
include ('ConnectAndSelect.php');

//Get the product id
	
	//check the input
		//throw this into the sql
		//return user back to product page
	//else
		//throw user back here with errors

//404 if they access this page directly


//Displaying stars:

	//set the stars to 5
		//render stars on page
	//If the user hovers over X stars
		//render the stars up to that point.
	
	//Onclick:
		//remember user's rating give it a value.
		
		

?>


<div id="reviewWrapperontent">
	<div id="reviewWrapper">
		<form method="post" action="addReview.php">
			<table>
				<p><label for="Title">Review Title:</label> &nbsp; <input type="text" size="62" value="" max="255" name="title" id="title"/></p>
				<p><label for="rating">Rating</label></p>
				<p><textarea cols="60" rows="20"></textarea></p>
				<p><input type="submit" value="submit" name="submit" id="submit"/></p>
			</table>
		</form>
	</div>
</div>