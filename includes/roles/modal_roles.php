<?php

	require_once("../connection.php");

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

	$roleid = trim(mysql_prep($_REQUEST['roleid']));

	if(isset($roleid))
	{
		$query = "SELECT ID, r_name FROM role WHERE ID = " . $roleid . " LIMIT 1;";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		if ($found_data = mysqli_fetch_assoc($result_set))
		{
			echo json_encode(array(
				'status' => 'OK',
				'roleid' => $found_data['ID'],
				'r_name' => $found_data['r_name']));
		}
	}
?>
