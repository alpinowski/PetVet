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

	function category_exist($mtxt)
	{
		global $connection;

		$myquery = "SELECT ID FROM  category WHERE c_name LIKE '" . $mtxt . "' LIMIT 1";

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

    $aname = trim(mysql_prep($_REQUEST["nametxt"]));
    $adescription = trim(mysql_prep($_REQUEST["desctxt"]));

	if(!category_exist($aname))
	{
		$query = "INSERT INTO category
		        (
		        	c_name,description
		        )
		        VALUES
		        (
		        	'{$aname}','{$adescription}'
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