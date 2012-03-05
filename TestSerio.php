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

//insert 1 million rows and count secs
for ($i = 1; $i <= 1000000; $i++) {
    $serio->WriteRow('serio1', $data);
}*/



//search test
$serio->SearchRows('serio1','Chachi');






////////////////////////////////////////////////////////////////
$end = microtime_float();
echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds';
