
<div id="content">
	<div id="ContentWrapper">
		<?php
		if (isset($_GET["page"])){
								//find period, find all letters following (from 0 to infinite)
			$page= preg_replace("(\.\w{0,})", "", $_GET["page"]);
			if ($page == "CD" || $page == "Vinyl" || $page == "DVD"){
				include "subMenu.php";
				include "Browse.php";
			}
			if (file_exists("$page.php")){
				include ("$page.php");	
			}
			else {
				include ("404.php");	
			}
		}
		?>
	</div>
</div>