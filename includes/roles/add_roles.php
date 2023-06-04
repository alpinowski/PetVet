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

	function role_exist($mtxt)
	{
		global $connection;

		$myquery = "SELECT ID FROM  role WHERE r_name LIKE '" . $mtxt . "' LIMIT 1";

				$result = mysqli_query($connection, $myquery);

				confirm_query($result);

				if ($res = mysqli_fetch_assoc($result))
				{
					return true;
				}
				else
				{
					return false;
				}
	}

    $ar_name = trim(mysql_prep($_REQUEST["nametxt"]));

	if(!role_exist($ar_name))
	{
		$query = "INSERT INTO role
		        (
		        	r_name
		        )
		        VALUES
		        (
		        	'{$ar_name}'
		        )";

		        if (mysqli_query($connection, $query))
		        {
		        	echo json_encode(array('status' => 'OK', 'message' => 'Data saved successfully!'));
		        }
		        else
		        {
		        	echo json_encode(array('status' => 'ERROR', 'message' => 'Please fix the errors!'));
		        }

	}
	else
	{
		echo json_encode(array('status' => 'ERROR', 'message' => 'Data already exist!'));
	}
?>