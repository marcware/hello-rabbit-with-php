<?php

require_once __DIR__ . '../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare(
    'task_queue',
    false,
    true, //LA COLA ESTÁ CREADA COMO durable
    false,
    false
);

$data = implode(' ', array_slice($argv, 1));

if (empty($data)) {
    $data = "Hello World!";
}

// MARCAMOS EL MENSAJE COMO modo de entrega persistente
$msg = new AMQPMessage(
    $data,
    //MARCAMOS MENSAJES COMO PERSISTENTES
    array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
);

$channel->basic_publish($msg, '', 'task_queue');

echo ' [x] Sent ', $data, "\n";

$channel->close();

$connection->close();

