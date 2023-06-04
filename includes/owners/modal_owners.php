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

	$ownerid = trim(mysql_prep($_REQUEST['ownerid']));

	if(isset($ownerid))
	{
		$query = "SELECT ID, prefix, fullname, email, mobile, address, description ";
		$query .= "FROM owners WHERE ID = " . $ownerid . " LIMIT 1";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		if ($found_data = mysqli_fetch_assoc($result_set))
		{
			echo json_encode(array('status' => 'OK', 'ownerid' => $found_data['ID'], 'prefix' => $found_data['prefix'], 'fullname' => $found_data['fullname'], 'email' => $found_data['email'], 'mobile' => $found_data['mobile'], 'address' => $found_data['address'], 'description' => $found_data['description']));
		}
	}
?>
