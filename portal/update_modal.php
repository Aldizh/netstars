<?
	include ("../includes-in/header.php");
	session_start();
?>
<? if (isset($_GET["valid"]) and $_GET["valid"] == "false"){
?>
<div class='text-center'>Invalid password</div>
<?}?>
<div class="row portal-container">
	<section class="col-lg-3 col-md-3 member-nav">
		<? include("../includes-in/portal-nav.php"); ?>
	</section>
	<section class="col-lg-9 col-md-9 home-boxes">
		<div class="row">
			<div class="col-lg-6 col-md-6 home-boxes">
				<form role="form" method="post" action="../portal/update_profile.php">
				<div class="form-group">
				  <label> Please, enter current password </label>
				  <input type="password" class="form-control" name="oldpass" placeholder="Enter current password*" value="">
				</div>
				<div class='text-center'>
					<button type="submit" class="btn btn-success btn-md">Update</button>
				</div>
				</form>
			</div>
		</div>
	</section>
</div>
<? include ("../includes-in/footer.php"); ?>