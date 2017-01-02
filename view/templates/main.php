
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title;?></title>
	<link rel="stylesheet" href="css/stylesheet.css">
	<link href="https://fonts.googleapis.com/css?family=Aladin|Astloch:700|Berkshire+Swash|Cinzel+Decorative:400,900|Homemade+Apple|IM+Fell+Double+Pica|Lily+Script+One|Milonga|Montez|Norican" rel="stylesheet">
</head>
<body >
<div class="flex-container">
	<header class="header settings">language and stuff</header>
	<header class="header title"><h1><?php echo $title;?></h1></header>
	<aside class="aside links">
		<nav>
			<a href="https://www.google.com">link1</a> <br>
			<a href="third.html">link2</a> <br>
			<a href="first.html">link3</a>
		</nav>
	</aside>
	<article class="main">
		<?php
		$sql = "SELECT ISBN, name, autor FROM books";
		$result = DB::doQuery($sql);
		if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<table><tr><th>ISBN</th><th>Name</th><th>author</th><th>genre</th></tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row["ISBN"]."</td><td>".$row["bookLabel"]."</td><td>".$row["authorLabel"]."</td><td> ".$row["genre_label"]."</td></tr>";
			}
			echo "</table>";
		}}else {
		echo "0 results";
		} ?>
	</article>

	<aside class="aside info">flex item 3</aside>
	<footer class="footer"> footer </footer>
</div>



</body>
</html>