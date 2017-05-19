<?php
namespace Services;

use PHPMailer;
class Mail{
    //smtp information
    private $host = '';
    private $username = '';
    private $password = '';
    private $port = '25';
    private $encryption = 'tls';

    //mail information
    private $subject = '';
    private $body = '';



    public function __constructor(){

    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function send(){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';

        $mail->Host       = $this->host;
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->Port       = $this->port;
        $mail->Username   = $this->username;
        $mail->Password   = $this->password;
        $mail->SMTPSecure = $this->encryption;
        $mail->setFrom('no-reply@team16m.p004.nl', 'Praesentia');
        $mail->addReplyTo('info@windesheimflevoland.nl', 'Windesheimflevolan');
        $mail->isHTML(true);

        $mail->Subject = $this->subject;
        $mail->Body    = $this->body;

        $mail->send();
    }

}