<?php
	// This file is the place to store all basic functions

	function mysql_prep( $value )
	{
		$value = mysqli_real_escape_string($GLOBALS['mysqli'], $value);
		return $value;
	}

	function redirect_to( $location = NULL )
	{
		if ($location != NULL)
		{
			header("Location: {$location}");
			exit;
		}
	}

	function confirm_query($result_set)
	{
		global $connection;
		if (!$result_set)
		{
			die("Database query failed: " . mysqli_error($connection));
		}
	}

	//============================================================================================

	global $tab_num;

	function get_crud_by_user_id($user_id, $page_name)
	{
		global $connection;

		$add = 'No';
		$ins = 'No';
		$del = 'No';
		$upd = 'No';

		$query = "SELECT view_p, insert_p, update_p, delete_p, p_name, fk_users_id ";
		$query .= "FROM privilege WHERE fk_users_id = {$user_id} AND p_name = '{$page_name}' LIMIT 1";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function get_pets_by_owner_id($ownid)
	{
		global $connection;

		$query = "SELECT ID, p_name, birthdate, gender, species, breed, coat_color, inserted_date FROM pet ";
		$query .= "WHERE fk_owners_id = {$ownid} ORDER BY p_name;";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function get_tests_by_owner_id($ownid)
	{
		global $connection;

		$query = "SELECT o.fullname AS ofname, mobile, p_name, species, t_date, c_name, u.fullname AS ufname ";
		$query .= "FROM test AS t INNER JOIN pet AS p ON t.fk_pet_id=p.ID INNER JOIN owners AS o ON p.fk_owners_id=o.ID ";
		$query .= "INNER JOIN users AS u ON t.fk_users_id=u.ID INNER JOIN category AS c ON t.fk_category_id=c.ID ";
		$query .= "WHERE p.fk_owners_id = {$ownid} ORDER BY o.fullname;";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function get_tests_by_pet_id($petid)
	{
		global $connection;

		$query = "SELECT ID, t_date, vaccine_label, barcode, next_vaccination FROM test ";
		$query .= "WHERE fk_pet_id = {$petid} ORDER BY vaccine_label;";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function get_privileges_by_user_id($userid)
	{
		global $connection;

		$query = "SELECT ID, view_p, insert_p, update_p, delete_p, p_name ";
		$query .= "FROM privilege WHERE fk_users_id = {$userid} ORDER BY p_name;";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function get_owner_id($own_id)
	{
		global $connection;

		$myquery = "SELECT ID, fullname FROM owners WHERE fullname LIKE '" . $own_id . "' LIMIT 1";

		$result = mysqli_query($connection, $myquery);
		confirm_query($result);

		if ($res = mysqli_fetch_assoc($result)) { return $res['ID']; }
		else { return 0; }
	}

	function get_user_id($use_id)
	{
		global $connection;

		$myquery = "SELECT ID, username FROM users WHERE username LIKE '" . $use_id . "' LIMIT 1";

		$result = mysqli_query($connection, $myquery);
		confirm_query($result);

		if ($res = mysqli_fetch_assoc($result)) { return $res['ID']; }
		else { return 0; }
	}

	function get_pet_id($pet_id)
	{
		global $connection;

		$myquery = "SELECT ID, p_name FROM pet WHERE p_name LIKE '" . $pet_id . "' LIMIT 1";

		$result = mysqli_query($connection, $myquery);
		confirm_query($result);

		if ($res = mysqli_fetch_assoc($result)) { return $res['ID']; }
		else { return 0; }
	}

	function get_owners()
	{
		global $connection;

		$query = "SELECT ID, prefix, fullname, mobile, email, address, description ";
		$query .= "FROM owners ";
		$query .= "ORDER BY fullname ";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function get_categories()
	{
		global $connection;

		$query = "SELECT ID, c_name, description ";
		$query .= "FROM category ";
		$query .= "ORDER BY c_name ";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function get_users()
	{
		global $connection;

		$query = "SELECT s.ID, prefix, fullname, username, email, r_name ";
		$query .= "FROM users AS s INNER JOIN role AS r ON r.ID=fk_role_id ";
		$query .= "ORDER BY fullname ";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function get_roles()
	{
		global $connection;

		$query = "SELECT ID, r_name FROM role ORDER BY ID ";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function get_tests()
	{
		global $connection;

		$query = "SELECT t_date, vaccine_label, barcode, next_vaccination, c_name, p_name, species,gender,o.fullname AS ofname,mobile,u.fullname AS ufname ";
		$query .= "FROM test AS t INNER JOIN pet AS p ON t.fk_pet_id=p.ID INNER JOIN owners AS o ON p.fk_owners_id=o.ID ";
		$query .= "INNER JOIN users AS u ON t.fk_users_id=u.ID INNER JOIN category AS c ON t.fk_category_id=c.ID";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function get_next_vacs()
	{
		global $connection;

		$query = "SELECT next_vaccination, c_name, p_name, species,gender,o.fullname AS ofname,mobile,u.fullname AS ufname ";
		$query .= "FROM test AS t INNER JOIN pet AS p ON t.fk_pet_id=p.ID INNER JOIN owners AS o ON p.fk_owners_id=o.ID ";
		$query .= "INNER JOIN users AS u ON t.fk_users_id=u.ID INNER JOIN category AS c ON t.fk_category_id=c.ID";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function get_next_vacs_by_dates($fdate, $sdate)
	{
		global $connection;

		$query = "SELECT next_vaccination, c_name, p_name, species,gender,o.fullname AS ofname,mobile,u.fullname AS ufname ";
		$query .= "FROM test AS t INNER JOIN pet AS p ON t.fk_pet_id=p.ID INNER JOIN owners AS o ON p.fk_owners_id=o.ID ";
		$query .= "INNER JOIN users AS u ON t.fk_users_id=u.ID INNER JOIN category AS c ON t.fk_category_id=c.ID ";
		$query .= "WHERE next_vaccination between '" . $fdate . "' and '" . $sdate . "'";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function get_next_vacs_by_current_month()
	{
		global $connection;

		$query = "SELECT p_name, species, next_vaccination ";
		$query .= "FROM test AS t INNER JOIN pet AS p ON fk_pet_id=p.ID ";
		$query .= "WHERE MONTH(next_vaccination) = MONTH(CURRENT_DATE()) AND YEAR(next_vaccination) = YEAR(CURRENT_DATE())";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function get_next_vacs_by_last_month()
	{
		global $connection;

		$query = "SELECT p_name, species, next_vaccination ";
		$query .= "FROM test AS t INNER JOIN pet AS p ON fk_pet_id=p.ID ";
		$query .= "WHERE MONTH(next_vaccination) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) ";
		$query .= "AND YEAR(next_vaccination) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function count_owners()
	{
		global $connection;

		$query = "SELECT COUNT(ID) AS c FROM owners;; ";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function count_pets()
	{
		global $connection;

		$query = "SELECT COUNT(ID) AS c FROM pet; ";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function count_tests()
	{
		global $connection;

		$query = "SELECT COUNT(ID) AS c FROM test; ";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function logged_in() { return isset($_SESSION['p_user_id']); }

	function confirm_logged_in() { if (!logged_in()) { redirect_to("login.php"); } }
?>