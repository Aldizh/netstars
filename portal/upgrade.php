<?
	session_start();
	include ("../includes-in/header.php");
	include ("../config.php");
?>
<? 
	$new_pass = sha1("testing");
	echo $new_pass;
	$config = new Config();
	$connection = $config->connect("localhost", "NetStar", "kRJd7tW3PLc3m4");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}

	$id = $_SESSION["id"];
	$sql_read_user = "SELECT * FROM `customers` WHERE ID like '$id'";
	$result_user = mysql_query($sql_read_user);
	if ($result_user == false){die(var_dump(mysql_error()));}
	$row_user = mysql_fetch_row($result_user);
?>

<? if ($_SESSION["membership"] == "partner"){ ?>
	<h1>Upgrade to Personal Package</h1>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="FBLNS9SPCWBYY">
		<input type="hidden" name="custom" value="<?=$id?> upgrade=personal">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	<h1>Or Upgrade to Busisiness Package</h1>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="LT2QV5NQ6BEQ6">
		<input type="hidden" name="custom" value="<?=$id?> upgrade=business">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>

<?} else if ($_SESSION["membership"] == "personal"){?>
	<h2>Upgrade to Business Package</h2>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="FBLNS9SPCWBYY">
		<input type="hidden" name="custom" value="<?=$id?> upgrade=business">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>

<?} else {?>
	<h2>No need for upgrade, you are already at the top level :) </h2>
<?}?>
<? include ("../includes-in/footer.php"); ?>