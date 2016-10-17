<?php 
require '../lib/base.php';

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Testing base.php</title>
</head>
<body>
	Testing evaluate_rating function: <br>
	
	evaluate_rating(-1) = <?php echo evaluate_rating(-1) ?><br>
	evaluate_rating(1) = <?php echo evaluate_rating(1) ?><br>
	evaluate_rating(7) = <?php echo evaluate_rating(7) ?><br>
	evaluate_rating(8) = <?php echo evaluate_rating(8) ?><br>
	evaluate_rating(15) = <?php echo evaluate_rating(15) ?><br>
	evaluate_rating(16) = <?php echo evaluate_rating(16) ?><br>
	evaluate_rating(25) = <?php echo evaluate_rating(25) ?><br>
	evaluate_rating(26) = <?php echo evaluate_rating(26) ?><br>
	evaluate_rating(100) = <?php echo evaluate_rating(100) ?><br>
	
	get_color(<?php echo evaluate_rating(100) ?>) = <?php echo get_color(evaluate_rating(100)) ?><br>
	get_color(<?php echo evaluate_rating(25) ?>) = <?php echo get_color(evaluate_rating(25)) ?><br>

	get_color(0) = <?php echo get_color(0) ?><br>
	
</body>
</html>
