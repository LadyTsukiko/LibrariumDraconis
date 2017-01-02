
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title;?></title>
	<link rel="stylesheet" href="assets/css/stylesheet.css">
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
		$datatable = "books";
		$results_per_page = 20;
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
		$start_from = ($page-1) * $results_per_page;
		$sql = "SELECT ISBN, bookLabel, authorLabel, genre_label, ID FROM $datatable ORDER BY ID ASC LIMIT $start_from,$results_per_page";
		$result = DB::doQuery($sql);
		if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<table><tr><th>ISBN</th><th>name</th><th>author</th><th>genre</th></tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row["ISBN"]."</td><td>".$row["bookLabel"]."</td><td>".$row["authorLabel"]."</td><td> ".$row["genre_label"]."</td></tr>";
			}
			echo "</table>";
		}}else {
		echo "0 results";
		} ?>
		<?php
		$sql = "SELECT COUNT(ID) AS total FROM $datatable";
		$result = DB::doQuery($sql);
		$row = $result->fetch_assoc();
		$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
		for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
			echo "<a href='index.php?page=$i'";
			if ($i==$page)  echo " class='curPage'";
			echo ">$i</a> ";
		};
		?>
	</article>

	<aside class="aside info">flex item 3</aside>
	<footer class="footer"> footer </footer>
</div>



</body>
</html>