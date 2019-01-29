<?php include(__DIR__ . "\\danceSecurity.php"); ?>

<?php
require_once('../dbconnect.php');

if ( $_SERVER['REQUEST_METHOD'] == 'GET' )
{
    
// If add new song - simple insert

if(isset($_GET['AddNewSong'])) 
{
    if($_GET['Title']!="" && $_GET['Artist']!="") 
    {
        $sql  = "INSERT INTO LD_music (title, artist) VALUES (?, ?)";
        $stmt = $connection->prepare($sql);
        
        $ok   = $stmt->bind_param("ss", $_GET[Title], $_GET[Artist]);
        
        if ($ok && $stmt->execute())
          header('Location: add_songs.php');
        else
          die('Error: '.$connection->error);
    }
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<!--  Core js and css shared by all examples; do not modify when using this template. -->

<link rel="stylesheet" type="text/css" href="../styles.css">

</head>
<body>

  <main>

<section>

<?php

//$sql = "SELECT id, firstname, lastname FROM MyGuests";
$sql = 'SELECT LD_dance.id as id_dance,'
        . ' LD_dance.dance as dance '
        . ' FROM LD_dance '
        . ' order by LD_dance.dance LIMIT 0, 500 ';

$result = $connection->query($sql);

$cntr = 0;


if ($result->num_rows > 0) {

    echo "<h1 class='WhiteText'>Choose songs to apply to this dance</h1><div id='rowid'>";

    // output data of each row
    while($row = $result->fetch_assoc()) {

        if(($cntr % 2) == 0) {
            $color = "#904D1C";
        } else {
            $color = "#6E3A14";
        }



        echo "<a href='get_songs.php?ChooseSongs=submit&danceid=".$row["id_dance"]."'>";
        echo "<div style='float:left; width:85%; background-color:$color; color:#fff;'>";
        echo $row["dance"];
        
        echo "</div>";
        
        echo "</a>";
        
        echo "<div style='clear:both;'></div>";

        $cntr++;
    }

    echo "</div>";

} else {
    echo "0 results";
}

?>



</section>




<?php 

$connection->close();
?>

</body>
</html>