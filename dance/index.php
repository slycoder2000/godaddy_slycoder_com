<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">

  <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.theme.min.css"-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true,
      heightStyle: "content",
      active: false
    });
  } );
  </script>


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

require_once('./dbconnect.php');


if (htmlspecialchars($_GET["filter"]) == "rosefavs") {
    $sqlWhere = ' WHERE rosefav=1 ';   
}


$sql = 'SELECT LD_dance.id as id_dance, dance, LD_dance.stepsheet as ss, LD_dance.vid1, LD_dance.hlink, '
        . ' LD_dance_music.id_music, LD_music.title '
        . ' FROM LD_dance LEFT JOIN LD_dance_music ON LD_dance.id = LD_dance_music.id_dance '
        . ' LEFT JOIN LD_music on LD_dance_music.id_music = LD_music.id '
        . $sqlWhere
//        . ' order by LD_dance.dance ';
        . ' GROUP BY dance LIMIT 0, 500 ';


$result = $connection->query($sql);

$cntr = 0;


if ($result->num_rows > 0) {

    echo "<br/><br/><div id='accordion'>";

    // output data of each row
    while($row = $result->fetch_assoc()) {

        if(($cntr % 2) == 0) {
            $color = "#904D1C";
        } else {
            $color = "#6E3A14";
        }
        
        echo "\r\n\r\n";
        // echo "\r\n\r\n<!--a href='".$row["vid1"]."' target='_blank'><div style='float:left; width:10%; background-color:$color;  position: relative;'>";
        // echo "<img src='video-play-2-xxl.png'></a></div-->";

        
        // echo "<!--a href='".$row["ss"]."' target='_blank'-->";
        echo "<div style='width:100%; background-color:$color; color:#fff;'>";


        // if($row['title'] != "") echo "[+]";
        echo $row["dance"];
        echo "</div>";
        // "<div style='float:left; width:20%; background-color:$color;'>Step Sheet</div>";
        //echo "<!--/a-->";

        echo "<div style='clear:both;'>";
        
        
        // SHOW SUMMARIZED STEPSHEET
        if($row['hlink'] != "") readfile("stepsheets/".$row['hlink']);

        
        // SHOW SONG LISTING
        if($row['title'] != "") {
            $sql2 = '            SELECT LD_dance_music.id_music, LD_music.title, LD_music.artist '
            .' FROM LD_dance_music LEFT JOIN LD_music on LD_dance_music.id_music = LD_music.id '
            .' WHERE LD_dance_music.id_dance= ' . $row['id_dance'] 
            . ' ORDER BY title  LIMIT 0, 500 ';

            $result2 = $connection->query($sql2);
            
            if ($result2->num_rows > 0) {
                echo "<hr>Suggested Song(s):<br/>";

                // output data of each row
                while($row2 = $result2->fetch_assoc()) {
                    echo '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;';
                    echo $row2['title'];
                    if($row2['artist']) echo " / ". $row2['artist'];
                    echo '<br/>';
                }

            }

        }
        echo "<hr>";
        // SHOW VIDEO LINK
        echo "<a href='".$row["vid1"]."' target='_blank'>";
        echo "Video Tutorial</a>";
        
        // SHOW COMPLETE STEPSHEET LINK
        echo "&nbsp;&nbsp;&nbsp; <a href='".$row["ss"]."' target='_blank'>";
        echo "View complete Stepsheet</a>";


        echo "</div>";

        $cntr++;
    }

    echo "</div>";

} else {
    echo "0 results";
}
$connection->close();
?>

</body>
</html>
