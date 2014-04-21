<?php 
	session_start();
	include("includes/header.php");
	//echo $_SESSION["membership"];
	//echo $_SESSION["id_pending"];
?>

<section class="row banner-home">
	<div class="order-info-wrapper">
		<? if ($_SESSION["membership"] == "partner"){ ?>
			<h1>Partner Package</h1>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="JE4YM98DFNN4E">
				<input type="hidden" name="custom" value="id=<?=$_SESSION["id_pending"]?>">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>

		<?} else if ($_SESSION["membership"] == "personal"){?>
			<h2>Personal Package</h2>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="FBLNS9SPCWBYY">
				<input type="hidden" name="custom" value="id=<?=$_SESSION["id_pending"]?>">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>

		<?} else {?>
			<h2>Business Package</h2>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" onsubmit="return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="LT2QV5NQ6BEQ6">
				<input type="hidden" name="custom" value="id=<?=$_SESSION["id_pending"]?>">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
		<?}?>
	</div>
</section>

<?php include('includes/footer.php'); ?>