

<?php
$ISBN = $_GET['isbn'];
echo ($ISBN);
$datatable = 'books';
$sql = "SELECT bookLabel, authorLabel, genre_label, ID , award, series_lable publicationDate FROM $datatable  WHERE ISBN = $ISBN ";
$result = DB::doQuery($sql);

echo "<table><tr><th>ISBN</th><th>name</th><th>author</th><th>genre</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo "<tr class='book'><td>".$row["award"]."</td><td>".$row["bookLabel"]."</td><td>".$row["authorLabel"]."</td><td> ".$row["genre_label"]."</td></tr>";
    }
    echo "</table>";

