<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/names.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

function sendMessage($message = 'Hello World!')
{
    $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    $channel    = $connection->channel();

    $channel->queue_declare('register', false, false, false, false);

    $msg = new AMQPMessage($message);
    $channel->basic_publish($msg, '', 'hello');

    echo " [x] Sent 'Hello World!'\n";

    $channel->close();
    $connection->close();

}

function sendRegisterMEssage()
{
    $data    = array("name" => getRandName());
    $event   = array("id" => md5(rand()), "timestamp" => time(), "event" => "registerUser", "data" => $data);
    $message = json_encode($event);
    echo $message;
    sendMessage($message);
}

function sendListUsersMessage()
{
    $data    = array();
    $event   = array("id" => md5(rand()), "timestamp" => time(), "event" => "listUsers", "data" => $data);
    $message = json_encode($event);
    sendMessage($message);
}

sendRegisterMEssage();
sleep(2);
sendListUsersMessage();

