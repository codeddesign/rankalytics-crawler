<?php
set_time_limit(0);

/* Load all classes */
require_once 'auto_load.php';

$crawlers = array('sites', 'ranks', 'trends');

if(!isset($argv[1])) {
    echo 'missing crawler type as argument (rankalytics_crawler / other_crawler)';
    exit();
}

$type = $argv[1];

function isRunning() {
    $status = trim(implode("", file('/var/www/stats/status.txt')));
    if($status == "") {
        return 0;
    }

    return (int)$status;
}

function crawlerCompleted($response, $info) {
    echo "completed: ".$info['url']."\n";
    echo "   ".$response;
}

if(isRunning() == 0) {
    exit('Not running..'."\n");
}

while (isRunning() == 1) {
    $rc = new RollingCurl("crawlerCompleted");
    foreach ($crawlers as $c_no => $c_name) {
        echo "Started ".$c_name." ..\n";
        $query = "http://5.101.106.7/run_one.php?p=" . $c_name . "&type=" . $type;
        $request = new RollingCurlRequest($query, "GET", NULL, NULL, NULL);
        $rc->add($request);
    }

    $rc->execute();
    unset($rc);
}