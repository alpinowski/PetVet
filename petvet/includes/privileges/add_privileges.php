<?php
	require_once("../session.php");
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

	function privilege_exist($mtxt, $usr_id)
	{
		global $connection;

		$myquery = "SELECT ID FROM privilege WHERE fk_users_id = {$usr_id} AND p_name LIKE '" . $mtxt . "' LIMIT 1";

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

	$aview = trim(mysql_prep($_REQUEST["viewsel"]));
    $ainsert = trim(mysql_prep($_REQUEST["insertsel"]));
    $aupdate = trim(mysql_prep($_REQUEST["updatesel"]));
    $adelete = trim(mysql_prep($_REQUEST["deletesel"]));
    $ap_name = trim(mysql_prep($_REQUEST["p_nametxt"]));
    $user_id = $_SESSION['user_id'];

	if(!privilege_exist($ap_name, $user_id))
	{
		$query = "INSERT INTO privilege
		        (
		        	view_p, insert_p, update_p, delete_p, p_name, fk_users_id
		        )
		        VALUES
		        (
		        	'{$aview}','{$ainsert}','{$aupdate}','{$adelete}','{$ap_name}', {$user_id}
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