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

	$privilegeID = $_REQUEST["privilegeID"];
    $aview = trim(mysql_prep($_REQUEST["viewsel"]));
    $ainsert = trim(mysql_prep($_REQUEST["insertsel"]));
    $aupdate = trim(mysql_prep($_REQUEST["updatesel"]));
    $adelete = trim(mysql_prep($_REQUEST["deletesel"]));
    $ap_name = trim(mysql_prep($_REQUEST["p_nametxt"]));

	$query = "UPDATE privilege SET
	view_p = '{$aview}',
	insert_p = '{$ainsert}',
	update_p = '{$aupdate}',
	delete_p = '{$adelete}',
	p_name = '{$ap_name}'
	WHERE ID = {$privilegeID};";

    if (mysqli_query($connection, $query))
    {
    	echo json_encode(array('status' => 'OK', 'message' => 'Data saved successfully!'));
    }
    else
    {
    	echo json_encode(array('status' => 'ERROR', 'message' => 'Please fix the errors!'));
    }
?>