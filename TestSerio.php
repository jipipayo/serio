<?php
include_once 'Serio.php';

// Function to calculate script execution time.
function microtime_float()
{
    list ($msec, $sec) = explode(' ', microtime());
    $microtime = (float)$msec + (float)$sec;
    return $microtime;
}

// Get starting time.
$start = microtime_float();
/////////////////////////////////////////////////////////////

$serio = new Serio();


//insert test

/*$data[0] = 'Cero';
$data[1] = 'Uno';
$data[2] = 'Dos';

//insert 1 million rows
for ($i = 1; $i <= 1000000; $i++) {
    $serio->writeRow('serio1', $data);
}*/



//search test
//$serio->searchRows('serio1','Chachi');
$serio->searchRows('serio1','Lolo');

/*Note: with a fulltext index on datapack (serialized), we get Time: 0.003-0.004 avg seconds
    on a search up to 1 million of records */




////////////////////////////////////////////////////////////////
$end = microtime_float();
echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds';
