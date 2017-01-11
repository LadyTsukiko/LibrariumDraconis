
<!DOCTYPE html>
<html  xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title;?></title>
	<link rel="stylesheet" href="assets/css/stylesheet.css">
	<link href="https://fonts.googleapis.com/css?family=Aladin|Astloch:700|IM+Fell+Great+Primer+SC|Berkshire+Swash|Cinzel+Decorative:400,900|Homemade+Apple|IM+Fell+Double+Pica|Lily+Script+One|Milonga|Montez|Norican" rel="stylesheet">
	<script src="assets/jquery-3.1.1.min.js"></script>
	<script  src="assets/ajaxrequest.js"></script>

</head>
<body >
<?php
if($_COOKIE['language'] === 'Deutsch'){include ("deutsch.php");}
else {include ("english.php");}
?>


		<ul class="navbar">
		<nav>

			<ul class="drop-down closed">
				<li><a href="#" class="nav-button"><?php echo $language;?></a></li>
				<li><a href="#" class="not-selected"><?php echo $other;?></a></li>
			</ul>
		</nav>
            <a href="index.php?action=cart" class="button login cartlink"><?php echo $cart; ?></a>
<?php
        if ($this->controller->isLoggedIn()) {
            echo '<a href="index.php?action=logout" class="button login">'.$logout.'</a>
            	<p id="logged_in">'.$loggedin.' '.$_SESSION['user'].'</p>';
        } else {
            echo '<a href="index.php?action=login" class="button login">'.$login.'</a>';
        }
?>
		</ul>

<div class="flex-container">


	<header><h1><a class="header title" href="index.php"><?php echo $title;?></a></h1></header>

	<aside class="aside links">
		<nav>
			<?php session_start();
			if($test =$this->controller->getTitle()=='Home'){ include("sorting.php");}
			 ?>
		</nav>
	</aside>
	<article class="main">
		<?php include($innerTpl); ?>
	</article>


	<aside class="info"></aside>
</div>



	<footer class="footer">
		 <a href="index.php?action=contact"><?php echo $foot[0]; ?></a>
		<a href="index.php?action=about"><?php echo $foot[1]; ?></a>
		<a href="index.php?action=agb"><?php echo $foot[2]; ?></a>
	</footer>


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