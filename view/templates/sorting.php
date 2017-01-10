<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 06.01.2017
 * Time: 14:13
 */
?>
<h3 class="sorting-title"><?php echo $sort; ?></h3>
</br>
<ul class="drop-down closed sortmenu">
    <li><a  class="nav-button"><?php echo $author;?></a></li>

<?php
$datatable = "books";
$sql = "SELECT DISTINCT authorLabel FROM $datatable";
$result = DB::doQuery($sql);
    while($row = $result->fetch_assoc()) {

            echo "<li><a href=\"index.php?action=table&auname=". $row["authorLabel"] ."\" class=\"nav-button\">" . $row["authorLabel"] . "</a></li>";

};
?>
</ul>

<ul class="drop-down closed sortmenu sort2">
    <li><a class="nav-button"><?php echo $genre;?></a></li>

    <?php
    $datatable = "genres";
    $sql = "SELECT DISTINCT genre_label FROM $datatable";
    $result = DB::doQuery($sql);
    while($row = $result->fetch_assoc()) {

        echo "<li><a href=\"index.php?action=table&genre=". $row["genre_label"] ."\" class=\"nav-button\">" . $row["genre_label"] . "</a></li>";

    };
    ?>

</ul>

