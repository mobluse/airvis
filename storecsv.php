<?php

error_reporting(E_STRICT);

require_once 'Site.php';

$TP = 'air_'; // Table Prefix
$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);
$db->set_charset('latin1');
$db->select_db(DB_NAME);

$dir = 'data_old/';
$i = 1;
foreach ( scandir($dir) as $file ) {
    if ( $file === '.' || $file === '..' )
        continue;
    print($file."\n");
    $rows = file($dir.$file);
    array_shift($rows); // Removes headings.
    foreach ( $rows as $row ) {
        $cols = explode(',', $row);
        array_pop($cols);
        $db->query('INSERT INTO '.$TP.'conc (mid,fid,kommun,station,stat_id,typ,starttid,stopptid,co,no2,nox,ozon,so2,status,anm)'
                 . " VALUES (NULL,$i,".implode(',', $cols).');');
    }
    ++$i;
}

if ( isset($rs) ) {
    $rs->close();
}
$db->close();
