#!/usr/bin/php
<?php
#       Jefte de Lima Ferreira
#       jeftedelima at gmail dot com

#	Including routerOS api class
include 'routeros_api.class.php';
$host 	= $argv[1];
$user 	= $argv[2];
$passwd = $argv[3];
$remote = $argv[4];
#	Connecting to Mikrotik
$API = new RouterosAPI();
	if($API->connect($host,$user,$passwd)){
        	$API->write('/routing/bgp/peer/print',false);
                $API->write('=status=',false);
                $API->write('=where=',false);
                $API->write("?remote-address=$remote");
                $array = $API->read();
	}
$API->disconnect();
#	Checking state
switch ($array[0]['state']){
	case 'idle':
		echo "1";
	break;
	case 'connect':
		echo "2";
	break;
	case 'active':
		echo "3";
	break;
	case 'opensent':
		echo "4";
	break;
	case 'openconfirm':
		echo "5";
	break;
	case 'established':
		echo "6";
	break;
}
?>
