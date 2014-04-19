<?
	ob_start();
	session_start(); 
	include("../includes-in/header.php");
	include("../config.php");
?>
<?
	$config = new Config();
	$connection = $config->connect("209.200.231.164", "ciaot1", "mSaKSeZXt0TK");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}

	if (isset($_POST["password"]) || isset($_POST["email"]) || isset($_POST["position"])){
		$_SESSION["password"] = $_POST["password"];
		$_SESSION["email"] =  $_POST["email"];
		$_SESSION["position"] = $_POST["optionsRadios"];
		header("Location: ../includes/update_modal.php"); 
	}
	if (isset($_POST["oldpass"])){
		$sql_read = "SELECT * FROM `customers` WHERE ID like '$_SESSION[id]'";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_row($result);
		if ($row[4] != sha1($_POST["oldpass"])){
			echo sha1($row[4]);
			echo $_POST["oldpass"];
			header("Location: ../includes/update_modal.php?valid=false");
		}
		else{
			$password = sha1($_POST["oldpass"]);
			$email =  $_SESSION["email"];
			$position = $_SESSION["position"];
			$sql_update = "UPDATE `ciaot1_netex`.`customers` SET `password` = '$password', `email` = '$email', `position` = '$position' WHERE `customers`.`ID` = '$_SESSION[id]';";
			$result_update = mysql_query($sql_update);
			if ($result_update == false){die(var_dump(mysql_error()));}
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
	<div class="row">
		<!-- END of MENU -->
		
		<!-- DASHBOARD starts -->
		<section class="col-lg-9 col-md-9 col-sm-9">
			<!-- DASHBOARD Wrapper-->
			<form class="form-horizontal" action="<?$_SERVER['PHP_SELF']?>" method="post" role="form">
			  <div class="form-group">
			  	Leg preference
			  </div>
			  <div class="form-group">
			    <label for="position" class="col-sm-4 control-label">Left</label>
			    <div class="col-sm-5">
					<input type="radio" name="optionsRadios" id="partner" value="left" <?if ($position == "left"){?>checked<?}?>>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="position" class="col-sm-4 control-label">Right</label>
			    <div class="col-sm-5">
					<input type="radio" name="optionsRadios" id="partner" value="right" <?if ($position == "right"){?>checked<?}?>>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="Password" class="col-sm-4 control-label">Password</label>
			    <div class="col-sm-5">
			      <input type="password" name="password" class="form-control" id="inputPassword3" value=<?= $password;?> >
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="Last" class="col-sm-4 control-label">Email</label>
			    <div class="col-sm-5">
			      <input type="text" name="email" class="form-control" id="inputEmail3" value=<?= $email;?> >
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-5">
			      <button type="submit" class="btn btn-primary">Update</button>
			    </div>
			  </div>
			</form>
		</section>
	</div>
</div>
<?include("../includes-in/footer.php");?>