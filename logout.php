<?php require_once("../petvet/includes/session.php") ?>
<?php require_once("../petvet/includes/functions.php") ?>

<?php 
	$_SESSION["p_user_id"] = null;
	$_SESSION["p_username"] = null;
	redirect_to("login.php");
?>