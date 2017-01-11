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
$sqlSelect = "SELECT bookLabel, authorLabel, genre_label, ID";
$sqlEnd = "ORDER BY ID ASC LIMIT $start_from,$results_per_page";
if (isset($_GET["auname"])){
    $auname = DB::getInstance()->real_escape_string($_GET["auname"]);
    $sql = " FROM $datatable WHERE authorLabel = '".$auname."' ";
    $uri = "auname=".$_GET["auname"]."&";
}
elseif (isset($_GET["genre"])){
    $gen = DB::getInstance()->real_escape_string( $_GET["genre"]);
    $sql =  " FROM $datatable WHERE genre_label LIKE '%{$gen}%' ";
    $uri = "genre=".$_GET["genre"]."&";
}
elseif ($page==1) {
    $sql = " FROM $datatable ";
    $uri = "";
}


$result = DB::doQuery($sqlSelect.$sql.$sqlEnd);
if ($result->num_rows > 0) {
    // output data of each row

        echo "<table><tr><th>$booktitle</th><th>$author</th><th>$genre</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr class='bookRow'><td>".$row["bookLabel"]."</td><td>".$row["authorLabel"]."</td><td> ".$row["genre_label"]."</td></tr>";
        }
        echo "</table>";

}else {
    echo "0 results";
} ?>
<?php
$sqlSelect = "SELECT COUNT(ID) AS total";
$result = DB::doQuery($sqlSelect.$sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
    echo "<a href='index.php?action=table&".$uri."page=$i' class = 'number";
    if ($i==$page)  echo " curPage";
    echo "'>$i</a> ";
}
?>

<script>
    $(".bookRow").click(function () {
        var title = this.getElementsByTagName("td")[0].innerHTML;
        window.location.href = "index.php?action=book&title=" + String(title);
    });
</script>
