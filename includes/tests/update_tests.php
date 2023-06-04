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

	function test_exist($testid,$mtxt,$petid)
	{
		global $connection;

		$myquery = "SELECT ID FROM test WHERE ID != {$testid} AND barcode = '{$mtxt}' AND fk_pet_id = {$petid} LIMIT 1";

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

	$testID = $_REQUEST["testID"];
	$adate = trim(mysql_prep($_REQUEST["datedate"]));
    $avac_lab = trim(mysql_prep($_REQUEST["vac_labtxt"]));
	$abarcode = trim(mysql_prep($_REQUEST["barcodetxt"]));
    $anext_vac = trim(mysql_prep($_REQUEST["next_vacdate"]));
    $acategory = trim(mysql_prep($_REQUEST["categoryint"]));
    $petid = $_SESSION['pet_id'];

	if(!test_exist($testID, $abarcode, $petid))
	{
		$query = "UPDATE test SET
		t_date = '{$adate}',
    	vaccine_label = '{$avac_lab}',
    	barcode = '{$abarcode}',
    	next_vaccination = '{$anext_vac}',
    	fk_category_id = '{$acategory}'
    	WHERE ID = {$testID}
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