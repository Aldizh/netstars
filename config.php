<?
class Config{
	function connect($host="", $user="", $pass=""){
		$conn = mysql_connect($host, $user, $pass);
		if(!$conn)
			die("Cannot connect to  MySQL");
		return $conn;
	}
}
?>