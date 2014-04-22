<?php 
	session_start();
	include("includes/header.php");
	//echo $_SESSION["membership"];
	//echo $_SESSION["id_pending"];
?>

<div class="row moreclass text-center">
	<section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h1>Verify your details below</h1>
		<ul class="list-group text-left">
			<li class="list-group-item list-group-item-info"><strong>Username</strong>: <?php echo($_SESSION["username"]); ?></li>
			<li class="list-group-item list-group-item-info"><strong>Password</strong>: ********</li>
			<li class="list-group-item list-group-item-info"><strong>First</strong> Name: <?php echo($_SESSION["firstname"]); ?></li>
			<li class="list-group-item list-group-item-info"><strong>Last Name</strong>: <?php echo($_SESSION["lastname"]); ?></li>
			<li class="list-group-item list-group-item-info"><strong>Address</strong>: <?php echo($_SESSION["address"]); ?></li>
			<li class="list-group-item list-group-item-info"><strong>Email</strong>: <?php echo($_SESSION["email"]); ?></li>
			<li class="list-group-item list-group-item-info"><strong>Phone</strong>: <?php echo($_SESSION["phone"]); ?></li>
		</ul>
	</section>
</div>

<div class="row moreclass text-center">
	<section class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	<a href="signup.php?code=<?echo $_SESSION['referralcode']?>"><button class="btn btn-success">Edit Details</button></a></section>
	<section class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

<?php
if (($_SESSION["membership"] == 'partner')) {?>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" >
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="JE4YM98DFNN4E">
		<input type="hidden" name="custom" value="id=<?=$_SESSION["id_pending"]?>">
		<input type="submit" name="submit" class="btn btn-primary" value="Proceed to Checkout">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
<?}?>
<?php
if (($_SESSION["membership"] == 'personal')) {?>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" >
		<input type="hidden" name="hosted_button_id" value="FBLNS9SPCWBYY">
		<input type="hidden" name="custom" value="id=<?=$_SESSION["id_pending"]?>">
		<input type="submit" name="submit" class="btn btn-primary" value="Proceed to Checkout">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
<?}?>
<?php
if (($_SESSION["membership"] == 'business')) {?>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" >
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="LT2QV5NQ6BEQ6">
		<input type="hidden" name="custom" value="id=<?=$_SESSION["id_pending"]?>">
		<input type="submit" name="submit" class="btn btn-primary" value="Proceed to Checkout">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
<?}?>
	</section>
</div>	
	
<style>
.moreclass {width:400px;margin:20px auto 0;}
.btn-primary {font-size:14px;padding:10px;} 
.col-sm-12, .col-xs-12 {padding-bottom:10px;}
</style>

<?php include('includes/footer.php'); ?>