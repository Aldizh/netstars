<?php
	session_start();
	include("../includes-in/header.php");
	include("../config.php");
?>

<?
	$config = new Config();
	$connection = $config->connect("209.200.231.164", "ciaot1", "mSaKSeZXt0TK");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}

	$sql_read = "SELECT * FROM `customers` WHERE ID like '$_SESSION[id]'";
	$result = mysql_query($sql_read);
	if ($result == false){die(var_dump(mysql_error()));}
	$row = mysql_fetch_row($result);
	$id = $row[0];
	$position = $row[10];
	$leftChild = $row[22];
	$rightChild = $row[23];
?>

<div class="row portal-container">
	<section class="col-lg-3 col-md-3 member-nav">
		<?php include("../includes-in/portal-nav.php");?>
	</section>
	<section class="visible-xs col-9-xs">
		<p class="text-center">This page is not viewable on small screen devices</p>
	</section>
	<section class="col-lg-9 col-md-9 col-sm-9 my-network-wrapper hidden-xs">
		<div class="row"> <!-- First Level -->
			<section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<table class="table table-bordered tree-table">
				  <tr>
					  <td>ID</td>
					  <td><?=$id?></td>
				  </tr>
				  <tr>
					  <td>Left</td>
					  <td><?=$leftChild?></td>
				  </tr>
				  <tr>
					  <td>Right</td>
					  <td><?=$rightChild?></td>
				  </tr>
				  <tr>
					  <td>Position</td>
					  <td><?=$position?></td>
				  </tr>
				</table>
			</section>
		</div>
		<?
			$sql_read = "SELECT * FROM `customers` WHERE ID like '$leftChild'";
			$result = mysql_query($sql_read);
			if ($result == false){die(var_dump(mysql_error()));}
			$row = mysql_fetch_row($result);
			$id_left = $row[0];
			$position_left = $row[10];
			$leftChild_left = $row[22];
			$leftChild_right = $row[23];
		?>
		<div class="row"><!-- Second Level -->
			<section class="col-lg-6 col-md-6 col-md-6 col-xs-6">
				<table class="table table-bordered tree-table pull-right">
				  <tr>
					  <td>ID</td>
					  <td><?=$id_left?></td>
				  </tr>
				  <tr>
					  <td>Left</td>
					  <td><?=$leftChild_left?></td>
				  </tr>
				  <tr>
					  <td>Right</td>
					  <td><?=$leftChild_right?></td>
				  </tr>
				  <tr>
					  <td>Position</td>
					  <td><?=$position_left?></td>
				  </tr>
				</table>
			</section>
			<?
				$sql_read = "SELECT * FROM `customers` WHERE ID like '$rightChild'";
				$result = mysql_query($sql_read);
				if ($result == false){die(var_dump(mysql_error()));}
				$row = mysql_fetch_row($result);
				$id_right = $row[0];
				$position_right = $row[10];
				$rightChild_left = $row[22];
				$rightChild_right = $row[23];
			?>
			<section class="col-lg-6 col-md-6 col-md-6 col-xs-6">
				<table class="table table-bordered tree-table pull-right">
				  <tr>
					  <td>ID</td>
					  <td><?=$id_right?></td>
				  </tr>
				  <tr>
					  <td>Left</td>
					  <td><?=$rightChild_left?></td>
				  </tr>
				  <tr>
					  <td>Right</td>
					  <td><?=$rightChild_right?></td>
				  </tr>
				  <tr>
					  <td>Position</td>
					  <td><?=$position_right?></td>
				  </tr>
				</table>
			</section>
		</div>
		<div class="row"><!-- Third Level -->
				<section class="col-lg-3 col-md-3 col-md-3 col-xs-3">
					<?
						$sql_read = "SELECT * FROM `customers` WHERE ID like '$leftChild_left'";
						$result = mysql_query($sql_read);
						if ($result == false){die(var_dump(mysql_error()));}
						$row = mysql_fetch_row($result);
						$id_left1 = $row[0];
						$position_left1 = $row[10];
						$leftChild_left1 = $row[22];
						$rightChild_left1 = $row[23];
					?>
					<table class="table table-bordered tree-table pull-right">
					  <tr>
						  <td>ID</td>
						  <td><?=$id_left1?></td>
					  </tr>
					  <tr>
						  <td>Left</td>
						  <td><?=$leftChild_left1?></td>
					  </tr>
					  <tr>
						  <td>Right</td>
						  <td><?=$rightChild_left1?></td>
					  </tr>
					  <tr>
						  <td>Position</td>
						  <td><?=$position_left1?></td>
					  </tr>
					</table>
				</section>
				<section class="col-lg-3 col-md-3 col-md-3 col-xs-3">
					<?
						$sql_read = "SELECT * FROM `customers` WHERE ID like '$leftChild_right'";
						$result = mysql_query($sql_read);
						if ($result == false){die(var_dump(mysql_error()));}
						$row = mysql_fetch_row($result);
						$id_right1 = $row[0];
						$position_right1 = $row[10];
						$leftChild_right1 = $row[22];
						$leftChild_right1 = $row[23];
					?>
					<table class="table table-bordered tree-table">
					  <tr>
						  <td>ID</td>
						  <td><?=$id_right1?></td>
					  </tr>
					  <tr>
						  <td>Left</td>
						  <td><?=$leftChild_right1?></td>
					  </tr>
					  <tr>
						  <td>Right</td>
						  <td><?=$leftChild_right1?></td>
					  </tr>
					  <tr>
						  <td>Position</td>
						  <td><?=$position_right1?></td>
					  </tr>
					</table>
				</section>
				<section class="col-lg-3 col-md-3 col-md-3 col-xs-3">
					<?
						$sql_read = "SELECT * FROM `customers` WHERE ID like '$rightChild_left'";
						$result = mysql_query($sql_read);
						if ($result == false){die(var_dump(mysql_error()));}
						$row = mysql_fetch_row($result);
						$id_left2 = $row[0];
						$position_left2 = $row[10];
						$leftChild_left2 = $row[22];
						$rightChild_left2 = $row[23];
					?>
					<table class="table table-bordered tree-table pull-right">
					  <tr>
						  <td>ID</td>
						  <td><?=$id_left2?></td>
					  </tr>
					  <tr>
						  <td>Left</td>
						  <td><?=$leftChild_left2?></td>
					  </tr>
					  <tr>
						  <td>Right</td>
						  <td><?=$rightChild_left2?></td>
					  </tr>
					  <tr>
						  <td>Position</td>
						  <td><?=$position_left2?></td>
					  </tr>
					</table>
				</section>
				<section class="col-lg-3 col-md-3 col-md-3 col-xs-3">
					<?
						$sql_read = "SELECT * FROM `customers` WHERE ID like '$rightChild_right'";
						$result = mysql_query($sql_read);
						if ($result == false){die(var_dump(mysql_error()));}
						$row = mysql_fetch_row($result);
						$id_right2 = $row[0];
						$position_right2 = $row[10];
						$leftChild_right2 = $row[22];
						$rightChild_right2 = $row[23];
					?>
					<table class="table table-bordered tree-table pull-right">
					  <tr>
						  <td>ID</td>
						  <td><?=$id_right2?></td>
					  </tr>
					  <tr>
						  <td>Left</td>
						  <td><?=$leftChild_right2?></td>
					  </tr>
					  <tr>
						  <td>Right</td>
						  <td><?=$rightChild_right2?></td>
					  </tr>
					  <tr>
						  <td>Position</td>
						  <td><?=$position_right2?></td>
					  </tr>
					</table>
				</section>
			</div>
		</div>
		<div class="row"><!-- Fourth Level -->
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
			<section class="custom_col"></section>
		</div>
	</section>
</div>
			
			
<?php include('../includes-in/footer.php'); ?>
