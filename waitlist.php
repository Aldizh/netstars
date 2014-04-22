<?php
	include("includes/header.php");
	$title = "NexxStars Waitlist"
?>

<div class="row signup-container">
	<section class="form-box">
		<h4>Get on the NexxStars Waitlist</h4>
		<form name="nexxstars join list" action="http://ciaocrm.com//modules/Webforms/capture.php" method="post" accept-charset="utf-8">
		<!-- Hidden, for CRM only -->
		<input type="hidden" name="publicid" value="2daaeec28f55df7b710f07f9a0c52ab8">
		<input type="hidden" name="name" value="nexxstars join list">
		<div style="display:none;">
			<select name="leadsource">
				<option value="netxxstars wait list">netxxstars wait list</option>
			</select>
  		  </div>
		  <!-- End hidden -->
		  <div class="form-group">
		    <input type="text" class="form-control" name="firstname" placeholder="First Name *" maxlength="30" value="" required>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" name="lastname" placeholder="Last Name *" maxlength="30" value="" required>
		  </div>
		  <div class="form-group">
		  		    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone *" maxlength="30" value="" required>
		  		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" name="email" placeholder="Email *" maxlength="30" value="" required>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" name="country" placeholder="Country *" maxlength="70" value="" required>
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Waitlist Me</button>
		</form>
	</section>
</div>


<?php include('includes/footer.php'); ?>