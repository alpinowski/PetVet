<?php
require_once("includes/functions.php");

$query = $_REQUEST["query"];

$results[] = get_owner_names($query);

echo json_encode($results);
?>