<?php
header('Content-Type: text/html; charset=utf-8');

if(!isset($_GET['keyword'])) {
    exit('no word.');
} else {
    $search_string = trim($_GET['keyword']);
}


// load classes:
require_once 'auto_load.php';

// init db
$dbo = new DbHandle();

// get proxies
$proxies = $dbo->getProxies("SELECT * FROM proxy WHERE google_blocked='0'".'');
$random = mt_rand(0, count($proxies)-1);
$proxy = array(
    'ip' => $proxies[$random]['ip'],
    'username' => $proxies[$random]['username'],
    'password' => $proxies[$random]['password'],
);

// do search:
$max_results = 30;

$config = array(
    'url' => "https://www.google.de/search?q=" . $search_string . "&hl=de&start=0&num=".$max_results,
    'header' => 0,
    'timeout' => 30,
    'agent' => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.16) Gecko/20080702 Firefox/2.0.0.16",
);

//$search_string_2 = urlencode('['.$search_string.']');
//$config['url'] = "https://www.google.de/search?q=" . $search_string_2 . "&hl=de&start=0&num=".$max_results;
/*$config['url'] = "https://www.google.de/search?q=" . urlencode($search_string) . "&tbm=vid&hl=de&start=0&num=" . $max_results;*/
exit;
// init:
$ch = curl_init();
curl_setopt($ch, CURLOPT_TIMEOUT, $config['timeout']);
curl_setopt($ch, CURLOPT_HEADER, $config['header']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $config['url']);
curl_setopt($ch, CURLOPT_USERAGENT, $config['agent']);

//proxy zone:
if (trim($proxy['username']) != "" AND trim($proxy['password']) != "") {
    // #todo - change to class too:
    curl_setopt($ch, CURLOPT_PROXYTYPE, 'HTTP');
    curl_setopt($ch, CURLOPT_PROXY, $proxy['ip']);
    curl_setopt($ch, CURLOPT_PROXYUSERPWD, trim($proxy['username']) . ':' . trim($proxy['password']));
    curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
}

$data = curl_exec($ch);
curl_close($ch);

echo $data;