<?php include("includes/header.php"); ?>
<div style="width:960px;margin:30px auto;text-align:center;">
      Please complete the payment process below. When complete, your account will be provisioned within 3 hours.
</div>
<div class="row shopping-area-lg hidden-sm hidden-xs">
	<iframe src="http://EssentialInnovationsInc.paystand.com/personal-package?ref_channel=ref_pse&e" width="870" height="570" style="border:medium none;"></iframe>
</div>
<div class="row shopping-area-sm hidden-md hidden-lg">
	<iframe src="http://EssentialInnovationsInc.paystand.com/personal-package?ref_channel=ref_pse&e" width="870" height="570" style="border:medium none;"></iframe>
</div>
<?php header("Location: thanks.php");  ?>
<?php include('includes/footer.php'); ?>
