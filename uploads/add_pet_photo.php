<?php

	require_once("../includes/session.php");
	require_once("../includes/connection.php");

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

	function get_pet_id($petname,$ownid)
	{
		global $connection;

		$myquery = "SELECT ID FROM pet WHERE p_name = '{$petname}' and fk_owners_id={$ownid} LIMIT 1";

		$result = mysqli_query($connection, $myquery);

		confirm_query($result);

		if ($res = mysqli_fetch_assoc($result))
		{
			return $res['ID'];
		}
		else
		{
			return 0;
		}
	}

	$petname = $_POST["petname"];
	$ownerid = $_SESSION['owner_id'];

	if(isset($_FILES['userfile']))
	{
		$petid=get_pet_id($petname,$ownerid);
		$targeturl = "../petvet/uploads/photos/" . $petid . ".jpg";

		if(move_uploaded_file($_FILES["userfile"]['tmp_name'], "../uploads/photos/" . $petid . ".jpg"))
		{
			$query = "UPDATE pet SET photo = '{$targeturl}' WHERE ID = {$petid}";

		    mysqli_query($connection, $query);
		}
	}

?>