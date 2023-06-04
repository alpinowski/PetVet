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

	function user_exist($mtxt)
	{
		global $connection;

		$myquery = "SELECT ID FROM users WHERE fullname LIKE '" . $mtxt . "' LIMIT 1";

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

	$aprefix = trim(mysql_prep($_REQUEST["prefixsel"]));
    $afullname = trim(mysql_prep($_REQUEST["fullnametxt"]));
    $ausername = trim(mysql_prep($_REQUEST["usernametxt"]));
    $apassword = trim(mysql_prep($_REQUEST["passwordtxt"]));
    $aemail = trim(mysql_prep($_REQUEST["emailtxt"]));
    $arole = trim(mysql_prep($_REQUEST["roleint"]));
    $hashed_password = sha1($apassword);

	if(!user_exist($afullname))
	{
		$query = "INSERT INTO users
		        (
		        	prefix, fullname, username, u_password, email, fk_role_id
		        )
		        VALUES
		        (
		        	'{$aprefix}','{$afullname}','{$ausername}','{$hashed_password}','{$aemail}', {$arole}
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