<?php
session_start();



?>
<html><head><title> Insert Product </title></head>
		<body>
		<!-- Reference the insert_hopgood2.php and post the values inserted into each feild -->
		<form action="insert_hopgood2.php" method="post">
		<p>
			
			<!-- The majority of the inputs are text entries -->
			Product Name:<br>
			<?php 
				if(isset($_SESSION['errors']['nameError'])){
				$error = $_SESSION['errors']['nameError'];
					echo "<div id='error'>$error</div>";
				}
				unset($_SESSION['nameError']);
			?>
			<input type="text" name="P_NAME"><br>
			Product Artist:<br>
				<?php 
				if(isset($_SESSION['errors']['artistError'])){
				$error = $_SESSION['errors']['artistError'];
					echo "<div id='error'>$error</div>";
				}
				unset($_SESSION['artistError']);
			?>
			<input type="text" name="P_ARTIST"><br>
			Product Description: <br>
				<?php 
				if(isset($_SESSION['errors']['descError'])){
				$error = $_SESSION['errors']['descError'];
					echo "<div id='error'>$error</div>";
				} 
				unset($_SESSION['descError']);
			?>
			<textarea cols="30.5" rows="4" name="P_DESC"></textarea><br>
			Product Release Date<br>
				<?php 
				if(isset($_SESSION['errors']['releasedateError'])){
				$error = $_SESSION['errors']['releasedateError'];
					echo "<div id='error'>$error</div>";
				}
				unset($_SESSION['releasedateError']);
			?>
			<input type="text" name="P_RELEASE_DATE"><br>
			Product Stock <br>
				<?php 
				if(isset($_SESSION['errors']['stockError'])){
				$error = $_SESSION['errors']['stockError'];
					echo "<div id='error'>$error</div>";
				}
				unset($_SESSION['stockError']);
			?>
			<input type="text" name="P_STOCK"><br>
			Product Price <br>
				<?php 
				if(isset($_SESSION['errors']['priceError'])){
				$error = $_SESSION['errors']['priceError'];
					echo "<div id='error'>$error</div>";
				}
				unset($_SESSION['priceError']);
			?>
			<input type="text" name="P_PRICE"><br>
			Product Image Reference <br>
				<?php 
				if(isset($_SESSION['errors']['imgrefError'])){
				$error = $_SESSION['errors']['imgrefError'];
					echo "<div id='error'>$error</div>";
				}
				unset($_SESSION['imgrefError']);
			?>
			<input type="text" name="P_IMG_REF"><br>
			Product Age Rating:<select name="P_AGE_RATING">
			<option value="E">E</option>
			<option value="U">U</option>
			<option value="PG">PG</option>
			<option value="12">12</option>
			<option value="15">15</option>
			<option value="18">18</option>
			<option value="PA">PA</option>
			</select>
			<br>
			<!-- This is a drop down list, of CD, DVD or Vinyl -->
			Product Type:<select name="P_TYPE">
			<option value="CD">CD</option>
			<option value="DVD">DVD</option>
			<option value="Vinyl">Vinyl</option>
			</select>
			<br>
			Product Genre: <br>
				<?php 
				if(isset($_SESSION['errors']['genreError'])){
				$error = $_SESSION['errors']['genreError'];
					echo "<div id='error'>$error</div>";
				}
				unset($_SESSION['genreError']);
			?>
			<input type="text" name="P_GENRE"><br>
			Product Tags: <br>
			<input type="text" name="P_TAG"><br>
			
			<!-- Submit button called add product-->
			<br> <input type="submit" value="Add Product">
			<?php
			unset($_SESSION['errors']);
			?>
		</p>
		</form>
		</body>
</html>
