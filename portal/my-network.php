<?php
	session_start();
	include("../includes-in/header.php");
	include("../config.php");
?>

<?
	$config = new Config();
    $connection = $config->connect("localhost", "NetStar", "kRJd7tW3PLc3m4");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}

	$sql_read = "SELECT * FROM `customers` WHERE ID like '$_SESSION[id]'";
	$result = mysql_query($sql_read);
	if ($result == false){die(var_dump(mysql_error()));}
	$row = mysql_fetch_row($result);
	$sponsor_id = $row[1];



?>

<div class="row portal-container">
	<section class="col-lg-3 col-md-3 member-nav">
		<?php include("../includes-in/portal-nav.php");?>
	</section>
	<section class="visible-xs col-9-xs">
		<p class="text-center">This page is not viewable on small screen devices</p>
	</section>
	<section class="col-lg-9 col-md-9 col-sm-9 my-network-wrapper hidden-xs">
		
		<div id="canvasbin" style="height:700px; width:100%;"  align="center">

			<!-- ############## Sponsor LVL PHP  ########################   -->
			<?
				$sql_read = "SELECT * FROM `customers` WHERE ID like '$sponsor_id'";
				$result = mysql_query($sql_read);
				if ($result == false){
					$sponsor_name = "";
					die(var_dump(mysql_error()));
				}
				$row = mysql_fetch_row($result);
				$sponsor_name = $row[6]; // This is where it gets the sponsor's name for the logged in user
			?>

			<!-- ############## SPONSOR Display  ########################   -->

			<div class="node" style="clear:both; width:100%;">
				<div style="width:80px; height:30px;" align="center">
					<img src="http://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Crystal_Clear_kdm_user_male.png/50px-Crystal_Clear_kdm_user_male.png">
				</div>
				<div><?=$sponsor_name?></div>
			</div>

			<!-- ############## 1st LVL separation ########################   -->
			<div style="clear:both;">
				<div style="width:1px; border-left:1px solid #9E6A36; border-right:1px solid #9E6A36; margin-top:1px; height:10px; padding-bottom:10x;"></div>
			</div>

			<!-- ############## 1st LVL PHP (logged in user)  ########################   -->
			<?
				$sql_read = "SELECT * FROM `customers` WHERE ID like '$_SESSION[id]'";
				$result = mysql_query($sql_read);
				if ($result == false){
					$name = "";
					die(var_dump(mysql_error()));
				}
				$row = mysql_fetch_row($result);
				$name = $row[6]; // This is where it gets the name of the logged in user
				$leftChild = $row[22];
				$rightChild = $row[23];
			?>

			<!-- ############## 1st LVL (Logged in user Display) ########################   -->
			<div class="node" style="clear:both; width:100%;">
				<div style="margin-top:10px; width:96px; height:84px;" align="center">
					<img src="http://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Crystal_Clear_kdm_user_male.png/50px-Crystal_Clear_kdm_user_male.png">
				</div>
				<div><?=$name?></div>
			</div>

			<!-- ############## 2nd LVL separation ########################   -->
			<div style="clear:both;">
				<div style="width:50%;border-top:1px solid #9E6A36;  border-left:1px solid #9E6A36; border-right:1px solid #9E6A36; margin-top:15px; height:10px; margin-bottom:5x;"></div>
			</div>

			<!-- ############## 2nd LVL PHP  ########################   -->
			<?
				$sql_read = "SELECT * FROM `customers` WHERE ID like '$leftChild'";
				$result = mysql_query($sql_read);
				if ($result == false){
					$name_left = "";
					die(var_dump(mysql_error()));
				}
				$row = mysql_fetch_row($result);
				$name_left = $row[6];
				$leftChild_left = $row[22];
				$leftChild_right = $row[23];
			?>

			<?
				$sql_read = "SELECT * FROM `customers` WHERE ID like '$rightChild'";
				$result = mysql_query($sql_read);
				if ($result == false){
					$name_right = "";
					die(var_dump(mysql_error()));
				}
				$row = mysql_fetch_row($result);
				$name_right = $row[6];
				$rightChild_left = $row[22];
				$rightChild_right = $row[23];
			?>

			<!-- ############## 2nd LVL Display LEFT and RIGHT  ########################   -->
	
			<div class="node" style="width:50% ; float:left; ">
				<div style="width:84px; height:64px; " align="center">
					<a href="#">
						<img src="http://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Crystal_Clear_kdm_user_male.png/50px-Crystal_Clear_kdm_user_male.png">
					</a>
				</div>
				<div><?=$name_left?></div>
			</div>
			<div class="node" style="width:50% ; float:left; ">
				<div style="width:84px; height:64px;" align="center" > 
					<a href="#">
						<img src="http://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Crystal_Clear_kdm_user_male.png/50px-Crystal_Clear_kdm_user_male.png">
					</a>
				</div>
				<div><?=$name_right?></div>
			</div>

			<!-- ############## 3rd LVL Separation ########################   -->
			<div style="clear:both">
				<div class="node" style="width:50%; float:left; " align="center">
					<div style="width:50%;border-top:1px solid #9E6A36;  border-left:1px solid #9E6A36; border-right:1px solid #9E6A36; margin-top:15px; height:10px; margin-bottom:5x;"></div>
				</div>
				<div class="node" style="width:50%; float:left; ">
					<div style="width:50%;border-top:1px solid #9E6A36;  border-left:1px solid #9E6A36; border-right:1px solid #9E6A36; margin-top:15px; height:10px; margin-bottom:5x;"></div>
				</div>
			</div>

			<!-- ############## 3rd LVL PHP  ########################   -->
			<?
				$sql_read = "SELECT * FROM `customers` WHERE ID like '$leftChild_left'";
				$result = mysql_query($sql_read);
				if ($result == false){
					$name_left1 = "";
					die(var_dump(mysql_error()));
				}
				$row = mysql_fetch_row($result);
				$name_left1 = $row[6];
				$leftChild_left1 = $row[22];
				$rightChild_left1 = $row[23];
			?>
			<?
				$sql_read = "SELECT * FROM `customers` WHERE ID like '$leftChild_right'";
				$result = mysql_query($sql_read);
				if ($result == false){
					$name_right1 = "";
					die(var_dump(mysql_error()));
				}
				$row = mysql_fetch_row($result);
				$name_right1 = $row[6];
				$leftChild_right1 = $row[22];
				$leftChild_right1 = $row[23];
			?>
			<?
				$sql_read = "SELECT * FROM `customers` WHERE ID like '$rightChild_left'";
				$result = mysql_query($sql_read);
				if ($result == false){
					$name_left2 = "";
					die(var_dump(mysql_error()));
				}
				$row = mysql_fetch_row($result);
				$name_left2 = $row[6];
				$leftChild_left2 = $row[22];
				$rightChild_left2 = $row[23];
			?>
			<?
				$sql_read = "SELECT * FROM `customers` WHERE ID like '$rightChild_right'";
				$result = mysql_query($sql_read);
				if ($result == false){
					$name_right2 = "";
					die(var_dump(mysql_error()));
				}
				$row = mysql_fetch_row($result);
				$name_right2 = $row[6];
				$leftChild_right2 = $row[22];
				$rightChild_right2 = $row[23];
			?>

			<!-- ############## 3rd LVL  ########################   -->

			<div class="node" style="width:25% ; float:left;">
				<div style="width:64px; height:64px;" align="center" >
					<a href="#">
						<img src="http://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Crystal_Clear_kdm_user_male.png/50px-Crystal_Clear_kdm_user_male.png">
					</a>
				</div>
				<div><?=$name_left1?></div>
			</div>

			<div class="node" style="width:25%; float:left;">
				<div style="width:64px; height:64px;" align="center" >
					<a href="#">
						<img src="http://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Crystal_Clear_kdm_user_male.png/50px-Crystal_Clear_kdm_user_male.png">
					</a>
				</div>
				<div><?=$name_right1?></div>
			</div>
			
			<div class="node" style="width:25%; float:left;">
				<div style="width:64px; height:64px;" align="center" >
					<a href="#">
						<img src="http://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Crystal_Clear_kdm_user_male.png/50px-Crystal_Clear_kdm_user_male.png">
					</a>
				</div>
				<div><?=$name_left2?></div>
			</div>
			
			<div class="node" style="width:25%; float:left;">
				<div style="width:64px; height:64px;" align="center" >
					<a href="#">
						<img src="http://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Crystal_Clear_kdm_user_male.png/50px-Crystal_Clear_kdm_user_male.png">
					</a>
				</div>
				<div><?=$name_right2?></div>
			</div>
		</div>
	</section>
</div>
			
			
<?php include('../includes-in/footer.php'); ?>
