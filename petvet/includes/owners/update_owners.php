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

	function class_exist($ownID, $ftxt)
	{
		global $connection;

		$myquery = "SELECT ID
				FROM  owners
				WHERE ID != " . $ownID . " AND fullname LIKE '" . $ftxt . "' LIMIT 1";

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

	$ownerID = $_REQUEST["ownerID"];
	$aprefix = trim(mysql_prep($_REQUEST["prefixtxt"]));
    $afullname = trim(mysql_prep($_REQUEST["fullnametxt"]));
    $amobile = trim(mysql_prep($_REQUEST["mobiletxt"]));
    $aemail = trim(mysql_prep($_REQUEST["emailtxt"]));
    $adescription = trim(mysql_prep($_REQUEST["desctxt"]));
    $aaddress = trim(mysql_prep($_REQUEST["addresstxt"]));

	if(!class_exist($ownerID, $afullname))
	{
		$query = "UPDATE owners SET
					prefix = '{$aprefix}',
		        	fullname = '{$afullname}',
		        	mobile = '{$amobile}',
		        	email = '{$aemail}',
		        	address = '{$aaddress}',
		        	description = '{$adescription}'
		        	WHERE ID = {$ownerID}
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