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

	function class_exist($useID, $ftxt)
	{
		global $connection;

		$myquery = "SELECT ID
				FROM  users
				WHERE ID != " . $useID . " AND fullname LIKE '" . $ftxt . "' LIMIT 1";

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

	$userID = $_REQUEST["userID"];
	$aprefix = trim(mysql_prep($_REQUEST["prefixsel"]));
    $afullname = trim(mysql_prep($_REQUEST["fullnametxt"]));
    $ausername = trim(mysql_prep($_REQUEST["usernametxt"]));
    $apassword = trim(mysql_prep($_REQUEST["passwordtxt"]));
    $aemail = trim(mysql_prep($_REQUEST["emailtxt"]));
    $erole = trim(mysql_prep($_REQUEST["roleint"]));
	$hashed_password = sha1($apassword);

	if(!class_exist($userID, $afullname))
	{
		$query = "UPDATE users SET
		prefix = '{$aprefix}',
    	fullname = '{$afullname}',
    	username = '{$ausername}',
    	u_password = '{$hashed_password}',
    	email = '{$aemail}',
    	fk_role_id = {$erole}
    	WHERE ID = {$userID}
        ";

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