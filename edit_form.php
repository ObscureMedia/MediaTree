
	<html>
	<head>
	<title>Form Edit Data</title>
	</head>
	 
	<body>
	<table border=1>
	  <tr>
	    <td align=center>Edit Product</td>
	  </tr>
	  <tr>
	    <td>
	      <table>
	      <?
	      include ("db.inc.php");//database connection
	      $id = $_GET['id'];
		  
		  $order = "SELECT * FROM PRODUCT 
			where P_ID='$id'";
	      $result = mysql_query($order);
	      $row = mysql_fetch_array($result);
	      ?>
	      <form method="post" action="edit_data.php">
	      <input type="hidden" name="P_ID" value="<? echo "$row[P_ID]"?>">
	        <tr>       
	          <td>Name</td>
	          <td>
	            <input type="text" name="P_NAME"
	        size="20" value="<? echo "$row[P_NAME]"?>">
	          </td>
	        </tr>
	        <tr>
	          <td>Artist</td>
	          <td>
	            <input type="text" name="P_ARTIST" size="40"
	          value="<? echo "$row[P_ARTIST]"?>">
	          </td>
	        </tr>
			 <tr>
	          <td>Description</td>
	          <td>
	            <textarea cols="30.5" rows="4" name="P_DESC"><? echo "$row[P_DESC]"?></textarea>
	         
	          </td>
	        </tr>
			<tr>
	          <td>Release Date</td>
	          <td>
			  
	            <input type="text" name="P_RELEASE_DATE" size="40"
	          value="<? echo "$row[P_RELEASE_DATE]"?>">
	          </td>
	        </tr>
			<tr>
	          <td>Stock</td>
	          <td>
	            <input type="text" name="P_STOCK" size="40"
	          value="<? echo "$row[P_STOCK]"?>">
	          </td>
	        </tr>
			<tr>
	          <td>Price</td>
	          <td>
	            <input type="text" name="P_PRICE" size="40"
	          value="<? echo "$row[P_PRICE]"?>">
	          </td>
	        </tr>
			<tr>
	          <td>Image Reference</td>
	          <td>
	            <input type="text" name="P_IMG_REF" size="40"
	          value="<? echo "$row[P_IMG_REF]"?>">
	          </td>
	        </tr>
			<tr>
	          <td>Age Rating</td>
	          <td>
	            <input type="text" name="P_AGE_RATING" size="40"
	          value="<? echo "$row[P_AGE_RATING]"?>">
	          </td>
	        </tr>
			<tr>
	          <td>Type</td>
	          <td>
	            <input type="text" name="P_TYPE" size="40"
	          value="<? echo "$row[P_TYPE]"?>">
	          </td>
	        </tr>
			<tr>
	          <td>Genre</td>
	          <td>
	            <input type="text" name="P_GENRE" size="40"
	          value="<? echo "$row[P_GENRE]"?>">
	          </td>
	        </tr>
	        <tr>
          <td align="right">
	            <input type="submit"
	          name="submit value" value="Edit">
	          </td>
	        </tr>
	      </form>
	      </table>
	    </td>
	  </tr>
	</table>
	</body>
	</html>