<?php include(__DIR__ . "\\danceSecurity.php"); ?>

<?php
require_once('../dbconnect.php');


if ( $_SERVER['REQUEST_METHOD'] == 'GET' )
{
if(isset($_GET[choosedate]) && isset($_GET[id_dance])) 
{

$date_for_database = date ("Y-m-d H:i:s", strtotime($_GET[choosedate]));

$sql  = "INSERT INTO LD_dance_date (id_dance, dance_date) VALUES (?, ?)";
$stmt = $connection->prepare($sql);

$ok   = $stmt->bind_param("is", $_GET[id_dance], $_GET[choosedate]);

if ($ok && $stmt->execute())
  header('Location: add_date.php');
else
  die('Error: '.$connection->error);

}
}
?>



<!DOCTYPE html>

<html>

<head>
<link rel="stylesheet" type="text/css" href="../styles.css">
</head>

<body  class="WhiteText">

<h1>Add Date</h1>

<form method="get">
  Date:<br>
  <input type="date" name="choosedate" autofocus><br>
  Dance:<br>
<select name='id_dance'>
  
<?php
//$sql = "SELECT id, firstname, lastname FROM MyGuests";
$sql = 'SELECT LD_dance.id as id_dance,'
        . ' LD_dance.dance as dance '
        . ' FROM LD_dance '
        . $sqlWhere
        . ' order by LD_dance.dance LIMIT 0, 500 ';

$result = $connection->query($sql);

if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id_dance'] . "'>" . $row['dance'] . "</option>";
    }
}
?>
  
</select>
  
  
  <br>
  <br>
  <input type="submit" name="submit" value="Submit">
</form>
<br><br><br>
<a href="index.php" class="WhiteText">Return to menu</a>

<?php

$connection->close();

?>



</body>

</html>