<?php 
	ob_start();
	session_start(); 
	include("../includes-in/header.php");
	include("../config.php");
?>
<?
	$config = new Config();
	$connection = $config->connect("209.200.231.164", "ciaot1", "mSaKSeZXt0TK");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}

	if ($_GET["user"]){$desc = $_GET["user"];}
	else{
		$desc = "NexXStar";
	}
	$regexp = "/[- a-zA-Z]+$/";
	if (preg_match($regexp, $_GET["user"])){
		$username = trim(htmlspecialchars($_GET["user"]));
		$sql_read = "SELECT * FROM `customers` WHERE username like '$username'";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_row($result);
		$_SESSION["username"] = $row[3];
	}
?>
<h1 class="text-center"><?=$desc?>'s Store</h1>
<div class="row store-container">
	<form>
		<section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="row">
				<section class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="thumbnail">
				      <img src="../images/product-card.png" width="300" height="200" alt="Product Card">
				      <div class="caption">
				        <p>NeXStars Card</p>
						<p><strong> US $100.00</strong></p>
				      </div>
					  <div class="checkbox">
					      <input type="checkbox" value="">
					  </div>
				    </div>
				</section>
				<section class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="thumbnail">
				      <img src="../images/product-card.png" width="300" height="200" alt="Product Card">
				      <div class="caption">
				        <p>Web Advertising</p>
						<p><strong> US $100.00</strong></p>
				      </div>
					  <div class="checkbox">
					      <input type="checkbox" value="">
					  </div>
				    </div>
				</section>
				<section class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="thumbnail">
				      <img src="../images/product-card.png" width="300" height="200" alt="Product Card">
				      <div class="caption">
				        <p>Mobile</p>
						<p><strong> US $100.00</strong></p>
				      </div>
					  <div class="checkbox">
					      <input type="checkbox" value="">
					  </div>
				    </div>
				</section>
			</div>
			<div class="row">
				<section class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="thumbnail">
				      <img src="../images/product-card.png" width="300" height="200" alt="Product Card">
				      <div class="caption">
				        <p>NeXStars Card</p>
						<p><strong> US $100.00</strong></p>
				      </div>
					  <div class="checkbox">
					      <input type="checkbox" value="">
					  </div>
				    </div>
				</section>
				<section class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="thumbnail">
				      <img src="../images/product-card.png" width="300" height="200" alt="Product Card">
				      <div class="caption">
				        <p>Web Advertising</p>
						<p><strong> US $100.00</strong></p>
				      </div>
					  <div class="checkbox">
					      <input type="checkbox" value="">
					  </div>
				    </div>
				</section>
				<section class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="thumbnail">
				      <img src="../images/product-card.png" width="300" height="200" alt="Product Card">
				      <div class="caption">
				        <p>Mobile</p>
						<p><strong> US $100.00</strong></p>
				      </div>
					  <div class="checkbox">
					      <input type="checkbox" value="">
					  </div>
				    </div>
				</section>
			</div>
			<div class="row">
				<section class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="thumbnail">
				      <img src="../images/product-card.png" width="300" height="200" alt="Product Card">
				      <div class="caption">
				        <p>NeXStars Card</p>
						<p><strong> US $100.00</strong></p>
				      </div>
					  <div class="checkbox">
					      <input type="checkbox" value="">
					  </div>
				    </div>
				</section>
				<section class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="thumbnail">
				      <img src="../images/product-card.png" width="300" height="200" alt="Product Card">
				      <div class="caption">
				        <p>Web Advertising</p>
						<p><strong> US $100.00</strong></p>
				      </div>
					  <div class="checkbox">
					      <input type="checkbox" value="">
					  </div>
				    </div>
				</section>
				<section class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="thumbnail">
				      <img src="../images/product-card.png" width="300" height="200" alt="Product Card">
				      <div class="caption">
				        <p>Mobile</p>
						<p><strong> US $100.00</strong></p>
				      </div>
					  <div class="checkbox">
					      <input type="checkbox" value="">
					  </div>
				    </div>
				</section>
			</div>
			<div class="row">
			    <button type="submit" class="btn btn-primary pull-right">Continue</button>
			</div>
		</section>
		
	</form>
</div>
<?php include('../includes-in/footer.php'); ?>
