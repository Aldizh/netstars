<?php
	ob_start();
	session_start(); 
	include("includes/header.php");
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
		<ul class="nav nav-pills nav-stacked">
		  <li class="active"><a href="#"><span class="glyphicon glyphicon-home"> Home</a></li>
		  <li><a href="#"><span class="glyphicon glyphicon-globe"> My Network</a></li>
		</ul>
	</section>
	<section class="col-lg-9 col-md-9 home-boxes">
		<div class="row">
			<section class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-usd"></span> Coin Wallet</h2>
					<p>So far you have accumulated $<? echo $cash?></p>
				</div>
			</section>
			<section class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-usd"></span> Credit Wallet</h2>
					<p>So far you have accumulated <? echo $credit . " Credits."; ?></p>
				</div>
			</section>
			<section class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-usd"></span> Point Wallet</h2>
					<p>So far you have accumulated <? echo $points . " Points."; ?></p>
				</div>
			</section>
			<section class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-hand-up"></span> Clicks Today</h2>
					<p>Today you have made <? echo $clicks . " Clicks."; ?></p>
				</div>
			</section>
		</div>
		<div class="row">
			<section class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-circle-arrow-left"></span> Left Points</h2>
					<p>You have accumulated <? echo $leftpoints . " Left points.(Used for your binary qualification)"; ?></p>
				</div>
			</section>
			<section class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<div class="box">
					<h2>Right Points <span class="glyphicon glyphicon-circle-arrow-right"></span></h2>
					<p>You have accumulated <? echo $rightpoints . " Right points.(Used for your binary qualification)"; ?></p>
				</div>
			</section>
			<section class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-calendar"></span> Monthly Membership</h2>
					<p>You have <? echo $days_to_end_of_month . " days left."?></p>
				</div>
			</section>
			<section class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<div class="box">
					<h2><span class="glyphicon glyphicon-calendar"></span> Yearly Membership</h2>
					<p>You have <? echo $days_to_end_of_year . " days left."?>.</p>
				</div>
			</section>
		</div>
	</section>
</div>
			
			
<?php include('includes/footer.php'); ?>
