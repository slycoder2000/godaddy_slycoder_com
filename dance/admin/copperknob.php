<?php include(__DIR__ . "\\danceSecurity.php"); ?>

<?php
include_once('../../scripts/simplehtmldom/simple_html_dom.php');
//$ts = TRUE;
$ts = FALSE;

function scraping_IMDB($url) {
    // create HTML DOM
    $html = file_get_html($url);


    foreach($html->find('td[style="vertical-align:top;width:100%;]') as $div) {

        $key = '';
        $val = '';
        $cntr = 'xx';
    
        foreach($div->find('*') as $node) {
            if (strcmp($cntr, '') != 0) {
                if ($node->tag=='b')
                    $key = $node->plaintext;
    
                if ($node->tag=='b') {
                    $val .= trim($node->plaintext);
                    $val .= "<br/>";
                }
            }
            $cntr='show';
        }
        
        // trim leading and trailing breaks
       $val = preg_replace('/^(<br\s*?\/?>)+|(<br\s*\/?>)+$/', '', $val);
        
        $ret[$key] = $val;
    }


    // clean up memory
    $html->clear();
    unset($html);

    return $ret;
}



require_once('../dbconnect.php');

$sql = 'SELECT LD_dance.id as id_dance, dance, LD_dance.stepsheet as ss, LD_dance.hlink '
        . ' FROM LD_dance '
        . " WHERE LD_dance.stepsheet like '%copperknob%'  " 
        . ' GROUP BY dance LIMIT 0, 500 ';


//$sql = 'SELECT LD_dance.id as id_dance, dance, LD_dance.stepsheet as ss, LD_dance.hlink '
//        . ' FROM LD_dance '
//        . " WHERE LD_dance.stepsheet like '%copperknob%' AND LD_dance.hlink ='' " 
//        . ' GROUP BY dance LIMIT 0, 500 ';

$result = $connection->query($sql);

$cntr = 0;


if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        $filename = $row["ss"];
        $writefile = "../stepsheets/" . basename($filename, ".aspx") . ".txt";
        // SHOW SONG LISTING
        // SHOW COMPLETE STEPSHEET LINK
     
        if (!file_exists($writefile)) {
            echo $writefile . "<br/>";
            
if (!$ts) {
                $ret = scraping_IMDB($filename);
                foreach($ret as $k=>$v)
                echo $v;
                $myfile = fopen($writefile, "w") or die("Unable to open file!");
                fwrite($myfile, $v);
                fclose($myfile);            

       // } else {
            // Write to database
            $sql2 = "UPDATE LD_dance "
                . " SET hlink = '" . basename($filename, ".aspx") .".txt' " 
                . " WHERE id = " . $row["id_dance"] ;
                
            if ($connection->query($sql2) === FALSE) {
                echo "Error updating record: " . $connection->error;
            }
}            
        }


    }


} else {
    echo "0 results";
}
$connection->close();
?>