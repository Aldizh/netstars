<?php
 ob_start();
 session_start();
 include("includes/header.php");
 include("config.php");
 $title = "NexxStars | Network of Tech Products for Entrepreneurs"
?>

<?
	$config = new Config();
	$connection = $config->connect("localhost", "NetStar", "G62267Fd8OX277z");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}

	//Take care of the logout
	if ($_GET["logout"] == true){
		session_unset();
		header("Location: index.php");
	}

	//Take care of login
	if (isset($_POST["username"]) and isset($_POST["password"])){
		$sql_read = "SELECT * FROM `customers` WHERE username like '$_POST[username]'";
		$result = mysql_query($sql_read);
		if ($result == false){die(var_dump(mysql_error()));}
		$row = mysql_fetch_row($result);
		if ($row[4] == sha1($_POST["password"])){
			$_SESSION["id"] = $row[0];
			$_SESSION["membership"] = $row[11];
			if ($row[28] == 1){
				$_SESSION["admin"] = true;
			}
			else{
				$_SESSION["admin"] = false;
			}
			header("Location: portal/home.php"); 
		} 
		else{
			echo "Invalid Password";
		}
	}
?>
<section class="row banner-home">
	<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
		<section id="home-banner-text-area">
			<h1><strong>Real</strong> Products</h1>
			<h1><strong>Real</strong> Profits</h1>
			<p>A network of great<br>
				tech products for the<br>
				young entrepreneur
			</p>
			<a href="waitlist.php" class="btn btn-primary btn-lg" >Get Started</a>
		</section>
	</div>
	<div class="col-xs-12 visible-xs">
		<section id="home-banner-text-area-xs">
			<h1><strong>Real</strong> Products</h1>
			<h1><strong>Real</strong> Profits</h1>
			<p>A network of great<br>
				tech products for the<br>
				young entrepreneur
			</p>
			<a href="waitlist.php" class="btn btn-primary btn-lg" >Get Started</a>
		</section>
	</div>
</section>
<section class="row steps-overview">
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center steps-overview-col">
		<img src="images/steps-preview-product.jpg" alt="Steps Preview Product">
		<p><strong>Great Tech Products</strong><br>
			Mobile plans, VoIP, IPTV, phones and security</p>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center steps-overview-col">
			<img src="images/steps-preview-track.jpg" alt="Steps Preview Track">
			<p><strong>Track Sales Online</strong><br>
				You get an online portal used to keep track of sales and profits</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center steps-overview-col">
				<img src="images/steps-preview-income.jpg" alt="Steps Preview Income">
				<p><strong>Stack Up Your Income</strong><br>
					Get the word out and watch the cash flow in</p>
				</div>
			</section>
			
			
			
<?php include('includes/footer.php'); ?>
