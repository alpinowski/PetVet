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

	$petid = trim(mysql_prep($_REQUEST['petid']));

	if(isset($petid))
	{
		$query = "SELECT ID, p_name, birthdate, photo, gender, species, breed, coat_color, rabies, result, microchip_number, microchip_date, reference_lab, health_certificate ";
		$query .= "FROM pet WHERE ID = " . $petid . " LIMIT 1;";


		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		if ($found_data = mysqli_fetch_assoc($result_set))
		{
			echo json_encode(array(
				'status' => 'OK',
				'petid' => $found_data['ID'],
				'p_name' => $found_data['p_name'],
				'birthdate' => $found_data['birthdate'],
				'photo' => $found_data['photo'],
				'gender' => $found_data['gender'],
				'species' => $found_data['species'],
				'breed' => $found_data['breed'],
				'rabies' => $found_data['rabies'],
				'result' => $found_data['result'],
				'coat_color' => $found_data['coat_color'],
				'microchip_number' => $found_data['microchip_number'],
				'microchip_date' => $found_data['microchip_date'],
				'reference_lab' => $found_data['reference_lab'],
				'health_certificate' => $found_data['health_certificate']
			));
		}
	}
?>
