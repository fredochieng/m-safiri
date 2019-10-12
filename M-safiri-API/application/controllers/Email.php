<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller{
    
    public function  __construct(){
         parent::__construct();
         // Load PHPMailer library
        $this->load->library('phpmailer_lib');
    }
    
    public function send(){
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'mail.itechgaints.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'prabhat@itechgaints.com';
        $mail->Password = 'prabhat@123';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 25;
        
        $mail->setFrom('prabhat@itechgaints.com', 'Eleganzit');
        //$mail->addReplyTo('info@example.com', 'CodexWorld');
        
        // Add a recipient
        $mail->addAddress('akash.eleganzit@gmail.com');
        
        // Add cc or bcc 
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = 'PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }
    
}