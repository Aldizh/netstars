<?php
	ob_start();
	session_start();
	include("../includes-in/header.php");
	include("../config.php");
	$config = new Config();
	$connection = $config->connect("localhost", "NetStar", "G62267Fd8OX277z");
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}
?>

<?
if ($_FILES["file"]){
	$allowedExts = array("gif", "jpeg", "jpg", "png", "pdf");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png")
	|| ($_FILES["file"]["type"] == "pdf"))
	&& ($_FILES["file"]["size"] < 5000000)
	&& in_array($extension, $allowedExts))
	{
	  if ($_FILES["file"]["error"] > 0)
	  {
	    //echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	  }
	  else
	  {
	    //echo "Upload: " . $_FILES["file"]["name"] . "<br>";
	    //echo "Type: " . $_FILES["file"]["type"] . "<br>";
	    //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

	    if (file_exists("upload/" . $_SESSION[id] . "_" . $_FILES["file"]["name"]))
	    {
	      echo "<h4>You have already submitted: " . $_FILES["file"]["name"] . "</h4>";
	    }
	    else
	    {
			move_uploaded_file($_FILES["file"]["tmp_name"],
			"upload/" . $_SESSION[id] . "_" . $_FILES["file"]["name"]);
			//echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
			$path = "upload/" . $_FILES["file"]["name"];
			$sql_update = "UPDATE `ciaot1_netex`.`customers` SET `document_location` = '$path' WHERE `customers`.`ID` = '$_SESSION[id]';";
			$result_update = mysql_query($sql_update);
			if ($result_update == false){die(var_dump(mysql_error()));}
			else{
				echo "<h3>Thank you for submitting your documents, we are reviewing them and will get back to you asap.</h3>";
			}
		}
	  }
	}
	else
	  {echo "Invalid file";}
}
?>
<div class="row portal-container">
	<section class="col-lg-3 col-md-3 member-nav">
		<? include("../includes-in/portal-nav.php"); ?>
	</section>
	<section class="col-lg-9 col-md-9 home-boxes">
		<h4><strong>Identity Verification</strong></h4>
		<em><p style="font-weight:300; font-size:90%; text-align:left;">please upload one of the following documents to verify your identity so that we can approve your application. The document must be unexpired.</p></em>
		<ul class="list-group" style="width: 500px;">
		  <li class="list-group-item">State issued Driver License or Identification Card</li>
		  <li class="list-group-item">Passport</li>
		  <li class="list-group-item">Green Card</li>
		  <li class="list-group-item">Work Permit</li>
		  <li class="list-group-item">Birth Certificate</li>
		  <li class="list-group-item">Government issued ID (International)</li>
		</ul>
		<form action="<? $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
			<input type="file" name="file"><br>
			<input type="submit" value="Upload">
		</form>
	</section>
</div>

<?include("../includes-in/footer.php"); ?>