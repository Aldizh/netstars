<? session_start() ?>
<ul class="nav nav-pills nav-stacked">
  <li><a href="home.php"><span class="glyphicon glyphicon-home"> Home</a></li>
  <li><a href="my-network.php"><span class="glyphicon glyphicon-globe"> My-Network</a></li>
  <li><a href="refer.php"><span class="glyphicon glyphicon-hand-left"> Refer</a></li>
  <li><a href="ads.php"><span class="glyphicon glyphicon-picture"> Ad-Click</a></li>
  <li><a href="update_profile.php"><span class="glyphicon glyphicon-user"> Update-Profile</a></li>
  <li><a href="form_upload.php"><span class="glyphicon glyphicon-file"> Upload-Document</a></li>
  <li><a href="../index.php?logout=true"><span class="glyphicon glyphicon-off"> Logout</a></li>
  <?if ($_SESSION["admin"] == true){?>
	<li><a href="pending_approvals.php"><span class="glyphicon glyphicon-calendar"> Pending-Approvals</a></li>
  <?}?>
</ul>