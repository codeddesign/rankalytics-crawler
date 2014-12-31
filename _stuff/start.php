<?php
$file = fopen("/var/www/stats/status.txt","w");
fwrite($file, 1);
fclose($file);

$crawlers = array('sites', 'ranks', 'trends');
$type = 'rankalytics_crawler';

foreach($crawlers as $c_no => $c_name) {
    shell_exec('python /var/www/run.py '.$c_name.' '.$type.'');
}

echo "started!";