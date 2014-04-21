<?php
	include ("config.php");
	include("includes/header.php");
	if ($_POST["month"] and $_POST["year"]){
		$month = $_POST["month"];
		$year = (int)$_POST["year"];
	}
	else{
		$temp = (string)date('F Y');
		$arr = explode(" ", $temp);
		$month = $arr[0];
		$year = (int)$arr[1];
	}
	$config = new Config();
	$connection = $config->connect("localhost", "NetStar", "kRJd7tW3PLc3m4");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}

	//read customer info
	$sql_read = "SELECT * FROM `customers` WHERE firstname like 'Aldi'";
	$result = mysql_query($sql_read);
	if ($result == false){die(var_dump(mysql_error()));}
	$row = mysql_fetch_row($result);
	$id = $row[0];
	
	//Generating Monthly Results
	$total_payout = 0;
	$payouts = array();
	$sql_read = "SELECT * FROM `monthly_commissions` WHERE month like '$month' and year like '$year' and cust_ID like '$id';";
	$result = mysql_query($sql_read);
	if ($result == false){die(var_dump(mysql_error()));}
	while($row = mysql_fetch_assoc($result)) {
        $payouts[] = array(  
        'amount'   => $row['sales_amount'],  
        'commission' => $row['total_commissions'],
        'month' => $row['month'],
        'year' => $row['year'],
    	);
        $total_payout += $row['total_commissions'];
    }
?>
<? $months = array(1 => 'January', 2 => 'Febuary', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'); ?>
<form class="form-control" name="cdr" id="cdr" method="post" action="<? $_SERVER['PHP_SELF'] ?>">
	<?
		echo '<select name="month">' . "\n";
		echo '<option value="---" >SELECT Month</option>\n';
		foreach ($months as $m) {
			echo '<option value="' . $m . '">' . $m . '</option>\n';
		}
		echo '<option value="' . "January" . '"selected>' . "January" . '</option>\n';
		echo "</select>\n";

		echo '<select name="year">' . "\n";
		echo '<option value="---" >SELECT Year</option>\n';
		echo '<option value="' . "2014" . '"selected>' . "2014" . '</option>\n';
		echo '<option value="' . "2015" . '">' . "2015" . '</option>\n';
		echo "</select>\n";
	?>
	<input class="btn btn-primary btn-xs" type='submit' value="Submit">
</form>
<div class="CSSTableGenerator" >
<table>
	<tbody>
		<tr>
			<td>Sales Amount</td>
			<td>Commission Amount</td>
			<td>Month</td>
			<td>Year</td>
		</tr>
		<? foreach ($payouts as $p){ ?>
		<tr>
			<td><? echo $p["amount"]; ?></td>
			<td><? echo $p["commission"] ?></td>
			<td><? echo $p["month"] ?></td>
			<td><? echo $p["year"] ?></td>
		</tr>
		<?}?>
	</tbody>
</table>
</div>