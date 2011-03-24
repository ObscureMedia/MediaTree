<?php 
	function emailValid($str){		
		$cStr = mysql_real_escape_string($str);
		$name = "/^[-!~$%&\'*+\\.\\/0-9=?A-Z^_`{|}~]+";
		$host = "([-0-9A-Z]+\.)+";
		$tlds = "([0-9A-Z]){2,4}$/i";
		
		if((!$cStr)){
			return false;
		}else if(trim($cStr) == null || trim($cStr) == ""){
			return false;
		}else if(!preg_match($name."@".$host.$tlds,$cStr)){
			return false;
		}else{
			return true;
		}
	}
	
	function pwdValid($str){
		$cStr = mysql_real_escape_string($str);
		if((!$cStr)){
			return false;
		}else if(trim($cStr) == null || trim($cStr) == ""){
			return false;
		}else{
			return true;
		}
	}
?>