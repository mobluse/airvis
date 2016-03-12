<?php
header('Content-Type: text/javascript');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

$db = new mysqli('localhost', 'hack', 'hack', 'hack');
$db->set_charset('UTF8');

$qry = $_REQUEST["qry"];
$res = $db->query( $qry );

$dat = array();
while ($obj = $res->fetch_array()) {
  array_push($dat, $obj );
}

echo json_encode( $dat );

if (isset($rs)) {
  $rs->close();
}
$db->close();
?>
