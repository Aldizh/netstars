<?php
	ob_start();
	session_start();
	include("includes/header.php");
	include("config.php");
?>

<?
	$config = new Config();
	$connection = $config->connect("localhost", "NetStar", "kRJd7tW3PLc3m4");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}
	
	if (isset($_POST["firstname"]) and isset($_POST["lastname"]) and isset($_POST["email"]) and isset($_POST["phone"])){
		$_POST = sanitize($_POST);
  		$_GET  = sanitize($_GET);

  		$referralcode = $_GET["code"];
  		$username = $_POST["username"];
  		$password = $_POST["password"];
  		$password_conf = $_POST["password_conf"];
  		if ($password != $password_conf){
  			$err_confirmation = "Sorry, Passwords Need to Match.";
  		}
  		$password = sha1($password);

  		//make sure name input is sanitized
		preg_match('/[a-zA-Z]+/', $_POST["firstname"], $firstname);
		preg_match('/[a-zA-Z]+/', $_POST["lastname"], $lastname);
		if ($firstname[0] != $_POST["firstname"]){
			$err_patternmatch = '<div class="error">Sorry, first and last name can only contain letters.</div>';
		}
		if ($lastname[0] != $_POST["lastname"]){
			$err_patternmatch = '<div class="error">Sorry, first and last name can only contain letters.</div>';
		}

		$address = $_POST["fulladdress"];
		$email = $_POST["email"];
		$phone = preg_replace("/[^0-9]/", "", $_POST["phone"]);
		$membership = $_POST["optionsRadios"];
		$_SESSION["membership"] = $membership;
		$terms1 = $_POST["terms1"];
		$terms2 = $_POST["terms2"];
		if ($terms1 != "checked" || $terms2  != "checked"){
			$err_terms = "Please agree to the terms frst!";
		}

		//Check for uniqueness on username and email
		$sql_read_user = "SELECT * FROM `customers` WHERE username like '$username'";
		$result_user = mysql_query($sql_read_user);
		if ($result_user == false){die(var_dump(mysql_error()));}
		$row_user = mysql_fetch_row($result_user);

		if (($row_user[3]) == $username){
			$err_unique = '<div class="error">Sorry, this username is already taken.</div>';
		}

		//check uniqueness of referral code
		$sql_read_user1 = "SELECT * FROM `customers` WHERE referralcode like '$referralcode'";
		$result_user1 = mysql_query($sql_read_user1);
		if ($result_user1 == false){die(var_dump(mysql_error()));}
		$row_user1 = mysql_fetch_row($result_user1);
 
		if (($row_user1[5]) != $referralcode){
			$err_ref_unique = '<div class="error">Please check you your referral code.</div>';
		}

		if (strlen($password) <= 6):
			$err_passlength = '<div class="error">Sorry, the password must be at least six characters</div>';
		endif; //password not long enough

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		   $err_email = '<div class="error">Invalid Email</div>';
		}

		if(!$err_email and !$err_passlength and !$err_patternmatch and !$err_confirmation and !$err_terms and !$err_username and !$err_unique and !$err_ref_unique){
			//check and set the sponsor
			$sql_insert = "INSERT INTO `ciaot1_netex`.`pending_customers` (`ID`, `username`, `password`, `referralcode`, `firstname`, `lastname`, `email`, `membership_type`, `phone`, `fulladdress`) VALUES (NULL, '$username', '$password', '$referralcode', '$firstname[0]', '$lastname[0]', '$email', '$membership', '$phone', '$address');";
			$result = mysql_query($sql_insert);
			if (substr(mysql_error(), 0, 9) === "Duplicate"){
				$err_username = '<div class="error">Sorry, this username is already taken.</div>';
			}
			else if ($result == false){die(var_dump(mysql_error()));}
			else{
				$id = mysql_insert_id();
				$_SESSION["id_pending"] = $id;
				header("Location: payment.php"); 
			}

		}
	}
?>
<div class="row signup-container">
	<section class="form-box">
		<h4> SIGN UP FORM </h4>
		<form role="form" method="post" name="signup" id="signup" action="<? $_SERVER['PHP_SELF'] ?>">
  		  <div class="form-group">
  		    <input type="text" name="referral" class="form-control" id="ref-code" placeholder="Referal Code* (Please Ask your referrer if you don't have one)" value="<?=$_GET['code']?>"  disabled required>
  		    <?php if (isset($err_ref_unique)) { echo $err_ref_unique; } ?>
  		  </div>
  		  <div class="form-group">
		      <section class="row">
				  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					  <div class="radio">
					    <label>
					      <input type="radio" name="optionsRadios" id="partner" value="partner" checked>
						  <a id="popover" rel="popover" data-content="">Partner ($49.99)</a>
						</label>
					  </div>
				  </div>
				  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
 					 <div class="radio">
 					   <label>
 					     <input type="radio" name="optionsRadios" id="personal" value="personal">
						  <a id="popover2" rel="popover" data-content="">Personal ($349.99)</a>
 					   </label>
 					 </div>
				  </div>
				  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					  <div class="radio">
					    <label>
					      <input type="radio" name="optionsRadios" id="business" value="business">
						  <a id="popover3" rel="popover" data-content="">Business ($1549.99)</a>
					    </label>
					  </div>
				  </div>
			  </section>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" name="username" placeholder="User Name *" maxlength="30" value="" required>
		    <?php if (isset($err_username)) { echo $err_username; } ?>
		    <?php if (isset($err_unique)) { echo $err_unique; } ?>
		  </div>
		  <div class="form-group">
		    <input type="password" class="form-control" name="password" placeholder="Password *" maxlength="30" value="" required>
		     <?php if (isset($err_passlength)) { echo $err_passlength; } ?>
		  </div>
		   <div class="form-group">
		    <input type="password" class="form-control" name="password_conf" placeholder="Password Confirmation*" value="" maxlength="30" required>
		     <?php if (isset($err_passlength)) { echo $err_passlength; } ?>
		      <?php if (isset($err_confirmation)) { echo $err_confirmation; } ?>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" name="firstname" id="first-name" placeholder="First Name *" maxlength="30" value="" required>
		    <?php if (isset($err_patternmatch)) { echo $err_patternmatch; } ?>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" name="lastname" id="last-name" placeholder="Last Name *" maxlength="30" value="" required>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" name="fulladdress" placeholder="Address *" maxlength="70" value="" required>
		  </div>
		  <div class="form-group">
		    <input type="email" class="form-control" name="email" id="email" placeholder="Email *" value="" required>
		     <?php if (isset($err_email)) { echo $err_email; } ?>
		     <?php if (isset($err_username)) { echo $err_username; } ?>
		  </div>
		  <div class="form-group">
		    <input type="phone" class="form-control" name="phone" id="phone" placeholder="Phone *" maxlength="30" value="" required>
		  </div>
		  <div class="form-group">
			<input type="checkbox" name="terms1" value="checked" required> I accept the <a href="#" data-toggle="modal" data-target=".terms" required>Terms and Conditions</a>
		  </div>
		  <div class="form-group">
			<input type="checkbox" name="terms2" value="checked" required> I accept the <a href="includes/NeXXStarsPP.pdf" target="_blank" required>Policies and Procedures</a>
		  </div>
		  <?php if (isset($err_terms)) { echo $err_terms; } ?> 
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
<script>
	var image = '<img src="images/membership-partner-popover.jpg">';
	$('#popover').popover({placement: 'top', trigger: 'hover', content: image, html: true});
</script>
<script>
	var image = '<img src="images/membership-personal-popover.jpg">';
	$('#popover2').popover({placement: 'top', trigger: 'hover', content: image, html: true});
</script>
<script>
	var image = '<img src="images/membership-business-popover.jpg">';
	$('#popover3').popover({placement: 'top', trigger: 'hover', content: image, html: true});
</script>
