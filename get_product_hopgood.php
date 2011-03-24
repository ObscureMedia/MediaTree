<html>

<head> <title>View and Delete Product</title> 

	<script type="text/javascript">
		function valid(){
			var answer= confirm("Are you sure you want to delete?");
			
			if (answer){
				return true;
			}
			return false;
		}
	</script>

</head>
<body>
<!-- This calls the delete_hopgood.php and posts -->

<?php
		//Connects to the mysql server through, the serve, username and password, if it doesn't kill the program and throws the could not connect error.
		$conn = @mysql_connect("dec20","group18","able7prime7")
		or die ( "Could not connect ");
		//Selects the database in () if it can not connect it kills the connection
		$rs = @mysql_select_db("group18") 
		or die ( "Could not select database" );
		//sql query to select all of the values from the product table and order it by the product name, this is to make it easier for the admin
		$sql = "select * from group18.PRODUCT ORDER BY P_ID";
		// $rs  checks the connection and then runs the $sql query, if it does not execute it kills the connection and throws the could not execute query.
		$rs = mysql_query ( $sql, $conn ) 
		or die ( "Could not execute query" );
		//Creates a table with the headers, product id, product name, product artist, product description, product release date, product stock, product price, product image reference, product age rating, product tpye and product genre
		$list = "<table border=\"1\" cellpadding=\"2\">";
		$list .= "<tr><th class='productHeader'>Product ID</th>";
		$list .= "<th class='productHeader'>Product Name</th>";
		$list .= "<th class='productHeader'>Product Artist</th>";
		$list .= "<th class='productHeader'>Product Description</th>";
		$list .= "<th class='productHeader'>Product Release Date</th>";
		$list .= "<th class='productHeader'>Product Stock</th>";
		$list .= "<th class='productHeader'>Product Price</th>";
		$list .= "<th class='productHeader'>Product Image Reference</th>";
		$list .= "<th class='productHeader'>Product Age Rating</th>";
		$list .= "<th class='productHeader'>Product Type</th>";
		$list .= "<th class='productHeader'>Product Genre</th>";
		$list .= "<th class='productHeader'>Edit Product</th>";
		$list .= "<th class='productHeader'>Delete Product</th></tr>";
	
	
		
		//While there is a row in the mysql table prints values into a row in the table created above
		while ( $row = mysql_fetch_array( $rs ) )
		{ 
			$list .= "<tr class='productRow'>";
			$list .= "<td class='productValue'>".$row ["P_ID"]."</td>";
			$list .= "<td class='productValue'>".$row ["P_NAME"]."</td>";
			$list .= "<td class='productValue'>".$row ["P_ARTIST"]."</td>";
			$list .= "<td class='productValue'>".$row ["P_DESC"]."</td>";
			$list .= "<td class='productValue'>".$row ["P_RELEASE_DATE"]."</td>";
			$list .= "<td class='productValue'>".$row ["P_STOCK"]."</td>";
			$list .= "<td class='productValue'>".$row ["P_PRICE"]."</td>";
			$list .= "<td class='productValue'>".$row ["P_IMG_REF"]."</td>";
			$list .= "<td class='productValue'>".$row ["P_AGE_RATING"]."</td>";
			$list .= "<td class='productValue'>".$row ["P_TYPE"]."</td>";
			$list .= "<td class='productValue'>".$row ["P_GENRE"]."</td>";
			$list .= "<td class='productValue'><a href=\"edit_form.php?id=$row[P_ID]\">Edit</a></td>";
			$list .= "<td class='productValue'><a href=\"delete_hopgood.php?id=$row[P_ID]\">Delete</a></td>";
			$list .= "</tr>";		
		}
		$list.= "</table>";
		//Prints out $list, which is the table
		echo ( $list ) ;
		//Close my_sql to ensure securitys
		mysql_close();
	?>
	</body>
</html>	