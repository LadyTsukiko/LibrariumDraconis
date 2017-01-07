

<?php
$ISBN = (string)$_GET['isbn'];
$datatable = 'books';
$sql = "SELECT `bookLabel`, `authorLabel`, `genre_label`, `series_label`, `publicationDate`, `award`, `ISBN` FROM `books` WHERE `ISBN` = '".$ISBN."'";
$ISBN = str_replace('-','',$ISBN);
//ini_set("allow_url_fopen", 1);
$jason = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=isbn:$ISBN");
$obj = json_decode($jason, true);


$result = DB::doQuery($sql);


    $row = $result->fetch_assoc();
    echo "<h2>".$row["bookLabel"]."</h2>";
    echo "<img src= ".$obj['items'][0]['volumeInfo']['imageLinks']['thumbnail'].">";
    echo "<table><tr><th>$author</th><td>".$row["authorLabel"]."</td></tr>";
    echo "<tr><th>$date</th><td>".$row["publicationDate"]."</td></tr>";
    echo "<tr><th>$genre</th><td>".$row["genre_label"]."</td></tr>";
    if (($row["series_label"])!= ""){
        echo "<tr><th>$series</th><td>".$row["series_label"]."</td></tr>";
    }
    while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["award"]."</td><td>".$row["bookLabel"]."</td><td>".$row["authorLabel"]."</td><td> ".$row["genre_label"]."</td></tr>";
    }
    echo "</table>";
?>


