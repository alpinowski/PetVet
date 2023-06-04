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

	function pet_exist($petid,$mtxt,$ownid)
	{
		global $connection;

		$myquery = "SELECT ID FROM pet WHERE ID != {$petid} AND p_name = '{$mtxt}' AND fk_owners_id = {$ownid} LIMIT 1";

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

	$petID = $_REQUEST["petID"];
	$ap_name = trim(mysql_prep($_REQUEST["p_nametxt"]));
    $abirthdate = trim(mysql_prep($_REQUEST["birthdatedate"]));
    $agender = trim(mysql_prep($_REQUEST["gendersel"]));
    $aspecies = trim(mysql_prep($_REQUEST["speciestxt"]));
    $abreed = trim(mysql_prep($_REQUEST["breedtxt"]));
    $acoat_color = trim(mysql_prep($_REQUEST["coat_colortxt"]));
    $amicro_num = trim((int) $_REQUEST["micro_numtxt"]);
    $amicro_date = trim(mysql_prep($_REQUEST["micro_datedate"]));
    $aref_lab = trim(mysql_prep($_REQUEST["ref_labtxt"]));
    $ahealth_cer = trim(mysql_prep($_REQUEST["health_certxt"]));
    $ownerid = $_SESSION['owner_id'];

	if(!pet_exist($petID, $ap_name, $ownerid))
	{
		$query = "UPDATE pet SET
		p_name = '{$ap_name}',
    	birthdate = '{$abirthdate}',
    	gender = '{$agender}',
    	species = '{$aspecies}',
    	breed = '{$abreed}',
    	coat_color = '{$acoat_color}',
    	microchip_number = {$amicro_num},
    	microchip_date = '{$amicro_date}',
    	reference_lab = '{$aref_lab}',
    	health_certificate = '{$ahealth_cer}'
    	WHERE ID = {$petID}
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