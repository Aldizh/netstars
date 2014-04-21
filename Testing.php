

<?php
if (function_exists('mysql_connect')) {
echo " php mysql exists";

} else {

echo " we have a problem";
}
echo " testings";
error_reporting(E_ALL);
class Config{
	function connect($host="", $user="", $pass=""){
	
		$conn = mysql_connect($host, $user, $pass);
	echo "inside class";
		if(!$conn)
			die("Cannot connect to  MySQL");
		return $conn;
	}
}
?>

<?php
echo " etsting " ;

$config = new Config();
echo "test";
	$connection = $config->connect("localhost", "NetStar", "kRJd7tW3PLc3m");
echo "connectino";
	$dbconn = mysql_select_db("ciaot1_netex", $connection);	
	if(!$dbconn){die("Could not select DB");}

echo "testing";

?>
