<?
	session_start();
	include ("../includes-in/header.php");
	include ("../config.php");
?>
<? 
	$config = new Config();
	$connection = $config->connect("localhost", "NetStar", "G62267Fd8OX277z");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}

	$id = $_SESSION["id"];
	$sql_read_user = "SELECT * FROM `customers` WHERE ID like '$id'";
	$result_user = mysql_query($sql_read_user);
	if ($result_user == false){die(var_dump(mysql_error()));}
	$row_user = mysql_fetch_row($result_user);

?>
<div class="row portal-container">
	<section class="col-lg-3 col-md-3 member-nav">
		<? include("../includes-in/portal-nav.php"); ?>
	</section>
	<section class="col-lg-9 col-md-9 text-center">
		<? if ($row_user[11] == "partner"){ ?>
			<h1>Upgrade to Personal Package</h1>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="FBLNS9SPCWBYY">
				<input type="hidden" name="custom" value="upgrade=personal id=<?=$id?>">
				<input type="submit" name="submit" class="btn btn-primary" value="Upgrade">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
			<h1>Or Upgrade to Busisiness Package</h1>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="LT2QV5NQ6BEQ6">
				<input type="hidden" name="custom" value="upgrade=business id=<?=$id?>">
				<input type="submit" name="submit" class="btn btn-primary" value="Upgrade">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>

		<?} else if ($row_user[11] == "personal") {?>
			<h2>Upgrade to Business Package</h2>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="FBLNS9SPCWBYY">
				<input type="hidden" name="custom" value="upgrade=business id=<?=$id?>">
				<input type="submit" name="submit" class="btn btn-primary" value="Upgrade">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>

		<?} else {?>
			<h2>No need for upgrade, you are already at the top level :) </h2>
		<?}?>
	</section>
</div>
<? include ("../includes-in/footer.php"); ?>