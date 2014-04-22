<?php
	ob_start();
	session_start(); 
	include("../includes-in/header.php");
	include("../config.php");

	if ($_SESSION["admin"] != true || ($_SESSION["id"]) == NULL){
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
		
		//This activates the user
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
			$commission = 30;
		}
		else if ($row["membership_type"] == "business"){
			$creditAmount = 0.02*1400;
			$commission = 150;
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



##############################################################
// Script for Binary Bonus Calculation
#	DB_QUERY NEED TO GRAB the whole row of the newly added member
		$sql_read = "SELECT * FROM `customers` WHERE ID like '$_GET[id]'";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_assoc($result);

		memberId = row["id"];
		memberType = row["membership type"];
		sponsor_id = row["sponsor id"];
		
		point = 0;
		if (memberType != 'partner'){
			if (memberType == 'personal'){
				point = 1;
			}
			else if (memberType == 'business'):{
				point = 5;
			}

			// Skipping the direct sponsor
			childId = sponsor_id // current member's sponsor id - one level up

#	DB_QUERY NEED TO GRAB the whole row of the childId - let's set it as childRow
			$sql_read = "SELECT * FROM `customers` WHERE ID like '$childId'";
			$result = mysql_query($sql_read);
			if ($result == false){die(var_dump(mysql_error()));}
			$childRow = mysql_fetch_assoc($result);


			// ##### Loop begins #####
			while (childRow["sponsor_id"] != NULL){

				parentId = childRow["sponsor_id"];  // (childId.sponsor_id) current member's sponsor id's sponsor id - two level up
#	DB_QUERY NEED TO GRAB the whole row of the parentId - let's set it as parentRow
				$sql_read = "SELECT * FROM `customers` WHERE ID like '$parentId'";
				$result = mysql_query($sql_read);
				if ($result == false){die(var_dump(mysql_error()));}
				$parentRow = mysql_fetch_assoc($result);

				
				if (parentRow["membership_type"] == "partner"){
					childRow = parentRow; // move one level up (COPY everything)
					continue;
				}
				if (parentRow["tree_qualified"] == '1'){

					leftPt = parentRow["leftPoint"];
					rightPt = parentRow["rightPoint"];
					cashbalance = parentRow["cashbalance"];

					if (parentRow["rightChild"] == childId){
						// Add points to right and calculate
						rightPt += point;
					}

					else {
						// Add points to left and calculate
						leftPt += point;
					}

					diff = 0;
					if leftPt >= rightPt:
						diff = leftPt - rightPt;
						leftPt -= rightPt;
					else rightPt > leftPt:
						diff = rightPt - leftPt;
						rightPt -= leftPt

					cashbalance += (diff * 20);

####				DB_QUERY NEED TO update the parentId entry in database and update leftPt, rightPt, and cashbalance

				}


				childRow = parentRow; // move one level up (COPY everything)
			}

		} ###### Loop ends ######
// this is where it finishes [Binary Bonus]
#############################################################



		
		header("Location: pending_approvals.php"); 
	}
?>
<div class="row portal-container">
	<section class="col-lg-3 col-md-3 member-nav">
		<? include("../includes-in/portal-nav.php"); ?>
	</section>
	<section class="col-lg-9 col-md-9">
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