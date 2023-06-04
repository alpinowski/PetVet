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

	$testid = trim(mysql_prep($_REQUEST['testid']));

	if(isset($testid))
	{
		$query = "SELECT t_date, vaccine_label, barcode, next_vaccination, c_name, fk_category_id FROM test AS t INNER JOIN category AS c ON c.ID=fk_category_id WHERE t.ID = " . $testid . " LIMIT 1;";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		if ($found_data = mysqli_fetch_assoc($result_set))
		{
			echo json_encode(array(
				'status' => 'OK',
				't_date' => $found_data['t_date'],
				'vaccine_label' => $found_data['vaccine_label'],
				'barcode' => $found_data['barcode'],
				'next_vaccination' => $found_data['next_vaccination'],
				'c_name' => $found_data['c_name'],
				'fk_category_id' => $found_data['fk_category_id']

			));
		}
	}
	/*
				'fk_users_id' => $found_data['fk_users_id'],
				'fk_pet_id' => $found_data['fk_pet_id'],
				'fk_category_id' => $found_data['fk_category_id'],*/
?>
