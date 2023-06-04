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

	$userid = trim(mysql_prep($_REQUEST['userid']));

	if(isset($userid))
	{	
		$query = "SELECT s.ID, prefix, fullname, username, email, r_name, fk_role_id ";
		$query .= "FROM users AS s INNER JOIN role AS r ON r.ID=fk_role_id ";
		$query .= "WHERE s.ID = " . $userid . " LIMIT 1;";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		if ($found_data = mysqli_fetch_assoc($result_set))
		{
			echo json_encode(array(
				'status' => 'OK',
				'userid' => $found_data['ID'],
				'prefix' => $found_data['prefix'],
				'fullname' => $found_data['fullname'],
				'username' => $found_data['username'],
				'email' => $found_data['email'],
				'r_name' => $found_data['r_name'],
				'fk_role_id' => $found_data['fk_role_id']));
		}
	}
?>
