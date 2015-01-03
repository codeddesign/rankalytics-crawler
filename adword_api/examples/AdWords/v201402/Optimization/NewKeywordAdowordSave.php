<?php
/*if (!isset($_SESSION)) {
    session_start();
}*/
include __DIR__.'/../../../../../auto_load.php';

/* include needed files: */
require_once dirname(dirname(__FILE__)) . '/init.php';
require_once UTIL_PATH . '/MapUtils.php';
require_once 'functions.php';

try {
    // Get AdWordsUser from credentials in "../auth.ini"
    // relative to the AdWordsUser.php file's directory.

    $keywordCount = '';//$_POST['keywordCount'];
    $projectId = $argv[1];

    $user = new AdWordsUser();

    // Log every SOAP XML request and response.
    $user->LogAll();

    // Run the example.
    EstimateKeywordTrafficExample($user, $projectId, $keywordCount);
} catch (Exception $e) {
    printf("An error has occurred: %s\n", $e->getMessage());
    echo "<br/>";
}
?>