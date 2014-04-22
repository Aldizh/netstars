<? 
  ob_start();
  session_start();
  include("config.php");
	include("includes/header.php");

  $config = new Config();
  $connection = $config->connect("localhost", "NetStar", "kRJd7tW3PLc3m4");
  $dbconn = mysql_select_db("ciaot1_netex", $connection); 
  if(!$dbconn){die("Could not select DB");}
	if($_GET["cm"] && $_GET["amt"]){
    $paypal_response = $_GET["cm"];
    $amount = $_GET["amt"];
    if (substr($paypal_response, 0, 7) == "upgrade"){
      $test_string = "upgrade=personal id=2";
      $test_string = $_GET["cm"];
      $string_array = explode(" ", $test_string);
      $upgrade_type = substr($string_array[0], 8);
      $id = substr($string_array[1], 3);
      
      $sql_read = "SELECT * FROM `customers` WHERE ID like '$id'";
      $result = mysql_query($sql_read);
      if ($result == false){die(var_dump(mysql_error()));}
      $row = mysql_fetch_row($result);

      $sql_update = "UPDATE `ciaot1_netex`.`customers` SET `membership_type` = '$upgrade_type' WHERE `customers`.`ID` = '$id';";
      $result_update = mysql_query($sql_update);
      if ($result_update == false){die(var_dump(mysql_error()));}

      $date = date("Y-m-d H:i:s");
      $description = 'Upgrade to ' . $upgrade_type;
      $sql_read = "INSERT INTO `ciaot1_netex`.`payments` (`ID`, `customer_id`, `description`, `amount`, `date`)
                          VALUES (NULL, '$id', '$description', '$amount', '$date');";
      $result = mysql_query($sql_read);
    }
    else{
      $pending_customer_id = substr($paypal_response, 3);

      $sql_read = "SELECT * FROM `pending_customers` WHERE ID like '$pending_customer_id'";
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

      $sql_read = "SELECT * FROM `pending_customers` WHERE ID like '$pending_customer_id'";
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

      //Insert Payment record
      $date = date("Y-m-d H:i:s");
      $description = 'New (' . $membership . ') Member Signup';
      $sql_read = "INSERT INTO `ciaot1_netex`.`payments` (`ID`, `customer_id`, `description`, `amount`, `date`)
                          VALUES (NULL, '$id', '$description', '$amount', '$date');";
      $result = mysql_query($sql_read);
      $row = mysql_fetch_row($result);

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
    }
    header("Location: thanks.php");
  }
?>
<? include("includes/footer.php"); ?>