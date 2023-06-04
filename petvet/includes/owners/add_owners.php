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

	function owner_exist($mtxt)
	{
		global $connection;

		$myquery = "SELECT ID
				FROM  owners
				WHERE fullname LIKE '" . $mtxt . "' LIMIT 1";

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

	$aprefix = trim(mysql_prep($_REQUEST["prefixtxt"]));
    $afullname = trim(mysql_prep($_REQUEST["fullnametxt"]));
    $aemail = trim(mysql_prep($_REQUEST["emailtxt"]));
    $amobile = trim(mysql_prep($_REQUEST["mobiletxt"]));
    $adescription = trim(mysql_prep($_REQUEST["desctxt"]));
    $aaddress = trim(mysql_prep($_REQUEST["addresstxt"]));

	if(!owner_exist($afullname))
	{
		$query = "INSERT INTO owners
		        (
		        	prefix,fullname,email,mobile,address,description
		        )
		        VALUES
		        (
		        	'{$aprefix}','{$afullname}','{$aemail}','{$amobile}','{$aaddress}','{$adescription}'
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