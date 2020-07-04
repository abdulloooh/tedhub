<!--newly added starts here-->
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>KA Lite Essentials</title>

	<link rel="stylesheet" href="../../css/bootstrap.css">
	<link rel="stylesheet" href="../../css/normalize-1.1.3.css">
	<link rel="stylesheet" href="../../css/ui-lightness/jquery-ui-1.10.4.custom.min.css">
	<link rel="stylesheet" href="../../css/font_and_bg.css">
	<link rel="stylesheet" href="../../css/module.css">
	<script src="../../js/jquery-1.10.2.min.js"></script>
	<script src="../../js/jquery-ui-1.10.4.custom.min.js"></script>

</head>

<body class="container fluid">
	
<!--newly added ends here-->





<!-- <link rel="stylesheet" href="../../css/bootstrap.min.css"> -->
<div class="container">
	<div class="indexmodule">

		<?php $host = "//$_SERVER[SERVER_NAME]:8008"; ?>

		

		
		<nav class="navbar bg-dark">
			<form action="<?php echo $host ?>/search/">
				<div class="row">
					<div class="col-md-6">
						<input type="text" class="form-control" name="query" value="" autocomplete="off">
					</div>
					<div class="col-md-6">
						<input type="submit" class="btn btn-primary" value="Search KA Lite">
					</div>
				</div>
			</form>
		</nav>

		<a href="<?php echo $host ?>/?" target="_blank"><img src="<?php echo $dir ?>/ka.png" alt="KA Lite"></a>

		<h2><a href="<?php echo $host ?>/?" target="_blank">KA Lite Essentials</a></h2>

		<p>KA-Lite Essentials includes thousands of videos and exercises on math, science, and
		more - an incredible learning resource brought to you by the Khan Academy and
	    The Foundation for Learning Equality.</p>

		<ul class="triple" style="list-style-type:none;">

		<li class="listhead"><a href="<?php echo $host ?>/learn/khan/math">Math</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/early-math/">Early Math</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/arithmetic/">Arithmetic</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/pre-algebra/">Pre-algebra</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/algebra-basics/">Algebra basics</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/algebra/">Algebra I</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/basic-geo/">Basic Geometry</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/geometry/">Geometry</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/algebra2/">Algebra II</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/trigonometry/">Trigonometry</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/probability/">Probability and statistics</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/precalculus/">Precalculus</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/differential-calculus/">Differential calculus</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/integral-calculus/">Integral calculus</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/multivariable-calculus/">Multivariable calculus</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/differential-equations/">Differential equations</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/math/math-for-fun-and-glory/">Math for fun and glory</a></li>
			
		<li class="listhead"><a href="<?php echo $host ?>/learn/khan/science">Science</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/science/biology/">Biology</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/science/physics/">Physics</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/science/chemistry/">Chemistry</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/science/organic-chemistry/">Organic Chemistry</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/science/cosmology-and-astronomy/">Cosmology and astronomy</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/science/health-and-medicine/">Health and medicine</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/science/electrical-engineering/">Electrial engineering</a></li>
	
		<li class="listhead"><a href="<?php echo $host ?>/learn/khan/economics-finance-domain/">Econommics and finance</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/economics-finance-domain/microeconomics/">Microeconomics</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/economics-finance-domain/macroeconomics/">Macroeconomics</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/economics-finance-domain/core-finance/">Finance and capital markets</a></li>
		<li><a href="<?php echo $host ?>/learn/khan/economics-finance-domain/entrepreneurship2/">Entrepreneurship</a></li>

		<li class="listhead"><a href="<?php echo $host ?>/learn/khan/computing/">Computing</a></li>
			<li><a href="<?php echo $host ?>/learn/khan/computing/computer-programming">Computer programming</a></li>
			<li><a href="<?php echo $host ?>/learn/khan/computing/computer-science">Computer science</a></li>

		</ul>

		<p style="margin-left: 130px;">
		You can <a href="<?php echo $host ?>/securesync/signup/">create an account to track
		your progress</a>.
		When you return, you can <a href="<?php echo $host ?>/securesync/login/">login and view
		your progress</a>.
		</p>

	</div>
</div>

</body>
</html>