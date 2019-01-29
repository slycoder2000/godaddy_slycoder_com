<?php
include_once('../../simple_html_dom.php');

function scraping_IMDB($url) {
    // create HTML DOM
    $html = file_get_html($url);

    // get title
//    $ret['Title'] = $html->find('title', 0)->innertext;

    // get rating
 //   $ret['Rating'] = $html->find('table[style="margin-top:10px;margin-left:14px;margin-right:14px;margin-bottom:10px"]', 0)->innertext;

//   $ret['td'] = $html->find('td[style="vertical-align:top;width:100%;]', 0)->innertext;

    foreach($html->find('td[style="vertical-align:top;width:100%;]') as $div) {
        // skip user comments
       // if($div->find('h5', 0)->innertext=='User Comments:')
       //     return $ret;

        $key = '';
        $val = '';

        foreach($div->find('*') as $node) {
            if ($node->tag=='b')
                $key = $node->plaintext;

            if ($node->tag=='b' && $node->plaintext!='more') {
                //$val .= trim(str_replace("\n", '', $node->plaintext));
                $val .= trim($node->plaintext);
                $val .= "<br/>\n";
            }
        }
        $ret[$key] = $val;
    }


    // clean up memory
    $html->clear();
    unset($html);

    return $ret;
}


// -----------------------------------------------------------------------------
// test it!
$ret = scraping_IMDB('https://www.copperknob.co.uk/stepsheets/country-boom-boom-ID123825.aspx');

foreach($ret as $k=>$v)
//    echo '<strong>'.$k.' </strong>'.$v.'<br>';
    echo $v.'<br/>';
?>