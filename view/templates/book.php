<?php
$title = (string)$_GET['title'];
$datatable = 'books';
$sql = "SELECT `bookLabel`, `authorLabel`, `genre_label`, `series_label`, `publicationDate`, `ISBN`, `ID` FROM `books` WHERE `bookLabel` = '" . $title . "'";
$result = DB::doQuery($sql);
$row = $result->fetch_assoc();
$ISBN = $row["ISBN"];
$ISBN = str_replace('-', '', $ISBN);
//ini_set("allow_url_fopen", 1);
$jason = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=isbn:$ISBN");
$obj = json_decode($jason, true);

echo "<h2>" . $row["bookLabel"] . "</h2>";
echo "<img src= " . $obj['items'][0]['volumeInfo']['imageLinks']['thumbnail'] . ">";

if ($this->controller->isLoggedIn()) {
echo " <a href='index.php?action=cart&op=add&id=".$row["ID"]."' class='button'>".$add."</a> ";}
echo "<table class='book'><tr><th>$author</th><th></th></tr><tr><td></td><td>" . $row["authorLabel"] . "</td></tr>";

if (($row["publicationDate"]) != "") {
    echo "<tr><th>$date</th><th></th></tr><tr><td></td><td>" . date($dateFormat, $row["publicationDate"]) . "</td></tr>";
}
echo "<tr><th>ISBN</th><th></th></tr><tr><td></td><td>" .$row["ISBN"]. "</td></tr>";
echo "<tr><th>$genre</th><th></th></tr><tr><td></td><td>" . $row["genre_label"] . "</td></tr>";
if (($row["series_label"]) != "") {
    echo "<tr><th>$series</th><th></th></tr><tr><td></td><td>" . $row["series_label"] . "</td></tr>";
}
if (isset($obj['items'][0]['volumeInfo']['description'])) {
    echo "<tr><th>$description</th><th></th></tr><tr><td></td><td>" . $obj['items'][0]['volumeInfo']['description'] . "</td></tr>";
}
echo "</table>";
?>


