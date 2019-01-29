<?php include(__DIR__ . "\\danceSecurity.php"); ?>

<?php
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{

if( isset($_POST['dance']) && isset($_POST['stepsheet']))
{
if( $_POST['dance']!="" && $_POST['stepsheet']!="")
{

require_once('../dbconnect.php');



// Convert all variables

$sql  = "INSERT INTO LD_dance (dance, choreo, contrib, rosefav, stepsheet, vid1, vid2, vid3, hlink) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $connection->prepare($sql);

if($_POST[rosefav]=="rosefav") {
    $rosefav = 1;
} else {
    $rosefav = 0;
}

$ok   = $stmt->bind_param("sssisssss", $_POST[dance], $_POST[choreo], $_POST[contrib], $rosefav, $_POST[stepsheet], $_POST[vid1], $_POST[vid2], $_POST[vid3], $_POST[hlink]);

if ($ok && $stmt->execute())
  header('Location: add_dance.php');
else
  die('Error: '.$connection->error);

$connection->close();
}
}
}
?>



<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../styles.css">
</head>

<body class="WhiteText">

<h1>Add Dance</h1>

<form method="post">
  Dance:<br>
  <input type="text" name="dance" value="" autofocus><br>
  Choreographed by:<br>
  <input type="text" name="choreo" value=""><br>
  Contributed by:<br>
  <input type="text" name="contrib" value=""><br>
  Rose Favorite:<br> 
  <input type="checkbox" name="rosefav" value="rosefav"><br>
  StepSheet:<br>
  <input type="text" name="stepsheet" value=""><br>
  Vid 1:<br>
  <input type="text" name="vid1" value=""><br>
  Vid 2:<br>
  <input type="text" name="vid2" value=""><br>
  Vid 3:<br>
  <input type="text" name="vid3" value=""><br>
  hlink:<br>
  <input type="text" name="hlink" value=""><br>
  <br>
  <input type="submit" value="Submit">
</form>
<br><br><br>
<a href="index.php" class="WhiteText">Return to menu</a>

</body>

</html>