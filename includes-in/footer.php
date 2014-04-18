	<!-- MODAL - Purchase Form -->
	<?php include('../includes/contact-us.php'); ?>
	<?php include('../includes/privacy-policy.php'); ?>
	<?php include('../includes/terms.php'); ?>
	<?php include('../includes/refund-policy.php'); ?>
		<section class="row footer">
			<p class="text-center">All contents © 2014 NexXStar. All rights reserved. | <a href="#" data-toggle="modal" data-target=".privacy-policy">Read Privacy Policy</a> | <a href="#" data-toggle="modal" data-target=".terms">Read Terms and Conditions</a> | <a href="#" data-toggle="modal" data-target=".refund-policy">Read Refund Policy</a></p>
		</section>
	</div>
	<!-- javascript -->
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	
	<script>	
	$(document).ready(function(){
	    animateDiv();
    
	});

	function makeNewPosition(){
    
	    // Get viewport dimensions (remove the dimension of the div)
	    var h = $(window).height() - 50;
	    var w = $(window).width() - 50;
    
	    var nh = Math.floor(Math.random() * h);
	    var nw = Math.floor(Math.random() * w);
    
	    return [nh,nw];    
    
	}

	function animateDiv(){
	    var newq = makeNewPosition();
	    var oldq = $('.a').offset();
	    var speed = calcSpeed([oldq.top, oldq.left], newq);
    
	    $('.a').animate({ top: newq[0], left: newq[1] }, speed, function(){
	      animateDiv();        
	    });
    
	};

	function calcSpeed(prev, next) {
    
	    var x = Math.abs(prev[1] - next[1]);
	    var y = Math.abs(prev[0] - next[0]);
    
	    var greatest = x > y ? x : y;
    
	    var speedModifier = 0.1;

	    var speed = Math.ceil(greatest/speedModifier);

	    return speed;

	}
	</script>

	</body>
</html>