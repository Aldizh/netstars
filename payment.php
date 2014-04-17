<?php include("includes/header.php"); ?>
	<section class="row banner-home">
		<div class="order-info-wrapper">
			<ul class="list-group">
			<p>Your Info</p>
			  <li class="list-group-item">First Name: <strong><?php echo $_POST["first-name"]; ?></strong></li>
			  <li class="list-group-item">Last Name: <strong><?php echo $_POST["last-name"]; ?></strong></li>
			  <li class="list-group-item">Email: <strong><?php echo $_POST["email"]; ?></strong></li>
			  <li class="list-group-item">Phone Number: <strong><?php echo $_POST["phone"]; ?></strong></li>
			</ul>
		</div>
		<div class="order-info-wrapper">
			<ul class="list-group">
			<p>Shipping Address</p>
			  <li class="list-group-item">Address Line 1: <strong><?php echo $_POST["shipping-addr1"] ?></strong></li>
			  <li class="list-group-item">Address Line 2: <strong><?php echo $_POST["shipping-addr2"] ?></strong></li>
			  <li class="list-group-item">City: <strong><?php echo $_POST["shipping-city"] ?></strong></li>
			  <li class="list-group-item">State: <strong><?php echo $_POST["shipping-state"] ?></strong></li>
			  <li class="list-group-item">Zip/Pin Code: <strong><?php echo $_POST["shipping-zip"] ?></strong></li>
			  <li class="list-group-item">Country: <strong><?php echo $_POST["shipping-country"] ?></strong></li>
			</ul>
		</div>
		
	</section>

<?php include('includes/footer.php'); ?>
