<?php
/*. require_module 'core';
    require_module 'array';
    require_module 'mysqli';
.*/
error_reporting(E_STRICT);

header('Content-Type: text/javascript');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

$db = new mysqli('localhost', 'hack', 'hack', 'hack');
$db->set_charset('UTF8');

$sid = (int)$_REQUEST['sid'];
$rs = $db->query("SELECT TIMESTAMPDIFF(MINUTE, '1959-01-01',`start`) AS x, NO2 AS y FROM `air_conc` WHERE `start`>='1959-01-01' AND NO2>0 AND `sid`=$sid ORDER BY `start` LIMIT 0,20");

class Coord {
  public $x = 0.0;
  public $y = 0.0;
}

$obj = /*. (Coord) .*/ NULL;
$xList = /*. (array[]double) .*/ array();
$yList = /*. (array[]double) .*/ array();
while ($obj = $rs->fetch_object()) {
  array_push($xList, $obj->x);
  array_push($yList, $obj->y);
}

echo '{"x":[';
echo join(',', $xList);
echo '], "y":[';
echo join(',', $yList);
echo ']}';

if (isset($rs)) {
  $rs->close();
}
$db->close();
