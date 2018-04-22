<?php
require('vendor/autoload.php');

// Send an SMS using Twilio's REST API and PHP
$sid = ""; // Your Account SID from www.twilio.com/console
$token = ""; // Your Auth Token from www.twilio.com/console
echo "Hello";
$client = new Twilio\Rest\Client($sid, $token);
$message = $client->messages->create(
  '+17034083959', // Text this number
  array(
    'from' => '+17034548364', // From a valid Twilio number
    'body' => 'Hello from Twilio!'
  )
);
echo $message;

 ?>
