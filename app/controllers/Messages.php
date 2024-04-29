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

    public function reservationSuccess($number, $name, $date, $time, $reservaionID)
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

    public function paymerntConfirmation($number, $name, $amount, $reservaionID)
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

    public function sendOTP()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $number = $_POST['number'];
        } else {
            echo "Method not allowed";
            exit();
        }
        $this->validateNumber($number);
    }

    public function sendReservationSuccess()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $number = $_POST['number'];
            $name = $_POST['name'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $reservaionID = $_POST['reservaionID'];
        } else {
            echo "Method not allowed";
            exit();
        }
        $this->reservationSuccess($number, $name, $date, $time, $reservaionID);
    }


    public function sendPaymentConfirmation()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $number = $_POST['number'];
            $name = $_POST['name'];
            $amount = $_POST['amount'];
            $reservaionID = $_POST['reservaionID'];
        } else {
            echo "Method not allowed";
            exit();
        }
        $this->paymerntConfirmation($number, $name, $amount, $reservaionID);
    }

    public function verifyOTP()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $otp = $_POST['otp'];
        } else {
            echo "Method not allowed";
            exit();
        }
        $otp = $this->messageModel->getOTP();
        if ($otp == $otp) {
            echo json_encode("OTP verified successfully");
        } else {
            echo json_encode("OTP verification failed");
        }
    }

    public function getOTP()
    {
        $otp = $this->messageModel->getOTP();
        echo json_encode($otp);
    }

    public function setOTP($otp)
    {
        $this->messageModel->setOTP($otp);
    }
    public function twilioVerify($number)
    {

        $sid = TWILIO_SID;
        $token = TWILIO_AUTH_TOKEN;
        $twilio = new Client($sid, $token);

        $verification = $twilio->verify->v2->services(WAAPISID)
            ->verifications
            ->create("$number", "whatsapp");

        print($verification->accountSid);
    }
}
