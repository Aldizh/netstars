<?php
	include ("config.php");
	include("includes/header.php");

	$config = new Config();
	$connection = $config->connect("209.200.231.164", "ciaot1", "mSaKSeZXt0TK");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}


	//Upgrading to Personal Status
	$sql_read = "SELECT * FROM `customers` WHERE membership_type like 'partner'";
	$result = mysql_query($sql_read);
	if ($result == false){die(var_dump(mysql_error()));}
	while($row = mysql_fetch_assoc($result)){
		$id = $row["ID"];
		if ($row["creditbalance"] >= 350){
			$new_balance = (int)$row["creditbalance"] - 350;
			$sql_update = "UPDATE `ciaot1_netex`.`customers` SET `membership_type` = 'personal', `creditbalance` = '$new_balance' WHERE `customers`.`ID` = '$id';";
			$result_update = mysql_query($sql_update);
			if ($result_update == false){die(var_dump(mysql_error()));}
		}        
	}

	//Taking care of president status
	$sql_read = "SELECT * FROM `customers` WHERE membership_type like 'business' or membership_type like 'president'";
	$result = mysql_query($sql_read);
	if ($result == false){die(var_dump(mysql_error()));}
	$row = mysql_fetch_assoc($result);
	$id = $row["ID"];

	$sql_read_enrollee = "SELECT count(*), ID, type FROM `enrollees` WHERE enroller_ID like '$id' and type like 'business' or type like 'president'";
	$result_enrollee = mysql_query($sql_read_enrollee);
	if ($result_enrollee == false){die(var_dump(mysql_error()));}
	$row_enrollee = mysql_fetch_assoc($result_enrollee);
	if ($row_enrollee["count(*)"] >= 5){
		$sql_update = "UPDATE `ciaot1_netex`.`customers` SET `membership_type` = 'president' WHERE ID like '$id';";
		$result_update = mysql_query($sql_update);
		if ($result_update == false){die(var_dump(mysql_error()));}
	}
	else{
		$sql_update = "UPDATE `ciaot1_netex`.`customers` SET `membership_type` = 'business' WHERE ID like '$id';";
		$result_update = mysql_query($sql_update);
		if ($result_update == false){die(var_dump(mysql_error()));}
	}

	/**************** BONUSES *****************************/
	// Credit Enroller Bonus
	//script for calculating enroller bonus
	$creditAmount = 0;
	$commission = 0;
	
	//assume we have the $id
	$sql_read = "SELECT * FROM `customers` WHERE ID like '$_GET[id]'";
	$result = mysql_query($sql_read);
	if ($result == false){die(var_dump(mysql_error()));}
	$row = mysql_fetch_assoc($result);
	if ($row["membership_type"] == "partner"){
		die("Not qualified for bonus");
	}
	if ($row["membership_type"] == "personal"){
		$creditAmount = 0.02*300;
		$commission = 20;
	}
	else if ($row["membership_type"] == "business"){
		$creditAmount = 0.02*1500;
		$commission = 100;
	}
	$sql_read = "SELECT * FROM `customers` WHERE ID like '$row[enroller_ID]'";
	$result = mysql_query($sql_read);
	if ($result == false){die(var_dump(mysql_error()));}
	$row = mysql_fetch_assoc($result);
	$cashbalance = $row["cashbalance"];
	$creditbalance = $row["creditbalance"];
	if ($row["membership_type"]){
		if ($row["membership_type"] == "partner"){
			$creditbalance += $creditAmount;
			$sql_update = "UPDATE `ciaot1_netex`.`customers` SET `creditbalance` = '$creditbalance' WHERE ID like '$row[ID]';";
			$result_update = mysql_query($sql_update);
			if ($result_update == false){die(var_dump(mysql_error()));}
		}
		else{
			$cashbalance += $commission;
			$sql_update = "UPDATE `ciaot1_netex`.`customers` SET `cashbalance` = '$cashbalance' WHERE ID like '$row[ID]';";
			$result_update = mysql_query($sql_update);
			if ($result_update == false){die(var_dump(mysql_error()));}
		}
	}

?>