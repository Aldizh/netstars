<?php
	ob_start();
	session_start();
	include("../includes-in/header.php");
	include("../config.php");
	$config = new Config();
	$connection = $config->connect("209.200.231.164", "ciaot1", "mSaKSeZXt0TK");
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
	&& ($_FILES["file"]["size"] < 500000)
	&& in_array($extension, $allowedExts))
	{
	  if ($_FILES["file"]["error"] > 0)
	  {
	    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	  }
	  else
	  {
	    //echo "Upload: " . $_FILES["file"]["name"] . "<br>";
	    //echo "Type: " . $_FILES["file"]["type"] . "<br>";
	    //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

	    if (file_exists("upload/" . $_FILES["file"]["name"]))
	    {
	      echo $_FILES["file"]["name"] . " already exists. ";
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

<form action="<? $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
	<input type="file" name="file"><br>
	<input type="submit" value="Upload">
</form>

<?include("../includes-in/footer.php"); ?>