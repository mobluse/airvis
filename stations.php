<?php

header('Content-Type: text/javascript');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

$db = new mysqli('localhost', 'hack', 'hack', 'hack');
$db->set_charset('UTF8');

$rs = $db->query('select * from air_station order by statid');

$stations = array();
while ($obj = $rs->fetch_object()) {
  array_push($stations, array( $obj->statid, $obj->station, $obj->lat, $obj->lng ) );
}

echo json_encode( $stations );

if (isset($rs)) {
  $rs->close();
}
$db->close();
?>
