<? session_start() ?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NexXstars | Network of Tech Products for Entrepreneurs</title>
	<meta name="description" conten="Technology crowdsourced. NexXStars affords a unique business opportunity for young enttrepreneurs who love tech products.">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/custom.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Gilda+Display' rel='stylesheet' type='text/css'>
	<script src="../js/respond.min.js"></script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-50112144-1', 'nexxstars.com');
	  ga('send', 'pageview');
	</script>
</head>

<body>
	<div class="container-fluid">
		<section class="row header">
			<div class="col-lg-2 col-md-2 col-sm-6 hidden-xs text-center">
				<a href="../index.php"><img src="../images/logo.png" alt="Logo"></a>
				<p style="color: #FFF; font-size: 0.8em; margin-left:4.2em;"><em>Technology Crowdsourced</em></p>
			</div>
			<div class="col-xs-6 text-center visible-xs">
				<a href="../index.php"><img src="../images/logo-mobile.png" alt="Logo"></a>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 nav-wrapper hidden-xs">
				<nav class="navbar navbar-default pull-right" role="navigation">
					<div class="container-fluid">

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<? if ($_SESSION["id"] == NULL) {?>
									<li><a href="home.php">Dashboard</a></li>
									<li><a href="../about.php">About</a></li>
									<li><a href="../membership.php">Membership</a></li>
									<li><a href="../products.php">Products</a></li>
									<li><a href="../opportunity.php">Opportunity</a></li>
									<?if ($_SESSION["admin"] == true){?>
										<li><a href="pending_approvals.php">Approvals</a></li>
									<?}?>
									<li><a href="#" data-toggle="modal" data-target=".contact-us">Contact Us</a></li>
									<li class="dropdown" style="font-size: 90%; font-weight: bold;">
									    <!--a class="dropdown-toggle" data-toggle="dropdown" href="#">
									      EN <span class="caret"></span>
									    </a>
									    <ul class="dropdown-menu">
									      <li><a href="../index.php">EN</a></li>
									      <li><a href="../es/index.php">ES</a></li>
									    </ul-->
									</li>
								<?}?>
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div>
			
			<!-- NAV for smaller screen -->
			
			<div class="col-lg-10 col-md-10 col-sm-6 col-xs-6 nav-wrapper hidden-lg hidden-md hidden-sm">
				<nav class="navbar navbar-default" role="navigation">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navs-for-mobile">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="navs-for-mobile">
							<ul class="nav navbar-nav">
								<li><a href="about.php">About</a></li>
								<li><a href="membership.php">Membership</a></li>
								<li><a href="products.php">Products</a></li>
								<li><a href="opportunity.php">Opportunity</a></li>
								<li class="dropdown" style="font-size: 90%; font-weight: bold;">
								    <!--a class="dropdown-toggle" data-toggle="dropdown" href="#">
								      EN <span class="caret"></span>
								    </a>
								    <ul class="dropdown-menu">
								      <li><a href="../index.php">EN</a></li>
								      <li><a href="../es/index.php">ES</a></li>
								    </ul-->
								</li>
								<!-- 
									<li><button class="btn btn-default btn-lg" data-toggle="modal" data-target=".purchase-form">Get Started</button></li>
									-->
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div>
		</section>
		<section class="row visible-xs login-signup-mobile">
			<div class="col-xs-12 text-center">
				<a href="../index.php?logout=true" class="btn btn-success btn-sm">LOGOUT</a>
			</div>
		</section>