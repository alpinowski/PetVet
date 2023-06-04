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

	$privilegeid = trim(mysql_prep($_REQUEST['privilegeid']));

	if(isset($privilegeid))
	{
		$query = "SELECT ID, view_p, insert_p, update_p, delete_p, p_name FROM privilege WHERE ID = " . $privilegeid . " LIMIT 1;";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		if ($found_data = mysqli_fetch_assoc($result_set))
		{
			echo json_encode(array(
				'status' => 'OK',
				'view' => $found_data['view_p'],
				'insert' => $found_data['insert_p'],
				'update' => $found_data['update_p'],
				'delete' => $found_data['delete_p'],
				'p_name' => $found_data['p_name']
			));
		}
	}
?>
