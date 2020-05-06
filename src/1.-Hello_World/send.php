<?php

require_once __DIR__ . '../../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

//CONECTAMOS CON EL RABBIT
//HOST: ES EL SERVICIO DE DOCKER
$connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');

//CREAMOS EL CANAL
$channel = $connection->channel();

//CREAMOS EL MENSAJTE
$msg = new AMQPMessage('Hello World!');

//ENVIAMOS EL MENSAJE
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent 'Hello World!'\n";

$channel->close();
$connection->close();
