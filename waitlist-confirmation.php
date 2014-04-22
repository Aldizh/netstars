<?php
	session_start();
	include("includes/header.php");
	$title = "NexxStars Waitlist"
?>

<?
	$subject = "Are you one of the NexXStars?";
	$message = '<html><body>';
	$message .= '<p>Hi ' . $first_name . '</p>';
	$message .= '<p>Thanks for signing up for the NexXStars waitlist! We are truly excited to have your interest and support in this new, revolutionary way to crowd-source technology.</p>';
	$message .= '<p>With all the interest for NexXStars, we are currently waitlisting people to join our program. Don’t worry though, we have saved your place in line and will let you know when you’re ready to join.</p>';
	$message .= '<p>In the meantime, for the latest NexXStars news and updates, like our <a href="https://www.facebook.com/NexXStars">Facebook</a> page and follow us on <a href="https://twitter.com/NexxStars">Twitter</a>. You can also join our NexXStars Support group page <a href="https://www.facebook.com/groups/1442061899366492/">here</a>. </p>';
	$message .= '<p>Thank you!</p>';
	$message .= '<p>Sincerely,<br>
					NexXStars Team</p>';

	$message .= '</body></html>';

	$headers = "From: " . strip_tags('info@nexxstars.com') . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	if ($email != "") 
	{ 
		mail($email,$subject,$message,$headers); 
	}
?>
<div class="row signup-container">
	<br>
	<h1>Success!</h1>
	<p>Thanks for waitlisting. We'll be in contact shortly.</p>
	<br>
	<br>
	<a href="index.php"><button class="btn btn-primary">Back Home</button></a>
	<br>
	<br>
	<br>
</div>


<?php include('includes/footer.php'); ?>

