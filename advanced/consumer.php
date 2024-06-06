<?php
require_once '../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class EmailConsumer {
    private $connection;
    private $channel;
    private $messageCount;

    public function __construct() {
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
        list(, $this->messageCount, ) = $this->channel->queue_declare('email_queue', true);
        $this->channel->queue_declare('email_queue', false, false, false, false);
    }

    public function processEmails() {
        $callback = function($msg) {
            $emailData = json_decode($msg->body, true);
            $this->sendEmail($emailData);
            echo "Consumed message: " . $msg->body . "\n"; 
            $this->messageCount--;

            if ($this->messageCount == 0) {
                $this->channel->basic_cancel($msg->delivery_info['consumer_tag']);
            }
        };

        $this->channel->basic_consume('email_queue', '', false, true, false, false, $callback);

        while ($this->messageCount > 0 && $this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    private function sendEmail($emailData) {
        // Simulate email sending
        echo "Sending email to: " . $emailData['to'] . "\n";
        echo "Subject: " . $emailData['subject'] . "\n";
        echo "Body: " . $emailData['body'] . "\n";
    }

    public function __destruct() {
        $this->channel->close();
        $this->connection->close();
    }
}

$consumer = new EmailConsumer();
$consumer->processEmails();
echo "Finished processing all messages.\n";
?>
