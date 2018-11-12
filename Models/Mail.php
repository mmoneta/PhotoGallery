<?php
  class Mail {
  	private $to;
  	private $subject;
  	private $message;
  	private $headers;

  	function __construct() {
  	  $this->headers = "MIME-Version: 1.0"."\r\n";
  	  $this->headers .= 'From: Admin <info@address.com>' . "\r\n";
      $this->headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
  	}

  	function adress($adress) {
  	  $this->to = $adress;
  	}

  	function CC($adress) {
  	  $this->headers .= 'Cc:'.$adress.'\r\n';
  	}

  	function subject($subject) {
  	  $this->subject = $subject;
  	}

  	function message() {
  	  $this->message = "
	    <html>
          <head>
            <title>Recovery password</title>
          </head>
          <body>
            <a href='".Config::getFullHost()."/key'>Recovery password</a>
          </body>
        </html>";
  	}

  	function send() {
  	  mail($this->to,$this->subject,$this->message,$this->headers);
  	}
  }
?>