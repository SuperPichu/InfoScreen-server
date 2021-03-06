<?php

require 'std.php';

$dom = new DOMDocument();

$doc->formatOutput = false;
$dom->load($STORE_FILE_NAME);
$root=$dom->documentElement;

$cmd = "";
if(!empty($_GET['cmd']))
        $cmd = $_GET['cmd'];

if($cmd == 'dismiss'){
        $dom->getElementsByTagName('alertIsActive')->item(0)->nodeValue = 'false';
} else if ($cmd == 'enable') {
        $dom->getElementsByTagName('alertIsActive')->item(0)->nodeValue = 'true';
        $dom->getElementsByTagName('alertText')->item(0)->nodeValue = $_GET['msg'];
        $dom->getElementsByTagName('alertSender')->item(0)->nodeValue = $_GET['sender'];
} else if ($cmd == 'setTwitch'){
		$dom->getElementsByTagName('twitchChannel')->item(0)->nodeValue = $_GET['channel'];
} else if ($cmd == 'setBus'){
    $dom->getElementsByTagName('defaultStop')->item(0)->nodeValue = $_GET['stop'];
}

$dom->save($STORE_FILE_NAME);
echo $dom->saveXML();

?>
