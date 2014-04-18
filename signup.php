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
				  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					  <div class="radio">
					    <label>
					      <input type="radio" name="optionsRadios" id="partner" value="direct" checked>
					      <label>Direct Sales</label>
					    </label>
					  </div>
				  </div>
				  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					  <div class="radio">
					    <label>
					      <input type="radio" name="optionsRadios" id="partner" value="partner">
					      <label>Partner</label>
					    </label>
					  </div>
				  </div>
				  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
 					 <div class="radio">
 					   <label>
 					     <input type="radio" name="optionsRadios" id="personal" value="personal">
					      <label>Personal</label>
 					   </label>
 					 </div>
				  </div>
				  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					  <div class="radio">
					    <label>
					      <input type="radio" name="optionsRadios" id="business" value="business">
					      <label>Business</label>
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
