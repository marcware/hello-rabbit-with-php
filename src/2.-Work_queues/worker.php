<?php

require_once __DIR__ . '../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
$channel = $connection->channel();

//MARCAMOS DURABLE
$channel->queue_declare(
    'task_queue',
    false,
    true,// RABBIT NO BORRARÁ LOS MENSAJES SI TIENE PROBLEMAS
    false,
    false
);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
    sleep(substr_count($msg->body, '.'));
    echo " [x] Done\n";
    //AVISAMOS QUE HEMOS RECIVIDO EL MENSAJE
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

//SOLO SE VA A DEJAR UN MENSAJE A UN CONSUMER A LA VEZ
//nO LE ENVÍA UN NUEVO MENSAJE HASTA QUE NO PROCESE EL ANTERIOR
$channel->basic_qos(null, 1, null);

//AVISAR A RABBIT QUE SE HA CONSUMIDO EL MENSAJE
$channel->basic_consume(
    'task_queue',
    '',
    false,
    false,
    false,
    false,
    $callback
);

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();

$connection->close();

