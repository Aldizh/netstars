<?php
	ob_start();
	include("includes/header.php");
	include("config.php");
?>

<?
	$config = new Config();
	$connection = $config->connect("209.200.231.164", "ciaot1", "mSaKSeZXt0TK");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}

	$year_date = date("Y-m-d", strtotime("1 year"));
	$month_date = date("Y-m-d", strtotime("28 days"));

	if (isset($_POST["firstname"]) and isset($_POST["lastname"]) and isset($_POST["email"])){
		$_POST = sanitize($_POST);
  		$_GET  = sanitize($_GET);
  		$username = $_POST["username"];
  		$password = $_POST["password"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$membership = $_POST["optionsRadios"];
		if ($membership === "personal"){
			$bonus_cap = 2500;
		}
		else if ($membership === "business" || $membership === "personal"){
			$bonus_cap = 10000;
		}

		if (strlen($password) <= 6):
			$err_passlength = '<div class="error">Sorry, the password must be at least six characters</div>';
		endif; //password not long enough

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		   $err_email = '<div class="error">Invalid Email</div>';
		}

		if ( !(preg_match('/[A-Za-z]+/', $firstname)) ){
			$err_patternmatch = '<div class="error">Sorry, the name must be in the format: Last, First</div>';
		}

		//check and set the enroller
		$enrollercode = $_POST["referral"];
		$sql_read = "SELECT * FROM `customers` WHERE referralcode like '$enrollercode'";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_row($result);
		$enroller_id = $row[0];
		$sponsor_id = NULL;

		if (!$_POST["referral"]){
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
		$sql_read = "INSERT INTO `ciaot1_netex`.`customers` (`ID`, `username`, `password`, `referralcode`, `firstname`, `lastname`, `email`, `level`, `sponsor_ID`, `position`, `membership_type`, `weekly_qualification`, `monthly_qualification`, `tree_qualification`, `global_cap`, `binary_cap`, `monthly_expiration`, `yearly_expiration`, `cashbalance`, `creditbalance`, `pointsbalance`, `leftpoints`, `rightpoints`, `numberofclicks`)
													VALUES (NULL, '$username', '$password', NULL, '$firstname', '$lastname', '$email', '1', '$sponsor_id', 'right', '$membership', '0', '0', '0', '$bonus_cap', '0', '$month_date', '$year_date', '0', '0', '0', NULL, NULL, NULL);";
		$result = mysql_query($sql_read);
		//if (mysql_error() == "Duplicate entry 'aldizh' for key 'username'"){echo "Username Hhs to be unique";}
		if ($result == false){die(var_dump(mysql_error()));}
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
		if(!$err_email and !$err_passlength){
			header("Location: payment.php"); 
		}
	}
?>
<div class="row signup-container">
	<section class="form-box">
		<h4> SIGN UP FORM </h4>
		<form role="form" method="post" name="signup" id="signup" action="<? $_SERVER['PHP_SELF'] ?>">
  		  <div class="form-group">
  		    <input type="text" name="referral" class="form-control" id="ref-code" placeholder="Referal Code (if any)">
  		  </div>
  		  <div class="form-group">
		      <section class="row">
				  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					  <div class="radio">
					    <label>
					      <input type="radio" name="optionsRadios" id="partner" value="partner" checked>
					      Partner
					    </label>
					  </div>
				  </div>
				  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
 					 <div class="radio">
 					   <label>
 					     <input type="radio" name="optionsRadios" id="personal" value="personal">
 					     Personal
 					   </label>
 					 </div>
				  </div>
				  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					  <div class="radio">
					    <label>
					      <input type="radio" name="optionsRadios" id="business" value="business">
					      Business
					    </label>
					  </div>
				  </div>
			  </section>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" name="username" placeholder="User Name *" maxlength="30" required>
		  </div>
		  <div class="form-group">
		    <input type="password" class="form-control" name="password" placeholder="Password *" maxlength="30" required>
		     <?php if (isset($err_passlength)) { echo $err_passlength; } ?>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" name="firstname" id="first-name" placeholder="First Name *" maxlength="30" required>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" name="lastname" id="last-name" placeholder="Last Name *" maxlength="30" required>
		  </div>
		  <div class="form-group">
		    <input type="email" class="form-control" name="email" id="email" placeholder="Email *" required>
		     <?php if (isset($err_email)) { echo $err_email; } ?>
		  </div>
		  <div class="form-group">
		    <input type="phone" class="form-control" name="phone" id="phone" placeholder="Phone *" maxlength="30" required>
		  </div>
		  <button type="submit" class="btn btn-primary">Continue</button>
		</form>
	 	<script>
          $(document).ready(function() {
            $('#signup').submit(function() {
              var abort = false;
              $("div.error").remove(); //To remove any errors currently on the page
              $(':input[required]').each(function() {
                if ($(this).val()==='') {
                  $(this).after('<div class="error">This is a required field</div>');
                  abort = true;
                }
              }); // go through each required value
              if (abort) { return false; } else { return true; }
            })//on submit
          }); // ready
        </script>    
	</section>
</div>

<?
function cleanInput($input) {

  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );

    $output = preg_replace($search, '', $input);
    return $output;
  }
?>
<?php
function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $input = trim($input);
        $input = htmlspecialchars($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}
?>
<?php include('includes/footer.php'); ?>
