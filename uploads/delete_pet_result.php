<?php

	require_once("../includes/connection.php");

	function mysql_prep( $value )
	{
		$value = mysqli_real_escape_string($GLOBALS['mysqli'], $value);
		return $value;
	}

	function confirm_query($result_set)
	{
		global $connection;
		if (!$result_set)
		{
			die("Database query failed: " . mysqli_error($connection));
		}
	}

	$petid = $_POST["petid"];

	if(isset($petid))
	{
		$fp = "../uploads/files/".$petid."_result.pdf";
    	fclose($fp);
    	unlink($fp);
	}

?>