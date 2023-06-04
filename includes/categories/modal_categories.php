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

	$categoryid = trim(mysql_prep($_REQUEST['categoryid']));

	if(isset($categoryid))
	{
		$query = "SELECT ID, c_name, description ";
		$query .= "FROM category ";
		$query .= "WHERE ID = " . $categoryid . " ";
		$query .= "LIMIT 1";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		if ($found_data = mysqli_fetch_assoc($result_set))
		{
			echo json_encode(array(
				'status' => 'OK',
				'categoryid' => $found_data['ID'],
				'c_name' => $found_data['c_name'],
				'description' => $found_data['description']));
		}
	}
?>
