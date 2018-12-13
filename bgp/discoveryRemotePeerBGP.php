#!/usr/bin/php
<?php
#       Jefte de Lima Ferreira
#       jeftedelima at gmail dot com

#	Incluing routerOS api class
include 'routeros_api.class.php';
$host 	= $argv[1];
$user 	= $argv[2];
$passwd = $argv[3];
$arrayFinal = [];
#	Connecting to Mikrotik
$API = new RouterosAPI();
	if($API->connect($host,$user,$passwd)){
        	$API->write('/routing/bgp/peer/print');
                $array = $API->read();
	}
$API->disconnect();
#	Creating json_array
foreach( $array as $key => $value){
	$arrayFinal['data'][$key]['{#REMOTE_ADDRESS}'] = $value['remote-address'];
}
echo json_encode($arrayFinal, JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
?>
