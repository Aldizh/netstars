<?
	ob_start();
	session_start();
	include("includes/header.php");
?>

<?php //print_r($_POST); ?>
<?php
	$first_name = $_POST["firstname"];
	$last_name = $_POST["lastname"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$country = $_POST["country"];
	$message = $_POST["comment"];

	$fields =array (
			'publicid' =>'2daaeec28f55df7b710f07f9a0c52ab8',
			'name'=>'nexxstars join list',
			'leadsource[]' => 'netxxstars wait list',
			'firstname'=>$first_name,
			'lastname'=> $last_name,
			'email'=> $email,
			'phone'=> $phone,
			'country'=> $country,
			'label:Comments/Message'=> $message,
	);

	//print_r($fields);

	$url = 'http://ciaocrm.com/modules/Webforms/capture.php';
	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch);
	if ($response){
		$jsonObj= json_decode($response);
		if($jsonObj->{'success'}){
			$_SESSION[crmSubmitted]=true;
		}
	} else
	{
		//capture error do do something with it?
	}
	curl_close($ch);


	$headers = "From: " . strip_tags('info@nexxstars.com') . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$subject = "Are you one of the NexXStars?";
	$message = '<html><body>';
	$message .= '<p>Hi ' . $first_name . '</p>';
	$message .= '<p>Thanks for signing up for the NexXStars waitlist! We are truly excited to have your interest and support in this new, revolutionary way to crowd-source technology.</p>';
	$message .= '<p>With all the interest for NexXStars, we are currently waitlisting people to join our program. Don’t worry though, we have saved your place in line and will let you know when you’re ready to join.</p>';
	$message .= '<p>In the meantime, for the latest NexXStars news and updates, like our <a href="https://www.facebook.com/NexXStars">Facebook</a> page and follow us on <a href="https://twitter.com/NexxStars">Twitter</a>. You can also join our NexXStars Support group page <a href="https://www.facebook.com/groups/1442061899366492/">here</a>. </p>';
	$message .= '<p>Thank you!</p>';
	$message .= '<p>Sincerely,<br>NexXStars Team</p>';
	$message .= '</body></html>';

	if ($email) 
	{ 
		mail($email,$subject,$message,$headers);
		header("Location: waitlist-confirmation.php"); 
	}

?>

<?include("includes/footer.php");?>