<?php

// $data = stream_get_contents(STDIN);

// This is our new stuff
$context = new ZMQContext();
$socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'apache access logs');
$socket->connect("tcp://localhost:5555");


$rawdata = "";
while (false !== ($line = fgets(STDIN))) {

	$entryData = array(
		'category' => 'onAccessLogPush',
		'data'     => $line,
		'when'     => time()
		);

	$socket->send(json_encode($entryData));
}