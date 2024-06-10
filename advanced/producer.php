<?php
require_once  '../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class EmailProducer {
    private $connection;
    private $channel;

    public function __construct() {
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare('email_queue', false, false, false, false);
    }

    public function sendEmailRequest($emailData) {
        $msg = new AMQPMessage(json_encode($emailData));
        $this->channel->basic_publish($msg, '', 'email_queue');
        echo " [x] Sent email request\n\n";
    }

    public function __destruct() {
        $this->channel->close();
        $this->connection->close();
    }
}

$producer = new EmailProducer();
$emailData = [
    'to' => 'josephKithome@example.com',
    'subject' => 'PHP Developer Test',
    'body' => 'HI Joseph, Finish the test and revert by friday..'
];
$producer->sendEmailRequest($emailData);

