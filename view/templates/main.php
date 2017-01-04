
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title;?></title>
	<link rel="stylesheet" href="assets/css/stylesheet.css">
	<link href="https://fonts.googleapis.com/css?family=Aladin|Astloch:700|Berkshire+Swash|Cinzel+Decorative:400,900|Homemade+Apple|IM+Fell+Double+Pica|Lily+Script+One|Milonga|Montez|Norican" rel="stylesheet">
	<script src="assets/jquery-3.1.1.min.js"></script>
	<script>
		$(function() {
			// Bind Click event to the drop down navigation button
			$(".nav-button").click(function() {
				/*  Toggle the CSS closed class which reduces the height of the UL thus
				 hiding all LI apart from the first */
				$(this).parent().parent().toggleClass("closed");
				//$(this).hide();
			});

		});</script>
</head>
<body >
<div class="flex-container">
	<header class="header settings">
		<nav>
			<ul class="drop-down closed">
				<li><a href="#" class="nav-button">English</a></li>
				<li><a href="#">Deutsch</a></li>

			</ul>
		</nav>

	</header>



	<header class="header title"><h1><?php echo $title;?></h1></header>
	<aside class="aside links">
		<nav>
			<a href="https://www.google.com">link1</a> <br>
			<a href="third.html">link2</a> <br>
			<a href="first.html">link3</a>
		</nav>
	</aside>
	<article class="main">
		<?php include($innerTpl); ?>

	</article>

	<aside class="aside info"></aside>
	<footer class="footer">
		 <a href="index.php?action=contact">Contact</a>
		<a href="index.php?action=about"> about us</a>
		<a href="index.php?action=agb">AGB</a>
	</footer>
</div>
</body>
</html>