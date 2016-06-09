<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Model/Event.php';
require_once __DIR__ . '/app/Model/User.php';
require_once __DIR__ . '/app/Repos/UserRepo.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

function receiveMessage($queue)
{

    $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    $channel    = $connection->channel();

    $channel->queue_declare($queue, false, false, false, false);

    echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

    $callback = function ($msg) {
        echo " [x] Received ", $msg->body, "\n";

        $event    = json_decode($msg->body);
        $eventObj = new Event($event->id, $event->timestamp, new User($event->data->name), $event->event);
//        $userRepo = new UserRepo();
        UserRepo::createUser($eventObj->getData());
        var_dump(UserRepo::getUsers());
    };

    $channel->basic_consume($queue, '', false, true, false, false, $callback);

    while (count($channel->callbacks)) {
        $channel->wait();
    }
}

$queue = isset($argv[1]) ? $argv[1] : '';

switch ($queue) {
    case 'register':
    case 'userCreation' :
        break;
    default:
        $queue = 'register';

}
receiveMessage($queue);
