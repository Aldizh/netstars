<?
	ob_start();
	session_start(); 
	include("../includes-in/header.php");
	include("../config.php");
?>
<?
	$config = new Config();
	//$connection = $config->connect("209.200.231.164", "ciaot1", "mSaKSeZXt0TK");
	$connection = $config->connect("localhost", "NetStar", "kRJd7tW3PLc3m4");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}

	if (isset($_POST["password"]) || isset($_POST["email"]) || isset($_POST["position"])){

		preg_match("/^[a-zA-Z0-9]+/", $_POST["password"], $_SESSION["password"]);
		if ($_SESSION["password"][0] != $_POST["password"]){
			$pass_error = "Only Letters and Numbers allowed";
		}
		$_SESSION["password"] = $_POST["password"];
		$_SESSION["email"] =  $_POST["email"];
		$_SESSION["position"] = $_POST["optionsRadios"];
		if (!isset($pass_error)){
			header("Location: update_modal.php"); 
		}
	}
	if (isset($_POST["oldpass"])){
		$sql_read = "SELECT * FROM `customers` WHERE ID like '$_SESSION[id]'";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_row($result);
		if ($row[4] != sha1($_POST["oldpass"])){
			header("Location: update_modal.php?valid=false");
		}
		else{
			if ($_SESSION["password"] == ""){
				$password = $row[4];
			}
			else{
				$password = sha1($_SESSION["password"]);	
			}
			$email =  $_SESSION["email"];
			$position = $_SESSION["position"];
			$sql_update = "UPDATE `ciaot1_netex`.`customers` SET `password` = '$password', `email` = '$email', `position` = '$position' WHERE `customers`.`ID` = '$_SESSION[id]';";
			$result_update = mysql_query($sql_update);
			if ($result_update == false){die(var_dump(mysql_error()));}
			header("Location: home.php");
		}
	}

	$sql_read = "SELECT * FROM `customers` WHERE ID like '$_SESSION[id]'";
	$result = mysql_query($sql_read);
	if ($result == false){die(var_dump(mysql_error()));}
	$row = mysql_fetch_row($result);
	$username = $row[3];
	$password = $row[4];
	$firstname = $row[6];
	$lastname = $row[7];
	$email = $row[8];
	$position = $row[10];
	$phone = $row[31];
?>
<!-- PORTAL CONTENT starts -->
<div class="container" id="portal-wrapper">
	<div class="row portal-container">
	<section class="col-lg-3 col-md-3 member-nav">
		<? include("../includes-in/portal-nav.php"); ?>
	</section>
	<section class="col-lg-9 col-md-9 home-boxes">
		<div class="row">
			<div class="col-lg-6 col-md-6 home-boxes">
				<form class="form-horizontal" action="<?$_SERVER['PHP_SELF']?>" method="post" role="form">
			  <div class="form-group">
			  	 <label for="position" class="col-sm-4 control-label"></label>
			  	 <div class="col-sm-5">
			  	 	<label for="position">Leg Preference</label>
			     </div>
			  </div>
			  <div class="form-group">
			    <label for="position" class="col-sm-5 control-label">Left</label>
			    <div class="col-sm-4">
					<input type="radio" name="optionsRadios" id="partner" value="left" <?if ($position == "left"){?>checked<?}?>>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="position" class="col-sm-5 control-label">Right</label>
			    <div class="col-sm-4">
					<input type="radio" name="optionsRadios" id="partner" value="right" <?if ($position == "right"){?>checked<?}?>>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="Password" class="col-sm-4 control-label">New Password</label>
			    <div class="col-sm-5">
			      <input type="password" name="password" class="form-control" id="inputPassword3" value="" >
			      <?php if (isset($pass_error)) { echo $pass_error; } ?>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="Last" class="col-sm-4 control-label">New Email</label>
			    <div class="col-sm-5">
			      <input type="text" name="email" class="form-control" id="inputEmail3" value=<?= $email;?> >
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="Last" class="col-sm-5 control-label"></label>
			    <div class="col-sm-4">
			      <button type="submit" class="btn btn-primary">Update</button>
			    </div>
			  </div>
			</form>
			</div>
		</div>
	</section>
</div>
<?include("../includes-in/footer.php");?>