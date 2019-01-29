<?php include(__DIR__ . "\\danceSecurity.php"); ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<?php

require_once('../dbconnect.php');

//$sql = "SELECT id, firstname, lastname FROM MyGuests";
$sql = 'SELECT '
        . ' LD_dance.dance as dance, LD_dance.stepsheet as ss, LD_dance.youtube_vid as vid,'
        . ' LD_music.title as title, LD_music.artist as artist '
        . ' FROM ((LD_dance_music '
        . ' INNER JOIN LD_dance ON LD_dance_music.id_dance=LD_dance.id) '
        . ' INNER JOIN LD_music ON LD_dance_music.id_music=LD_music.id)'
        . ' order by LD_dance.dance LIMIT 0, 30 ';

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Title</th><th>Video</th><th>Music</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td><a href='".$row["ss"]."' target='_blank'>".$row["dance"]."</a></td>";
        echo "<td><a href='".$row["vid"]."' target='_blank'>Vid</a></td>";
        echo "<td>".$row["title"]." ".$row["artist"]."</td>";
        echo "</tr>";
    
    }
    echo "</table>";
} else {
    echo "0 results";
}
$connection->close();
?>

</body>
</html>
