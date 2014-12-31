<?php
if(!isset($_GET['projectId'])) {
    exit('no project id!');
} else {
    $project_id = trim($_GET['projectId']);
}


shell_exec("php /var/www/adword_api/examples/AdWords/v201402/Optimization/NewKeywordAdowordSave.php ".$project_id. ' > /dev/null 2 &');

echo 'startead getting adwords info..';