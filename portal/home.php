<?php
	ob_start();
	session_start(); 
	include("../includes-in/header.php");
	include("../config.php"); ?>

<?
	$config = new Config();
	$connection = $config->connect("209.200.231.164", "ciaot1", "mSaKSeZXt0TK");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}
	if (isset($_SESSION["id"])){
		$sql_read = "SELECT * FROM `customers` WHERE ID like '$_SESSION[id]'";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_row($result);

		$todays_date = strtotime(date("Y-m-d"));
		$days_to_end_of_month = (strtotime($row[17]) - $todays_date)/(3600*24);
		$days_to_end_of_year = (strtotime($row[18]) - $todays_date)/(3600*24);

		$cash = $row[19];
		$credit =$row[20];
		$points = $row[21];
		$leftpoints = $row[24];
		$rightpoints = $row[25];
		$clicks = $row[26];
	}
	else{
		header("Location: ../index.php"); 
	}
?>
<div class="row portal-container">
	<section class="col-lg-3 col-md-3 member-nav">
		<? include("../includes-in/portal-nav.php"); ?>
	</section>
	<section class="col-lg-9 col-md-9 home-boxes">
		<div class="row">
			<section class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-asterisk"></span> Coin Wallet</h2>
					<h3> $<? echo $cash; ?></h3>
					<p>coins</p>
				</div>
			</section>
			<section class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-credit-card"></span> Credit Wallet</h2>
					<h3> <? echo $credit; ?></h3>
				</div>
			</section>
			<section class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-star"></span> Points Wallet</h2>
					<h3> <? echo $points; ?></h3>
					<p>points</p>
				</div>
			</section>
		</div>
		<div class="row">
			<section class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-circle-arrow-left"></span> Left</h2>
					<h3><? echo $leftpoints; ?></p>
					<p>points</p>
				</div>
			</section>
			<section class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
				<div class="box">
					<h2>Right <span class="glyphicon glyphicon-circle-arrow-right"></span></h2>
					<h3> <? echo $rightpoints; ?></p>
					<p>points</p>
				</div>
			</section>
			<section class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-hand-up"></span> Clicks Today</h2>
					<h3><? echo $clicks . " days left."?></h3>
					<p>clicks so far</p>
				</div>
			</section>
		</div>
		<div class="row">
			<section class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-circle-arrow-time"></span> Monthly Payment</h2>
					<h3><? echo $days_to_end_of_month; ?></p>
					<p>days left</p>
				</div>
			</section>
			<section class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-circle-arrow-time"></span> Annual Payment</h2>
					<h3><? echo $days_to_end_of_year; ?></p>
					<p>days left</p>
				</div>
			</section>
		</div>
	</section>
</div>
			
			
<?php include('includes/footer.php'); ?>