
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title;?></title>
	<link rel="stylesheet" href="assets/css/stylesheet.css">
	<link href="https://fonts.googleapis.com/css?family=Aladin|Astloch:700|Berkshire+Swash|Cinzel+Decorative:400,900|Homemade+Apple|IM+Fell+Double+Pica|Lily+Script+One|Milonga|Montez|Norican" rel="stylesheet">
</head>
<body >
<div class="flex-container">
	<header class="header settings">
		<ul class="social-links">
			<li>&#9682;</li>
			<li>
				<div>
					<div id="lang-form">

						<div id="language-selected" class="dropdownbox">EN &#9662;</div>

						<div id="dropdown-wrapper">
							<ul name="lang" id="select-language-menu" class="menu">
								<li class="selected">
									English
									<div class="lang-code" style="display: none;">en &#9662;</div>
								</li>
								<li>
									Deutsch
									<div class="lang-code" style="display: none;">de &#9662;</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</li>
		</ul>
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

<script>
	if ($('#language-selected').is(':empty')){
		$( ".menu li" ).each(function() {
			if($(this).attr('class') == 'selected'){
				var selected = $(this).find('.lang-code').html().toUpperCase();
				console.log($(this).find('.lang-code').html().toUpperCase());
				$("#language-selected").html(selected);
			}
		});
	}

	//The next following line displays and set selected language
	$(".dropdownbox").click(function(){
		$(".menu").toggleClass("showMenu");
		$(".menu > li").click(function(){
			var selected = $(this).find('.lang-code').html().toUpperCase();
			console.log($(this).find('.lang-code').html().toUpperCase());
			$("#language-selected").html(selected);
			$(".menu").removeClass("showMenu");
		});
	});

	//Close language select box if nothing is selected
	$("#dropdown-wrapper").mouseleave(function(){
		$(".menu").removeClass("showMenu");
	});
</script>

</body>
</html>