<?php
session_start();
	$counter_gal = $_POST['counter_gal'];
	//echo $_SESSION['aaa'.$counter_gal];
	if ( strlen($_SESSION['sess_cap'.$counter_gal]) && $_POST['key'] == $_SESSION['sess_cap'.$counter_gal] ) {
		echo "Valid";
	} else {
		echo "Wrong Captcha Code";
	}
?>