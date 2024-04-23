<?php

use Twilio\Rest\Client;

// Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
function send()
{
    $sid = TWILIO_SID;
    $token = TWILIO_AUTH_TOKEN;
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
                      ->create("+94772903494", 
                               [
                                   "body" => "Me para awe nettam pole gahanawa sathtai",
                                   "from" => "+12706813407"
                               ]
                      );

    echo json_encode($message);
}
