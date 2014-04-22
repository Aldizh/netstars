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

	$sql_read = "SELECT * FROM `pending_customers`";
	$result = mysql_query($sql_read);
	if ($result == false){die(var_dump(mysql_error()));}

	if (isset($_GET["activate"]) and $_GET["activate"] == "true"){
		$pending_id = $_GET["id"];
		$sql_read = "SELECT * FROM `pending_customers` WHERE ID like '$pending_id'";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_row($result);

		//check and set the enroller
		$enrollercode = $row[3];
		$sql_read = "SELECT * FROM `customers` WHERE referralcode like '$enrollercode'";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_row($result);

		$enroller_id = $row[0];
		$sponsor_id = NULL;

		if ($row[3] == NULL){
		  $sponsor_id = NULL;
		  $enroller_id = NULL;
		}
		else{
		  $currentNode = $enroller_id;
		  $leftChild = $row[22];
		  $rightChild = $row[23];
		  $position = $row[10];
		  while (($leftChild != NULL and $position == "left") or ($rightChild != NULL and $position == "right")){
		    if ($position == "left"){$currentNode = $leftChild;}
		    else{$currentNode = $rightChild;}
		    //move the left child node down
		    $sql_read = "SELECT * FROM `customers` WHERE ID like '$currentNode'";
		    $result = mysql_query($sql_read);
		    if ($result == false){die(var_dump(mysql_error()));}
		    $row = mysql_fetch_row($result);
		    $leftChild = $row[22];
		    $rightChild = $row[23];
		    $position = $row[10];

		  }
		  $sponsor_id = $currentNode;
		}
		//check and set the sponsor

		$sql_read = "SELECT * FROM `pending_customers` WHERE ID like '$pending_id'";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_row($result);
		$username = $row[1];
		$password = $row[2];
		$firstname = $row[4];
		$lastname = $row[5];
		$email = $row[6];
		$year_date = date("Y-m-d", strtotime("364 days"));
		$month_date = date("Y-m-d", strtotime("28 days"));
		$membership = $row[7];
		 if ($membership === "partner"){
		  $cashpoolamount = 300;
		  $bonus_cap = 2500;
		  $binary_cap = 500;
		}
		else if ($membership === "business" || $membership === "personal"){
		  $bonus_cap = 10000;
		  $binary_cap = 20000;
		  $cashpoolamount = 1400;
		}
		$phone = $row[8];
		$address = $row[9];

		// decide cash pool amount depending on membership type of new member
		$sql_read = "INSERT INTO `ciaot1_netex`.`customers` (`ID`, `username`, `password`, `referralcode`, `firstname`, `lastname`, `email`, `level`, `sponsor_ID`, `position`, `membership_type`, `weekly_qualification`, `monthly_qualification`, `tree_qualification`, `global_cap`, `binary_cap`, `monthly_expiration`, `yearly_expiration`, `cashbalance`, `creditbalance`, `pointsbalance`, `leftpoints`, `rightpoints`, `numberofclicks`, `status`, `phone`, `fulladdress`)
		                      VALUES (NULL, '$username', '$password', NULL, '$firstname', '$lastname', '$email', '1', '$sponsor_id', 'right', '$membership', '1', '1', '0', '$bonus_cap', '$binary_cap', '$month_date', '$year_date', '0', '0', '0', '0', '0', '0', 'pending', '$phone', '$address');";
		$result = mysql_query($sql_read);
		
		//After the customer is inserted into the real customers table delete them from the temporary table
		$sql_delete = "DELETE FROM `ciaot1_netex`.`pending_customers` WHERE `ID`='$pending_id';";
		mysql_query($sql_delete);


		if ($result == false){}
		else{
		  $id = mysql_insert_id();
		  $_SESSION["id"] = $id;

		  if ($position == "left"){
		    $sql_update = "UPDATE `ciaot1_netex`.`customers` SET `leftChild` = '$id' WHERE `customers`.`ID` = '$sponsor_id';";
		    $result_update = mysql_query($sql_update);
		    if ($result_update == false){die(var_dump(mysql_error()));}
		  }
		  else{
		    $sql_update = "UPDATE `ciaot1_netex`.`customers` SET `rightChild` = '$id' WHERE `customers`.`ID` = '$sponsor_id';";
		    $result_update = mysql_query($sql_update);
		    if ($result_update == false){die(var_dump(mysql_error()));}
		  }

		  $referralcode = $id . uniqid();
		  if( ($id % 2) == 0 )
		      $position = "left";
		  else
		    $position = "right";
		  $sql_update = "UPDATE `ciaot1_netex`.`customers` SET `position` = '$position', `referralcode` = '$referralcode', `enroller_ID` = '$enroller_id' WHERE `customers`.`ID` = '$id';";
		  $result_update = mysql_query($sql_update);
		  if ($result_update == false){die(var_dump(mysql_error()));}
		}

		$sql_read = "SELECT * FROM `weekly_cashpool` WHERE ID like 1";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_row($result);
		$weeklycashpoolamount = $cashpoolamount + $row[1];
		$sql_update = "UPDATE `ciaot1_netex`.`weekly_cashpool` SET `amount` = '$weeklycashpoolamount' WHERE `weekly_cashpool`.`ID` = 1;";
		$result_update = mysql_query($sql_update);
		if ($result_update == false){die(var_dump(mysql_error()));}

		$sql_read = "SELECT * FROM `monthly_cashpool` WHERE ID like 1";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_row($result);
		$monthlycashpoolamount = $cashpoolamount + $row[1];
		$sql_update = "UPDATE `ciaot1_netex`.`monthly_cashpool` SET `amount` = '$monthlycashpoolamount' WHERE `monthly_cashpool`.`ID` = 1;";
		$result_update = mysql_query($sql_update);
		if ($result_update == false){die(var_dump(mysql_error()));}

		// Script for Binary Bonus Calculation
		echo "Customer" . $firstname . " " . $lastname . "Was added";
		header("Location: add_customers.php"); 
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
			  <td>First name</td>
			  <td>Last Name</td>
			  <td>Type</td>
			  <td>Enroller ID</td>
			  <td>Action</td>
		  </tr>
		  <? while($row=mysql_fetch_array($result)) {?>
		  <tr>
			  <td><?=$row[0]?></td>
			  <td><?=$row[4]?></td>
			  <td><?=$row[5]?></td>
			  <td><?=$row[7]?></td>
			  <td><?=$row[3]?></td>
			  <td><a href="add_customers.php?activate=true&id=<?=$row[0]?>">Add customer</a></td>
		  </tr>
		  <?}?>
		</table>
	</section>
</div>
<?include("../includes-in/footer.php");?>