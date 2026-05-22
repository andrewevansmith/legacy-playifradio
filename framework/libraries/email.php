<?php

class Emailer {

    function __construct($subject) {
        $this->headers = "From: " . APP_EMAIL . "\r\n";
        $this->headers .= "Reply-To: ". APP_EMAIL . "\r\n";
        // $this->headers .= "CC: susan@example.com\r\n";
        $this->headers .= "MIME-Version: 1.0\r\n";
        $this->headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $this->subject = $subject;
    }

    function set_message_file($filename = 'default.html') {
        $this->message = file_get_contents('emails/'.$filename);
    }

    function send($to) {
        mail($to, $this->subject, $this->message, $this->headers);
    }

}
