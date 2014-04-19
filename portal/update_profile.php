<?
	ob_start();
	session_start(); 
	include("../includes-in/header.php");
	include("../config.php");
?>

<!-- PORTAL CONTENT starts -->
<div class="container" id="portal-wrapper">
	<div class="row">
		<!-- MENU-->
		<?php include("../includes/portal-menu.php"); ?>
		<!-- END of MENU -->
		
		<!-- DASHBOARD starts -->
		<section class="col-lg-9 col-md-9 col-sm-9">
			<!-- DASHBOARD Wrapper-->
			<form class="form-horizontal" action="<?$_SERVER['PHP_SELF']?>" method="post" role="form">
			  <div class="form-group">
			    <label for="Username" class="col-sm-4 control-label">Username</label>
			    <div class="col-sm-5">
			      <input type="text" name="username" class="form-control" id="inputEmail3" value=<?= $username;?> disabled>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="Password" class="col-sm-4 control-label">Password</label>
			    <div class="col-sm-5">
			      <input type="password" name="password" class="form-control" id="inputPassword3" value=<?= $password;?> disabled>
			    </div>
			  </div>
			 <div class="form-group">
			    <label for="First" class="col-sm-4 control-label">First Name</label>
			    <div class="col-sm-5">
			      <input type="text" name="firstname" class="form-control" id="inputEmail3" value=<?= $firstname;?> >
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="Last" class="col-sm-4 control-label">Last Name</label>
			    <div class="col-sm-5">
			      <input type="text" name="lastname" class="typeahead form-control" id="inputEmail3" value=<?= $lastname;?> >
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="Last" class="col-sm-4 control-label">Email</label>
			    <div class="col-sm-5">
			      <input type="text" name="email" class="form-control" id="inputEmail3" value=<?= $email;?> >
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="Last" class="col-sm-4 control-label">Phone</label>
			    <div class="col-sm-5">
			      <input type="text" name="phone" class="form-control" id="inputEmail3" value=<?= $phone;?> >
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="address" class="col-sm-4 control-label">Address</label>
			    <div class="col-sm-5">
			      <input type="textarea" name="address" class="form-control" id="address" value=<? foreach ($b_arr as $a){echo $a;}?> >
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="city" class="col-sm-4 control-label">City</label>
			    <div class="col-sm-3">
			      <input type="text" name="city" class="form-control" id="inputEmail3" value=<?= $city;?> >
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="zip" class="col-sm-4 control-label">Zip</label>
			    <div class="col-sm-3">
			      <input type="text" name="zip" class="form-control" id="inputEmail3" value=<?= $zip;?> >
			    </div>
				</label>
			  </div>
			  <div class="form-group">
			    <label for="zip" class="col-sm-4 control-label">State</label>
			    <div class="col-sm-3">
			      <input type="text" name="state" class="form-control" id="state" value=<?= $state;?> >
			    </div>
				</label>
			  </div>
			  <div class="form-group">
			    <label for="country" class="col-sm-4 control-label">Country</label>
			    <div class="col-sm-3">
			      <input type="text" name="country" class="form-control" id="state" value=<?= $country;?> >
			    </div>
				</label>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-4 col-sm-5">
			      <button type="submit" class="btn btn-default">Update</button>
			    </div>
			  </div>
			</form>
		</section>
	</div>
</div>