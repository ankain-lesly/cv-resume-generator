<?php
namespace App\Config;

class sendEmail {
  private String $logo = ROOT_URL."static/media/UPS_logo.svg"; 
  private string $main_email = MAIN_EMAIL;

  
  private ?String $email_send_to = null;
  private ?String $email_subject = null;
  private ?String $email_headers = null;
  private ?String $email_body = null;


  // private String $email_body = null;

  public function __construct($custom_header = null)
  {
    $this->email_body = '<html> <head> <title>{{subject}}</title> <style> .mail_btn { padding: 1rem 2rem; border-radius:10px; background-color: #3838de; color: #fff; display: block; width: max-content; margin: auto; } </style> </head> <body> <div class="container"> {{header}} <div class="content"  style="padding: 10px;">{{content}}</div> </div> </body></html>';

    if($custom_header) {
      $this->email_body = str_replace('{{header}}', $custom_header, $this->email_body);;
    }else {
      // TODO: Design the header
      $header = '
        <div class="header" style="color: #fff; display: flex; align-items: center; justify-content: space-between; padding: 12px; background-color: #351c15;">
          <img src="'.$this->logo.'" alt="Logo">
          <h4>UPS Carriers</h4>
        </div>';


      $this->email_body = str_replace('{{header}}', $header, $this->email_body);;;
    }
  }

// Set Email Parameters
  public function setEmail($to, $subject, $body, $from = null) {
    $this->email_headers .=  "To: Client <$to> \r\n";
    $this->email_send_to = $to;
    $this->email_subject = $subject;

    $this->email_body = str_replace('{{subject}}', $subject, $this->email_body);
    $this->email_body = str_replace('{{content}}', $body, $this->email_body);

    $this->setHeaders($from);
  }
  
  // Set Email Headers
  public function setHeaders($sender_email) {
    if($sender_email) {
      $headers = "From: UPS Carriers <$sender_email> \r\n";
    } else {
      $headers = "From: UPS Carriers <$this->main_email> \r\n";
    }

    $headers .= "Cc: UPS Customer Service <$this->main_email> \r\n";
    $headers .= "MIME-Version: 1.0 \r\n";
    $headers .= "Content-type: text/html; charset=UTF-8 \r\n";
    $headers .= "Reply-To: $this->main_email \r\n ";
    $this->email_headers = $headers;
  }

  public function send() {
    echo 'sending...';
    // $result = mail('to', 'subject', 'message', 'headers');
    $result = mail($this->email_send_to, $this->email_subject, $this->email_body, $this->email_headers);
    var_dump($result);
    
    return $result;
  }

}

?>