<?php

	require_once("connection.php");

	if(isset($_REQUEST["query"]))
	{
		$myquery = "SELECT fullname FROM owners WHERE fullname LIKE '" . $_REQUEST["query"] . "%' ORDER BY fullname";

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
	            $results[] = array("value" => $row["fullname"]);
	       }
	    }
	    else
	    {
	       $results[] = array("value" => "Data not found");
	    }
	}

	echo json_encode($results);
?>