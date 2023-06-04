<?php

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


	if(isset($_REQUEST['usertxt']) && isset($_REQUEST['passtxt'])) {

		// if ($response != null && $response->success)
		// {
			$username = trim(mysql_prep($_REQUEST['usertxt']));
			$password = trim(mysql_prep($_REQUEST['passtxt']));
			$hashed_password = sha1($password);
	
			$query = "SELECT ID, username, u_password FROM users WHERE username = '{$username}' ";
			$query .= "AND u_password = '{$hashed_password}' LIMIT 1";
	
			$result_set = mysqli_query($connection, $query);
			confirm_query($result_set);
			
			if (mysqli_affected_rows($connection) == 1)
			{
				$found_user = mysqli_fetch_assoc($result_set);
	
				session_start();
				
				$_SESSION['p_user_id'] = $found_user['ID'];
				$_SESSION['p_username'] = $found_user['username'];
				
				echo json_encode(array('status' => 'OK'));
			}
			else
			{
				echo json_encode(array('status' => 'ERROR'));
			}
		// }
		// else
		// {
		// 	echo json_encode(array('status' => 'ERROR'));
		// }
	}
?>