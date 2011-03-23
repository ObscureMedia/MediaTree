<?php
?>

<div id="topnav">
	<ul>
		<li>
			<img id ="obscurelogo" src="Vinyl_Disk.png">
		</li>	
		<li>
			<p id="logotext">bscureMedia</p>
		</li>
		<li>
			<form action="index.php?page=Search" method="post">
				<select id="searchtype" name="searchcatagory">
				  <option>All</option>
				  <option>CD</option>
				  <option>Vinyl</option>
				  <option>DVD</option>
				</select>			
				<input name="search" type="text" name="search" id ="search"/>
				<input type="submit" value="Search" id ="searchsubmit">		
			</form>
		</li>
		<li>
				<img id ="cart" src="ShoppingCart.png">
		</li>
		<li>
			<p id="cartcount">0</p>
		</li>
	</ul>
</div>