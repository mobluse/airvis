<?php

header('Content-Type: text/javascript');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

$db = new mysqli('localhost', 'hack', 'hack', 'hack');
$db->set_charset('UTF8');

// $sid = $_POST["sid"];
$qry = $_POST["qry"];
// $qry = 'select * from air_station limit 0,2';
$res = $db->query( $qry );

$stations = array();
while ($obj = $res->fetch_array()) {
  array_push($stations, $obj );
}

echo json_encode( $stations );

if (isset($rs)) {
  $rs->close();
}
$db->close();
?>
