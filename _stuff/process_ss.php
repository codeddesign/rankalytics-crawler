<?php
/* Load all classes */
require_once 'auto_load.php';

/* TESTS */
$p = $argv[1];

//$type = 'rankalytics_crawler';
$type = 'others_crawler';

#1
switch($p) {
    case 'sites':
        $obj = new GoogleSites($type);
        unset($obj);
        break;
    case 'ranks':
        $obj = new GoogleRanks();
        unset($obj);
        break;
    case 'trends':
        $obj = new GoogleTrends($type);
        unset($obj);
        break;
}

