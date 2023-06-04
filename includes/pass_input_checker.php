<?php
	require_once("session.php");
	require_once("connection.php");
	// require_once("grobot.php");
	
	// $secret = "6LfNGzAUAAAAAE0WXeUTgOTtFLCJqHldaNcMCWCS";
	
	// $response = null;
	
	// $reCaptcha = new ReCaptcha($secret);
	
	// if (isset($_REQUEST['robottxt']))
	// {
 //    		$response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_REQUEST['robottxt']);
	// }

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

	function class_exist($userID)
	{
		global $connection;

		$myquery = "SELECT ID FROM users WHERE ID = " . $userID . " LIMIT 1";

		$result = mysqli_query($connection, $myquery);

		confirm_query($result);

		if ($res = mysqli_fetch_assoc($result)) { return true; } else { return false; }
	}

	$userID = $_SESSION['p_user_id'];
    $npassword = trim(mysql_prep($_REQUEST['npasstxt']));
	$hashed_password = sha1($npassword);

	if(class_exist($userID))
	{
		$query = "UPDATE users SET u_password = '{$hashed_password}' WHERE ID = {$userID};";

        if (mysqli_query($connection, $query))
        {
        	$_SESSION["p_user_id"] = null;
			$_SESSION["p_username"] = null;
        	echo json_encode(array('status' => 'OK', 'message' => 'Password changed successfully!'));
        }
        else
        {
        	echo json_encode(array('status' => 'ERROR', 'message' => 'Please fix the errors!'));
        }
	}
	else
	{
		echo json_encode(array('status' => 'ERROR', 'message' => 'User does not exist!'));
	}
?>