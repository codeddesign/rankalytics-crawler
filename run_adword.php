<?php
include 'auto_load.php';

if (!isset($_GET['projectId'])) {
    exit('no project id!');
} else {
    $project_id = trim($_GET['projectId']);
}


shell_exec("php " . $config['prj_path'] . "/adword_api/examples/AdWords/v201402/Optimization/NewKeywordAdowordSave.php " . $project_id . ' > /dev/null 2 &');

echo 'startead getting adwords info..';