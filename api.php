<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/names.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

function sendMessage($message = 'Hello World!', $queue)
{
    $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    $channel    = $connection->channel();

    $channel->exchange_declare('logs', 'fanout', false, false, false);

    $msg = new AMQPMessage($message);
    $channel->basic_publish($msg, 'logs');

    echo "\n [x] Sent $message\n\n";

    $channel->close();
    $connection->close();

}


function sendMessageToQueue($message = 'Hello World!', $queue)
{
    $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    $channel    = $connection->channel();

    $channel->queue_declare($queue, false, false, false, false);

    $msg = new AMQPMessage($message);
    $channel->basic_publish($msg, '', $queue);

    echo "\n [x] Sent $message\n\n";

    $channel->close();
    $connection->close();

}

function sendRegisterMessage()
{
    $data    = array("name" => getRandName());
    $event   = array("id" => md5(rand()), "timestamp" => time(), "event" => "registerUser", "data" => $data);
    $message = json_encode($event);
    $queue   = 'register';
    sendMessageToQueue($message, $queue);
}

function sendListUsersMessage()
{
    $data    = array();
    $event   = array("id" => md5(rand()), "timestamp" => time(), "event" => "listUsers", "data" => $data);
    $message = json_encode($event);
    $queue   = 'listUsers';
    sendMessage($message, $queue);
}

sleep(1);
sendRegisterMessage();
//sleep(1);
//sendListUsersMessage();

