<?php
	session_start();
	include("../includes-in/header.php");
	include("../config.php");

	$config = new Config();
	$connection = $config->connect("209.200.231.164", "ciaot1", "mSaKSeZXt0TK");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);

	if(!$dbconn){die("Could not select DB");}
	if (isset($_SESSION["id"])){
		$sql_read = "SELECT * FROM `customers` WHERE ID like '$_SESSION[id]'";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_row($result);
		$referralcode = $row[5];
	}
?>
<div class="row portal-container">
	<section class="col-lg-3 col-md-3 member-nav">
		<?php include("../includes-in/portal-nav.php");?>
	</section>
	<section class="col-lg-9 col-md-9 col-sm-9">
		<div class="panel panel-default">
		  <div class="panel-body">
		    Your Referral Link: http://tashiciao.ciaocrm.com/aldi/netstar/signup.php?code=<?echo $referralcode?>
		  </div>
		</div>
		<div class="panel panel-default">
		  <div class="panel-body">
		    Your Referral Code: <?echo $referralcode ?>
		  </div>
		</div>
	</section>
</div>
			
			
<?php include('../includes-in/footer.php'); ?>