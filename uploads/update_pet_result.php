<?php

	$petsid = $_POST["petid"];

	if(isset($_FILES['userfile']))
	{
		$targeturl = "../uploads/files/" . $petsid . "_result.pdf";
		move_uploaded_file($_FILES["userfile"]['tmp_name'], $targeturl);
	}

?>