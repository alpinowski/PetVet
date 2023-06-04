<?php

	$petsid = $_POST["petid"];

	if(isset($_FILES['userfile']))
	{
		$targeturl = "../uploads/photos/" . $petsid . ".jpg";
		move_uploaded_file($_FILES["userfile"]['tmp_name'], $targeturl);
	}

?>