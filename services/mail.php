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
    private $send_to = [];



    public function __constructor(){

    }

    public function setBody($body)
    {
        if(isset($this) && is_object($this)) {
            $this->body = $body;
        }
        else{
            return self::init()->setBody($body);
        }
        return $this;
    }

    public function setSubject($subject)
    {
        if(isset($this) && is_object($this)) {
            $this->subject = $subject;
        }
        else{
            return self::init()->setSubject($subject);
        }
        return $this;
    }

    public function setSendTo($mails)
    {
        if(isset($this) && is_object($this)) {
            if(!is_array($mails)){
                $this->send_to = [$mails];
            }
            else{
                $this->send_to = $mails;
            }
        }
        else {
            return self::init()->setSendTo($mails);
        }
        return $this;
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
        $mail->addAddress(implode(',',$this->send_to));

        $mail->send();
    }

    private function init(){
        if(isset($this) && is_object($this)){
            return $this;
        }
        $class = get_called_class();

        return new $class;
    }



}