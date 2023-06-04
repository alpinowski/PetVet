<?php

	require_once("../includes/session.php");
	require_once("../includes/connection.php");

	function mysql_prep( $value )
	{
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0

		if( $new_enough_php )
		{ // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active )
			{
				$value = stripslashes( $value );
			}
			$value = mysql_real_escape_string( $value );
		}
		else
		{ // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active )
			{
				$value = addslashes( $value );
			}
			// if magic quotes are active, then the slashes already exist
		}
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
		$targeturl = "../petvet/uploads/files/" . $petid . "_rabies.pdf";

		if(move_uploaded_file($_FILES["userfile"]['tmp_name'], "../uploads/files/" . $petid . "_rabies.pdf"))
		{
			$query = "UPDATE pet SET rabies = '{$targeturl}' WHERE ID = {$petid}";

		    mysqli_query($connection, $query);
		}
	}

?>