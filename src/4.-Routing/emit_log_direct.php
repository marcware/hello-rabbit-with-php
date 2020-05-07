<?php

require_once __DIR__ . '../../vendor/autoload.php';


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
$channel = $connection->channel();

//DECLARAMOS EL EXCHANGE
$channel->exchange_declare(
    //BINDING NAME direct_logs
    'direct_logs',
    'direct',
    false,
    false,
    false
);

//ROUTING KEY que le pasamos al comando
$severity = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'info';

$data = implode(' ', array_slice($argv, 2));
if (empty($data)) {
    $data = "Hello World!";
}

$msg = new AMQPMessage($data);

//ENVIAMOS EL MENSAJE ESPECIFICANDO EL ROUTING KEY $severity Y A QUE EXCAHNGE
$channel->basic_publish($msg, 'direct_logs', $severity);

echo ' [x] Sent ', $severity, ':', $data, "\n";

$channel->close();

$connection->close();

