<?php
    $file = fopen("/var/www/stats/status.txt","w");
    fwrite($file, 0);
    fclose($file);

    echo "Crawlers will finish job then close.";
    exit;
