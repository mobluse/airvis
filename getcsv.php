<?php

error_reporting(E_STRICT);

$FOUND    = false;
$CSVURLs  = /*. (string[int]) .*/ array();
$CSVFiles = /*. (string[int]) .*/ array();
$URLs     = array( 'http://www3.ivl.se/db/plsql/dvst_so2_st$b1.querylist',
    'http://www3.ivl.se/db/plsql/dvst_no2_st$b1.querylist',
    'http://www3.ivl.se/db/plsql/dvst_co_st$b1.querylist' );

foreach ( $URLs as $url ) {
    for ( $i = 0; $i < 100; ++$i ) {
         $cmd = $url.'?Z_ACTION=FIRST';
         if ( $i > 0 ) {
             $cmd = $url.'?Z_START='.(1+($i-1)*100).'&Z_ACTION=NEXT';
         }
         print($cmd."\n");
         $lines = file($cmd);
         $FOUND = false;
         foreach ( $lines as $line ) {
             if ( preg_match('/<a href="dvst_luft_gd\$b1.actionquery\?p_stat_id=(\d{1,6})&amp;p_startt=(\d{4}-\d\d-\d\d)&amp;u_startt=(\d{4}-\d\d-\d\d)(|&amp;p_timdygn=(.*?))">Grunddata<\/a>/i', $line, $m) ) {
                 $csv = "http://www3.ivl.se/db/plsql/dvstluft.csv?P_STAT_ID=$m[1]&P_STARTT=$m[2]&U_STARTT=$m[3]&P_TIMDYGN=$m[5]";
                 array_push($CSVURLs, $csv);
                 $file = "data/dvstluft_$m[2]_$m[3]_$m[1].csv";
                 array_push($CSVFiles, $file);
                 $FOUND = true;
             }
         }
         if ( !$FOUND ) {
             print("LINE $i NOT FOUND <<<<<<<<<<< \n");
             break;
         }
    }
}

foreach ( $CSVURLs as $cmd ) {
    print($cmd."\n");
    $contents = file_get_contents($cmd);
    $file = array_shift($CSVFiles);
    file_put_contents($file, $contents);
}

print("DOWNLOADED #".count($CSVURLs)." CSVs.\n");
