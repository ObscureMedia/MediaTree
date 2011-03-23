<?php 
include('mysql_connect.php');
?>

<<html>
	<?php include "cssImport.php"?>
	<body>
	
			<?php 
			include "header.php";
			?>
			<div id="content">
				<div id="ContentWrapper">
					<?php
						//	Use our session we set earlier to determine if we should inform
						//	the user that they've changed the data.  
						if ($_SESSION['EditConfirm']==True){
							echo "<p>You have successfully updated your details.</p>";
							unset($_SESSION['EditConfirm']);
						}
					?>
					<h1>Customer account options </h1>
					<ul>
						<li>View Customers	</li>
						<li>Remove Customer	</li>
						<li>Modify Customer	</li>
					</ul>
					
				</div>
			</div>
			<?php 
			include "footer.php";
			?>
	</body>
</html>