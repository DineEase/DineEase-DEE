<?php

use Twilio\Rest\Client;

class Messages extends Controller
{
    public $messageModel;

    public function __construct()
    {

        $this->messageModel = $this->model('Message');
    }
    public function send()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $number = $_POST['number'];
            $messageToSend = $_POST['messageToSend'];
        } else {
            echo "Method not allowed";
            exit();
        }
        $sid = TWILIO_SID;
        $token = TWILIO_AUTH_TOKEN;
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                $number,
                [
                    "body" => $messageToSend,
                    "from" => MYNUMBER
                ]
            );

        echo json_encode($message);
    }

    public function validateNumber($number)
    {
        $code = str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);
        $this->messageModel->setOTP($code);
        $sid = TWILIO_SID;
        $token = TWILIO_AUTH_TOKEN;
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                $number,
                [
                    "body" => "Your DineEase verification code is: " . $code,
                    "from" => MYNUMBER
                ]
            );

        echo json_encode("OTP sent successfully");
    }

    public function reservationSuccess($number, $name, $date, $time , $reservaionID)
    {
        $sid = TWILIO_SID;
        $token = TWILIO_AUTH_TOKEN;
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                $number,
                [
                    "body" => "Hello " . $name . ", your reservation for " . $date . " at " . $time . " has been successfully made. Your reservation ID is: " . $reservaionID,
                    "from" => MYNUMBER
                ]
            );

        echo json_encode("Reservation confirmation message sent successfully");
    }

    public function paymerntConfirmation($number, $name, $amount , $reservaionID)
    {
        $sid = TWILIO_SID;
        $token = TWILIO_AUTH_TOKEN;
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                $number,
                [
                    "body" => "Hello " . $name . ", your payment of " . $amount . " for reservation ID: " . $reservaionID . " has been successfully made.",
                    "from" => MYNUMBER
                ]
            );

        echo json_encode("Payment confirmation message sent successfully");
    }
}
