<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<ul id="MainMenuButtons">
    <li id="Filter">
<?php
if (htmlspecialchars($_GET["filter"]) == "rosefavs") {
  echo '<a href="index.php">[ROSE FAVS]/All</a>';
} else {
  echo '<a href="index.php?filter=rosefavs">[ALL]/Rose Favs</a>';
}
echo '</li>';
echo "<li><a href='calendar.php'>Calendar</a></li>";

echo nl2br("</ul>\n");
        echo "<div style='clear:both;'></div>";

$servername = "slycontracts6797.db.11018797.87b.hostedresource.net";
$username = "slycontracts6797";
$password = "Sly11340!!";
$dbname = "slycontracts6797";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//$sql = "SELECT id, firstname, lastname FROM MyGuests";
$sql = 'SELECT LD_dance_date.dance_date as dance_date, LD_dance.id as id_dance,'
        . ' LD_dance.dance as dance, LD_dance.stepsheet as ss, LD_dance.vid1 as vid1, LD_dance.hlink as lnk '
        . ' FROM LD_dance, LD_dance_date  '
        . ' WHERE LD_dance_date.id_dance = LD_dance.id '
        . ' order by LD_dance_date.dance_date DESC, LD_dance.dance LIMIT 0, 500 ';

$result = $conn->query($sql);

$cntr = 0;


if ($result->num_rows > 0) {

    echo "<div id='rowid'>";

    // output data of each row
    while($row = $result->fetch_assoc()) {

        if(($cntr % 2) == 0) {
            $color = "#904D1C";
        } else {
            $color = "#6E3A14";
        }

        echo "<div style='float:left; width:5%; background-color:$color; color:#fff;'>";
        if (1==0) {
            echo " <a href='get_songs.php?id_dance=".$row["id_dance"]."'>[+]</a> ";        
        }
        echo "</div>";
        
        echo "<a href='".$row["vid1"]."' target='_blank'><div style='float:left; width:10%; background-color:$color;  position: relative;'>";
        echo "<img src='video-play-2-xxl.png'></a></div>";

        
        echo "<a href='".$row["ss"]."' target='_blank'>";
        echo "<div style='float:left; width:85%; background-color:$color; color:#fff;'>";

        echo "[";
        echo substr($row["dance_date"],0,10);

        echo "] ";

        echo $row["dance"];


        echo "</div>";
        // "<div style='float:left; width:20%; background-color:$color;'>Step Sheet</div>";
        echo "</a>";
        echo "<div style='clear:both;'></div>";

        $cntr++;
    }

    echo "</div>";

} else {
    echo "0 results";
}
$conn->close();
?>

</body>
</html>
