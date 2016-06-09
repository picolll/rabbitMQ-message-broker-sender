<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

function receiveMessage($queue)
{
    $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    $channel    = $connection->channel();

    $channel->queue_declare($queue, false, false, false, false);

    echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

    $callback = function ($msg) {
        echo " [x] Received ", $msg->body, "\n";
    };

    $channel->basic_consume($queue, '', false, true, false, false, $callback);

    while (count($channel->callbacks)) {
        $channel->wait();
    }
}

$queue = $argv[1];

switch ($queue) {
    case 'register':
    case 'userCreation' :
        break;
    default:
        $queue = 'register';

}
receiveMessage($queue);
