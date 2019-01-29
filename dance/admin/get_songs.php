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
          header('Location: get_songs.php?danceid='.$_GET['danceid']);
        else
          die('Error: '.$connection->error);
    }
}

    
// If add songs - simple insert
if(isset($_GET['AddSongs'])) 
{
    $sql = "INSERT INTO LD_dance_music ( id_dance, id_music) VALUES";
//$sql = 'INSERT INTO `slycontracts6797`.`LD_dance_music` (`id`, `id_dance`, `id_music`) VALUES (NULL, \'118\', \'46\');';

    $param = explode("|",  $_GET['mystr']);
    foreach($param as $value) {
      if($value!="") {
          $sql = $sql . " (";
          $sql = $sql . $value;
          //$sql = $sql . str_replace(",", "','", $value);
          $sql = $sql . "),";
                    
        }
    }

$sql = rtrim($sql,',');
$sql = $sql . ";";    
//echo $sql;

//$conn->query($sql);

if ($connection->query($sql) === TRUE) {
     //echo "New record created successfully";
} else {
     echo "Error: " . $sql . "<br>" . $conn->error;
}


}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<!--  Core js and css shared by all examples; do not modify when using this template. -->
<!--link rel="stylesheet" href="https://www.w3.org/StyleSheets/TR/2016/base.css"-->
<link rel="stylesheet" href="core.css">
<script src="scripts/examples.js"></script>
<script src="scripts/highlight.pack.js"></script>
<script src="scripts/app.js"></script>
<script src="scripts/utils.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="../styles.css">
<link rel="stylesheet" type="text/css" href="listbox.css">

<script src="scripts/listbox.js" type="text/javascript"></script>
<script src="scripts/toolbar.js" type="text/javascript"></script>
<script src="scripts/listbox-rearrangeable.js" type="text/javascript"></script>

</head>
</head>
<body>

  <main>



<section>



    <section>

      <div role="separator" id="ex2_start_sep" aria-labelledby="ex2_start_sep ex2_label" aria-label="Start of"></div>
      <div id="ex2">
        <p class="WhiteText">Choose songs to associate with this dance:<br/>
<?php
$sql = "select id, dance from LD_dance where id=".$_GET["danceid"];
$getdance = $connection->query($sql);
$row = $getdance->fetch_assoc();
echo $row["dance"];
?>
        </p>
        <div class="listbox-area">
          <div class="left-area">
            <span id="ms_av_l">Available songs:</span>
            <ul
              id="ms_imp_list"
              tabindex="0"
              role="listbox"
              aria-labelledby="ms_av_l"
              aria-multiselectable="true">

<?php
$sql = "select id, title, artist from LD_music order by title";
$result = $connection->query($sql);
    while($row = $result->fetch_assoc()) {
       $dance=$row["dance"];
       echo "\t\t\t  ";
       echo '<li id="ms_opt'.$row["id"].'" role="option" aria-selected="false">'.$row["title"].' / '.$row["artist"].'</li>';
       echo "\r\n";
    }

?>
            </ul>
            <button id="ex2-add" class="move-right-btn" aria-keyshortcuts="Alt+ArrowRight Enter" aria-disabled="true">Add</button>
          </div>
          <div class="right-area">
            <span id="ms_ch_l">Songs you have chosen:</span>
            <ul
              id="ms_unimp_list"
              tabindex="0"
              role="listbox"
              aria-labelledby="ms_ch_l"
              aria-activedescendant=""
              aria-multiselectable="true">
            </ul>
            <button id="ex2-delete" class="move-left-btn" aria-keyshortcuts="Alt+ArrowLeft Delete" aria-disabled="true">Remove</button>
          </div>
          <div class="offscreen">Last change: <span aria-live="polite" id="ms_live_region"></span></div>
        </div>
      </div>
      <div role="separator" id="ex2_end_sep" aria-labelledby="ex2_end_sep ex2_label" aria-label="End of"></div>

    </section>

<form action="" method="get">
<?php
echo '<input type="hidden" value="'.$_GET['danceid'].'" name="danceid" >';
?>
<input type="hidden" id="mystr" name="mystr">
<input type="submit" value="Submit" name="AddSongs" onclick="myFunction()">
</form>

<script>
function myFunction() {
    var danceid = getUrlParameter('danceid'); 
    var mystr = "";

    var ul = document.getElementById("ms_unimp_list");
    var items = ul.getElementsByTagName("li");
    
    for (var i = 0; i < items.length; ++i) {
      mystr += danceid;
      mystr += ",";
      mystr += items[i].id.substr(6,99);
      mystr += "|";
    
    }

  document.getElementById("mystr").value = mystr;

}


function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};
</script>

    <!-- THIS SECTION NOT NEEDED - JUST HIDDEN SO JAVASCRIPT DOESN'T CRASH -->
    
    <section style="display:none;">

      <div id="ex1">
        <div class="listbox-area">
          <div class="left-area">
            <span id="ss_imp_l">Important Features:</span>
            <ul id="ss_imp_list" tabindex="0" role="listbox" aria-labelledby="ss_imp_l">
            </ul>
            <div role="toolbar" aria-label="Actions" class="toolbar">
              <button id="ex1-up" class="toolbar-item selected" aria-keyshortcuts="Alt+ArrowUp" aria-disabled="true">Up</button>
              <button id="ex1-down" class="toolbar-item" tabindex="-1" aria-keyshortcuts="Alt+ArrowDown" aria-disabled="true">Down</button>
              <button id="ex1-delete" class="toolbar-item move-right-btn" tabindex="-1" aria-keyshortcuts="Alt+ArrowRight Delete" aria-disabled="true">Not Important</button>
            </div>
          </div>
          <div class="right-area">
            <span id="ss_unimp_l">Unimportant Features:</span>
            <ul id="ss_unimp_list" tabindex="0" role="listbox" aria-labelledby="ss_unimp_l" aria-activedescendant="">
            </ul>
            <button id="ex1-add" class="move-left-btn" aria-keyshortcuts="Alt+ArrowLeft Enter" aria-disabled="true">Important</button>
          </div>
          <div class="offscreen">Last change: <span aria-live="polite" id="ss_live_region"></span></div>
        </div>
      </div>
      <div role="separator" id="ex1_end_sep" aria-labelledby="ex1_end_sep ex1_label" aria-label="End of"></div>
      <h4>Notes</h4>

    </section>
    
    
    <!--/form-->
    
    
    <form action="" method="get">
    <fieldset>
        <legend class="WhiteText">Add New Song:</legend>
<?php
echo '<input type="hidden" value="'.$_GET['danceid'].'" name="danceid" >';
?>        
        <input type="text" name="Title" placeholder="Title">
        <input type="text" name="Artist" placeholder="Artist">
        <input type="submit" name="AddNewSong" value="Add New Song">
    </fieldset>
    </form>
    
    
  </section>
<?php 

$connection->close();
?>

</body>
</html>