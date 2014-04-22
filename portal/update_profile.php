<?
	ob_start();
	session_start(); 
	include("../includes-in/header.php");
	include("../config.php");
?>
<?
	$config = new Config();
	//$connection = $config->connect("209.200.231.164", "ciaot1", "mSaKSeZXt0TK");
	$connection = $config->connect("localhost", "NetStar", "G62267Fd8OX277z");
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
<div class="row portal-container">
	<section class="col-lg-3 col-md-3 member-nav">
		<? include("../includes-in/portal-nav.php"); ?>
	</section>
	<section class="col-lg-9 col-md-9">
		<form role="form" action="<?$_SERVER['PHP_SELF']?>" method="post">
			<div style="border: #CCC solid 1px; width: 400px; padding: 1.2em; border-radius: 3px;">
				<h4>LEG PREFERENCE</h4>
				<div class="radio">
				  <label>
				  	<? if ($position == "left"){ ?>
				    	<input type="radio" name="optionsRadios" id="partner" value="left" checked>
				    <?}else{?>
				    	<input type="radio" name="optionsRadios" id="partner" value="left">
				    <?}?>
				    LEFT
				  </label>
				</div>
				<div class="radio">
				  <label>
				  	<? if ($position == "right"){ ?>
				    	<input type="radio" name="optionsRadios" id="partner" value="right" checked>
				    <?}else{?>
				     	<input type="radio" name="optionsRadios" id="partner" value="right" >
				    <?}?>
				    RIGHT
				  </label>
				</div>
			</div>
			<br>
			<div style="border: #CCC solid 1px; width: 400px; padding: 1.2em; border-radius: 3px;">
	  		  <div class="form-group">
	  		    <label for="password">New Password (If you want to change)</label>
	  		    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="" size="40">
				<?php if (isset($pass_error)) { echo $pass_error; } ?>
	  		  </div>
	  		  <div class="form-group">
	  		    <label for="email">New Email</label>
	  		    <input type="text" name="email" class="form-control" id="exampleInputPassword1" placeholder="Password" size="40" value=<?= $email;?>>
	  		  </div>
			<button type="submit" class="btn btn-primary" style="font-size: 1.0em;">Update</button>
	 </div>
		</form>
	</section>
</div>
<br><br>
<?include("../includes-in/footer.php");?>