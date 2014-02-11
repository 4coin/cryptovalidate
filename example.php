<?php
require_once('script/validatecrypto.php');

// valid BTC address (string mode)
echo 'checkAddress("1DhGN7Xpr5LXFLNfHqiPHxNqGUhx6kW4Pq", "s")<br />';
echo checkAddress('1DhGN7Xpr5LXFLNfHqiPHxNqGUhx6kW4Pq', 's');

echo "<br><br>";

//invalid BTC address (too short; string mode)
echo 'checkAddress("1DhGN7XprLXFLNfHqiPHxNqGUhx6kW4Pq", "s")<br />';
echo checkAddress('1DhGN7XprLXFLNfHqiPHxNqGUhx6kW4Pq', 's');

echo "<br><br>";

//invalid BTC address (bad checksum; string mode)
echo 'checkAddress("1DhGN7Xpr6LXFLNfHqiPHxNqGUhx6kW4Pq", "s")<br />';
echo checkAddress('1DhGN7Xpr6LXFLNfHqiPHxNqGUhx6kW4Pq', 's');

echo "<br><br>";

//valid DOGE address (number mode)
echo 'checkAddress("DDhW8ty1TsYdDPqABYJr2T5PbXT5McgbXZ", "n")<br />';
echo checkAddress('DDhW8ty1TsYdDPqABYJr2T5PbXT5McgbXZ', 'n');

echo "<br><br>";

//valid LTC address (boolean mode)
echo 'checkAddress("LVo4Krckg5EXR5J8f3saSQxYNKsK66mzQk", "b")<br />';
echo checkAddress('LVo4Krckg5EXR5J8f3saSQxYNKsK66mzQk', 'b');

echo "<br><br>";
?>
