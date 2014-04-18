<div class="modal fade purchase-form" tabindex="-1" role="dialog" aria-labelledby="purchaseModal" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: #FFF;">&times;</button>
				<h4 class="modal-title text-center">ORDER INFO</h4>
			</div>
			<div class="modal-body">
				<!-- FORM Starts-->
				<form role="form" method="post" action="payment.php">
					<section class="row purchase-radio">
						<div class="col-lg-4 col-md-4">
							<div class="radio">
								<label>
									<input type="radio" name="packagesRadios" id="package1" value="package1" checked>
									Package 1
								</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="radio">
								<label>
									<input type="radio" name="packagesRadios" id="package2" value="package2">
									Package 2
								</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="radio">
								<label>
									<input type="radio" name="packagesRadios" id="package3" value="package3">
									Package 3
								</label>
							</div>
						</div>
					</section>
					<section class="form-group">
						<input type="text" class="form-control" id="first-name" name="first-name" placeholder="First Name" required>
					</section>
					<section class="form-group">
						<input type="text" class="form-control" id="last-name" name="last-name" placeholder="Last Name" required>
					</section>
					<section class="form-group">
						<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
					</section>
					<section class="form-group">
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
					</section>
					
					<section class="row shipping-address">
						<p>Shipping Address</p>
						<div class="col-sm-12">
							<section class="form-group">
								<input type="text" class="form-control" id="address1" name="shipping-addr1" placeholder="Address Line 1" required>
							</section>
							<section class="form-group">
								<input type="text" class="form-control" id="address2" name="shipping-addr2" placeholder="Address Line 2 (Optional)">
							</section>
							<div class="row">
								<section class="form-group col-sm-6">
									<input type="text" class="form-control" id="city" name="shipping-city" placeholder="City" required>
								</section>
								<section class="form-group col-sm-3">
									<input type="text" class="form-control" id="zip" name="shipping-zip" placeholder="Zip" required>
								</section>
								<section class="form-group col-sm-3">
									<input type="text" class="form-control" id="state" name="shipping-state" placeholder="State" required>
								</section>
							</div>
							<section class="form-group">
								<input type="text" class="form-control" id="country" name="shipping-country" placeholder="Country" required>
							</section>
						</div>
					</section>
					<br>
					<section class="row text-center">
						<input class="btn btn-warning btn-lg" type="submit" value="Continue">
					</section>
				</form>
				<!-- END of FORM -->
			</div>
		</div>
	</div>
</div>