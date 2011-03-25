<?php
	include ('ConnectAndSelect.php');
	if(isset($_GET['id'])){

		//Posts product id from productpage_hopgood.html
		//$id = $_POST['P_ID'];
		$id = $_GET['id'];
		//Selects values from the table PRODUCT where the product id matches the $id variable posted from productpage_hopgood.html
		$sql = "select * from group18.PRODUCT WHERE P_ID = $id";
		//Checks the connectiona and runs the sql queries
		$rs = mysql_query ($sql) or die ( "Could not execute query" );
		
		//While there is a value in the $row it posts the value to the paragraph tag 		
		while ($row = mysql_fetch_array($rs)) { 
		 echo "<div class = 'image'>","Image: <br/>",$row['P_IMG_REF'],'<br/>',"</div>"
		 ,"<div class = 'name'>",$row['P_NAME'],"</div>"
		 ,"<div class = 'artist'>",$row['P_ARTIST'],"</div>",'<br/>'
		 ,"<div class = 'price'>","Price: £",$row['P_PRICE'],'<br/>'
		 ,$row['P_STOCK']," left in stock ","</div>",'<br/>'
	 ?>
		<div class=buybutton><input type="submit" value="Add To Basket"></div><br/>
		<iframe src="http://www.facebook.com/plugins/like.php?href=decdev.bournemouth.ac.uk%2Fgroup18%2Fproductpages_hopgood.php&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:35px;" allowTransparency="true"></iframe>
	 <?php
		 echo "<div class = 'unimp'>","Release Date: ",$row['P_RELEASE_DATE'],'<br/>'
		 ,"Age Rating: ",$row['P_AGE_RATING'],'<br/>'
		 ,"Genre: ",$row['P_GENRE'],'<br/>'
		 ,"Format: ",$row['P_TYPE'],'<br/>',"</div>",'<br/>'
		 ,"<div class = 'desc'>","Description: ","</div>","<div class = 'description'>",$row['P_DESC'],"</div>",'<br/>';}
		 mysql_close(); 
	 }
		?>
		<div class = 'review'><?php include("productReview.php"); ?></div>
			
		</form>