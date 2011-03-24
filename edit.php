<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<table>
	  <tr>
	    <td align="center">EDIT DATA</td>
	  </tr>
	  <tr>
	    <td>
	      <table border="1">
	      <?php
	      include"db.inc.php";//database connection
	      $order = "SELECT * FROM PRODUCT";
	      $result = mysql_query($order);
	      while ($row=mysql_fetch_array($result)){
	    echo ("<tr><td>$row[P_ID]</td>");
		echo ("<td>$row[P_NAME]</td>");
	    echo ("<td>$row[P_ARTIST]</td>");
        echo ("<td>$row[P_DESC]</td>");
		echo ("<td>$row[P_RELEASE_DATE]</td>");
		echo ("<td>$row[P_STOCK]</td>");
		echo ("<td>$row[P_PRICE]</td>");
		echo ("<td>$row[P_IMG_REF]</td>");
		echo ("<td>$row[P_AGE_RATING]</td>");
		echo ("<td>$row[P_TYPE]</td>");
		echo ("<td>$row[P_GENRE]</td>");
        echo ("<td><a href=\"edit_form.php?id=$row[P_ID]\">Edit</a></td></tr>");
	      }
	      ?>
	      </table>
	    </td>
	   </tr>
	</table>
	</body>
</html>