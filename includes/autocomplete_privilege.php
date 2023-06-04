<?php

	require_once("connection.php");

	if(isset($_REQUEST["query"]))
	{
		$myquery = "SELECT username FROM users WHERE username LIKE '" . $_REQUEST["query"] . "%' ORDER BY username";

	    $result = mysqli_query($connection, $myquery);

	    $results = array();

	    if (!$result)
	    {
	        die("Database query failed: " . mysqli_error($connection));
	    }

	    if(mysqli_num_rows($result) > 0)
	    {
	       while($row = mysqli_fetch_array($result))
	       {
	            $results[] = array("value" => $row["username"]);
	       }
	    }
	    else
	    {
	       $results[] = array("value" => "Data not found");
	    }
	}

	echo json_encode($results);
?>