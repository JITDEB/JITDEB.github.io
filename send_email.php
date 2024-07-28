<?php
require_once 'path/to/twilio-php/src/Twilio/autoload.php';  // Path to Twilio PHP library
use Twilio\Rest\Client;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['fullMessage'];

    // Email setup
    $to = "your-email@example.com";  // Replace with your email address
    $headers = "From: " . $email;

    $email_message = "Name: " . $name . "\n";
    $email_message .= "Email: " . $email . "\n";
    $email_message .= "Subject: " . $subject . "\n";
    $email_message .= "Message: " . $message . "\n";

    if (mail($to, $subject, $email_message, $headers)) {
        echo "Email sent successfully!";
    } else {
        error_log("Failed to send email to $to", 0);
        echo "Failed to send email.";
    }

    // Send SMS using Twilio
    send_sms($name, $subject, $message);
}

function send_sms($name, $subject, $message) {
    $sid = 'your_twilio_sid';  // Your Twilio SID
    $token = 'your_twilio_auth_token';  // Your Twilio Auth Token
    $twilio_number = 'your_twilio_phone_number';  // Your Twilio phone number

    $client = new Client($sid, $token);

    $sms_message = "Name: " . $name . "\n";
    $sms_message .= "Subject: " . $subject . "\n";
    $sms_message .= "Message: " . $message . "\n";

    try {
        $client->messages->create(
            'recipient_phone_number',  // Replace with recipient phone number
            array(
                'from' => $twilio_number,
                'body' => $sms_message
            )
        );
        echo "SMS sent successfully!";
    } catch (Exception $e) {
        error_log("Failed to send SMS: " . $e->getMessage(), 0);
        echo "Failed to send SMS.";
    }
}
?>
