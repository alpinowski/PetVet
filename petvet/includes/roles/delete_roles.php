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


	$roleID = trim(mysql_prep($_REQUEST['roleid']));

	if(isset($roleID))
	{
		$query = "DELETE FROM role WHERE ID = {$roleID};";

        if (mysqli_query($connection, $query))
        {
        	echo json_encode(array('status' => 'OK', 'message' => 'Data deleted successfully!'));
        }
        else
        {
        	echo json_encode(array('status' => 'ERROR', 'message' => 'Please fix the errors!'));
        }
	}
	else
    {
    	echo json_encode(array('status' => 'ERROR', 'message' => 'Please fix the errors!'));
    }
?>
