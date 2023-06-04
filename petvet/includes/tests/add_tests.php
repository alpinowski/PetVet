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

	function test_exist($mtxt, $petid)
	{
		global $connection;

		$myquery = "SELECT ID FROM test WHERE barcode = '{$mtxt}' AND fk_pet_id = {$petid} LIMIT 1";

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

	$adate = trim(mysql_prep($_REQUEST["datedate"]));
    $avac_lab = trim(mysql_prep($_REQUEST["vac_labtxt"]));
	$abarcode = trim(mysql_prep($_REQUEST["barcodetxt"]));
    $anext_vac = trim(mysql_prep($_REQUEST["next_vacdate"]));
    $users_id = 1;
    $petid = $_SESSION['pet_id'];
    $acategory = trim(mysql_prep($_REQUEST["categoryint"]));

	if(!test_exist($abarcode,$petid))
	{
		$query = "INSERT INTO test
		        (
		        	t_date, vaccine_label, barcode, next_vaccination, fk_users_id, fk_pet_id, fk_category_id
		        )
		        VALUES
		        (
		        	'{$adate}','{$avac_lab}','{$abarcode}','{$anext_vac}', {$users_id}, {$petid}, {$acategory}
		        );";

		        if (mysqli_query($connection, $query))
		        {
		        	echo json_encode(array('status' => 'OK', 'message' => 'Data saved successfullys!'));
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