<?php include("includes/header.php"); ?>
<div class="row signup-container">
	<section class="form-box">
		<h4> SIGN UP FORM </h4>
		<form role="form">
  		  <div class="form-group">
  		    <input type="text" class="form-control" id="ref-code" placeholder="Referal Code (if any)">
  		  </div>
  		  <div class="form-group">
		      <section class="row">
				  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					  <div class="radio">
					    <label>
					      <input type="radio" name="optionsRadios" id="partner" value="partner" checked>
					      Partner
					    </label>
					  </div>
				  </div>
				  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
 					 <div class="radio">
 					   <label>
 					     <input type="radio" name="optionsRadios" id="personal" value="personal">
 					     Personal
 					   </label>
 					 </div>
				  </div>
				  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					  <div class="radio">
					    <label>
					      <input type="radio" name="optionsRadios" id="business" value="business">
					      Business
					    </label>
					  </div>
				  </div>
			  </section>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" id="first-name" placeholder="First Name *" required>
		  </div>
		  <div class="form-group">
		    <input type="text" class="form-control" id="last-name" placeholder="Last Name *" required>
		  </div>
		  <div class="form-group">
		    <input type="email" class="form-control" id="email" placeholder="Email *" required>
		  </div>
		  <div class="form-group">
		    <input type="phone" class="form-control" id="phone" placeholder="Phone *" required>
		  </div>
		  <button type="submit" class="btn btn-primary">Continue</button>
		</form>
	</section>
</div>
<?php include('includes/footer.php'); ?>
