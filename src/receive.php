<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, true, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function($msg) {
    $waitSeconds = rand(15,30);
    echo " [x] Host: " . getenv('HOSTNAME') ." Waiting: " . $waitSeconds . " seconds. Received msg: ", $msg->body, "\n";
    //sleep(substr_count($msg->body, '.'));
    sleep($waitSeconds);
    echo " [x] Done", "\n";
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('hello', '', false, false, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}