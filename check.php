<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Model/Event.php';
require_once __DIR__ . '/app/Model/User.php';
require_once __DIR__ . '/app/Repos/UserRepo.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;


const noEnd = true;

function check($queue_name)
{

    $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    $channel    = $connection->channel();

    $channel->exchange_declare('logs', 'fanout', false, false, false);

    list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);
var_dump($queue_name);
    $channel->queue_bind($queue_name, 'logs');
    $queue = $channel->basic_get($queue_name, true);
    var_dump($queue); //SADSAGD
    if (!$queue){
        echo "\nIt is OK";
    } else {
        echo "\nIt is NOT OK, there is a unconsumed message";
    }


    while (count($channel->callbacks)) {
        $channel->wait();
    }
}


$queue = isset($argv[1]) ? $argv[1] : 'userCreation';

switch ($queue) {
    case 'register':
    case 'userCreation' :
        break;
    default:
        $queue = 'userCreation';

}

while (noEnd) {
    check($queue);
    sleep(2);
}

