
<!DOCTYPE html>
<html  xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title;?></title>
	<link rel="stylesheet" href="assets/css/stylesheet.css">
	<link href="https://fonts.googleapis.com/css?family=Aladin|Astloch:700|IM+Fell+Great+Primer+SC|Berkshire+Swash|Cinzel+Decorative:400,900|Homemade+Apple|IM+Fell+Double+Pica|Lily+Script+One|Milonga|Montez|Norican" rel="stylesheet">
	<script src="assets/jquery-3.1.1.min.js"></script>

</head>
<body >
<?php
if($_COOKIE['language'] === 'Deutsch'){include ("deutsch.php");}
else {include ("english.php");}
?>
<div class="flex-container">
	<header class="header settings">
		<nav>
			<ul class="drop-down closed">
				<li><a href="#" class="nav-button"><?php echo $language;?></a></li>
				<li><a href="#" class="not-selected"><?php echo $other;?></a></li>

			</ul>
		</nav>
	<a href="basket.php" class="basket"><img src="../../assets/images/picnic-basket-clip-art-black-and-white-clipart-panda-free-clipart-m8xH5N-clipart.png" height="38"></a>
	<a href="index.php?action=login" class="button login"><?php echo $login;?></a>
	</header>



	<header><h1><a class="header title" href="index.php"><?php echo $title;?></a></h1></header>
	<aside class="aside links">
		<nav>
			<?php include("sorting.php"); ?>
		</nav>
	</aside>
	<article class="main">
		<?php include($innerTpl); ?>

	</article>

	<aside class="aside info"></aside>
	<footer class="footer">
		 <a href="index.php?action=contact"><?php echo $foot[0]; ?></a>
		<a href="index.php?action=about"><?php echo $foot[1]; ?></a>
		<a href="index.php?action=agb"><?php echo $foot[2]; ?></a>
	</footer>
</div>
<script>
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+ d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}





	$(function() {

		$(".not-selected").click(function () {
			setCookie('language','<?php echo $other;?>',7); //unsecure, but project is already unsecure anyways
			location.reload();
		});
		// Bind Click event to the drop down navigation button
		$(".nav-button").click(function() {
			//opens box
			$(this).parent().parent().toggleClass("closed");
		});

	});

	function getCookie(cname) {
		var name = cname + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for(var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

</script>
</body>
</html>