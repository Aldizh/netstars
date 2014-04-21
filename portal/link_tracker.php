<?php
	ob_start();
	session_start();
	include("../includes-in/header.php");
	include("../config.php");
	$config = new Config();
	$connection = $config->connect("localhost", "NetStar", "kRJd7tW3PLc3m4");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}
	if ($_GET["clicked"] == "true"){
		$sql_read = "SELECT * FROM `customers` WHERE ID like '$_SESSION[id]'";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_row($result);
		$clicks = (int)$row[26] + 1;
		$sql_update = "UPDATE `ciaot1_netex`.`customers` SET `numberofclicks` = '$clicks' WHERE `customers`.`ID` = '$row[0]';";
		$result_update = mysql_query($sql_update);
		if ($result_update == false){die(var_dump(mysql_error()));}
		header("Location: ../index.php");
	}
 ?>

 <?include("../includes-in/footer.php"); ?>
