<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 03/01/2017
 * Time: 19:14
 */

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
    echo "<a href='index.php?page=$i' class = 'number";
    if ($i==$page)  echo " curPage";
    echo "'>$i</a> ";
};
?>