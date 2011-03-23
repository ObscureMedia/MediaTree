<?php
$page =$_GET['page'];
foreach(range('A', 'Z') as $letter) {
    $atoz[] =$letter;
}
$headings = array("Music Genre" => array("Rock", "Pop", "Dance", "Trance", "Rap", "Live"), "DVD Genre" => array("Horror", "Comedy", "Action", "Live", "TV-box set"), "AZ" => $atoz, "Price" => array("Under £5", "£5-10", "£10-£20", "£20+"));
echo "<div id=\"subMenu\">
	<ul class = \"submenubar\">
		<li class=\"header\">",$page,"</li>";
		foreach($headings as $eachheading){
			if ($eachheading == $headings["Music Genre"]){	
				if($page == "DVD"){
					echo   "<li class=\"submenu\">";
					echo "DVD Genre";
					echo "<ul class= \"submenuholder\">";
					foreach($headings['DVD Genre'] as $DvdGenre){
						echo   "<li class=\"submenuitem\">";			
						echo "<a href=",$_SERVER['PHP_SELF'],"?page=",$page,"&Subcat=",$DvdGenre,">",$DvdGenre,"</a>";
						echo "<br>";	
						echo    "</li>";
					}
					echo "</ul>";
				echo "</li>";	
				}
				if ($page =="CD" || $page =="Vinyl"){
					echo   "<li class=\"submenu\">";	
					echo "Music Genre";
					echo "<ul class= \"submenuholder\">";
					foreach ($headings['Music Genre'] as $MusicGenre){
						echo   "<li class=\"submenuitem\">";
						echo "<a href=",$_SERVER['PHP_SELF'],"?page=",$page,"&Subcat=",$MusicGenre,">",$MusicGenre, "</a>";
						echo "<br>";
						echo    "</li>";
					}
					echo    "</ul>";
				echo "</li>";	
				}		
			}
			if ($eachheading != $headings["Music Genre"] && $eachheading != $headings["DVD Genre"]){
				echo   "<li class=\"submenu\">";	
				echo array_search($eachheading, $headings);
				echo "<ul class= \"submenuholder\">";
				foreach ($eachheading as $eachsubheading){
					echo   "<li class=\"submenuitem\">";			
					echo "<a href=",$_SERVER['PHP_SELF'],"?page=",$page,"&Subcat=",$eachsubheading,">",$eachsubheading, "</a>";
					echo "<br>";
					echo    "</li>";	
				}	
				echo    "</ul>";					
			echo "</li>";
			}
		}



echo "</ul>
</div>";
?>