<?php
	ob_start();
	session_start(); 
	include("../includes-in/header.php");
	include("../config.php");

	if ($_SESSION["admin"] != true){
		header("Location: ../index.php"); 
	}
	$config = new Config();
	$connection = $config->connect("localhost", "NetStar", "G62267Fd8OX277z");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}

	$sql_read = "SELECT * FROM `customers` WHERE status like 'pending'";
	$result = mysql_query($sql_read);
	if ($result == false){die(var_dump(mysql_error()));}

	if (isset($_GET["activate"]) and $_GET["activate"] == "true"){
		$sql_update = "UPDATE `ciaot1_netex`.`customers` SET `status` = 'active' WHERE `customers`.`ID` = '$_GET[id]';";
		$result_update = mysql_query($sql_update);
		if ($result_update == false){die(var_dump(mysql_error()));}

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
			$creditAmount = 0.02*1400;
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

		// Script for Binary Bonus Calculation
		

		header("Location: pending_approvals.php"); 
	}
?>

<div class="row">
	<section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<table class="table table-bordered tree-table">
		  <tr>
			  <td>ID</td>
			  <td>Status</td>
			  <td>Action</td>
		  </tr>
		  <? while($row=mysql_fetch_array($result)) {?>
		  <tr>
			  <td><?=$row[0]?></td>
			  <td><?=$row[27]?></td>
			  <td><a href="pending_approvals.php?activate=true&id=<?=$row[0]?>">Activate</a></td>
		  </tr>
		  <?}?>
		</table>
	</section>
</div>

<?include("../includes-in/footer.php");?>