<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\NotificationLog;

class MyTestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($toEmail, $name, $subject, $body, $candidateId)
    {
        $this->toEmail = $toEmail;
        $this->name = $name;
        $this->subject = $subject;
        $this->body = $body;
        $this->candidateId = $candidateId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = new PHPMailer(true);
        try {
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->SMTPDebug = 2;
            $mail->Username = 'jobs.ndhcareltd@gmail.com';   //  sender username
            $mail->Password = 'jiarlhwdfjssoeky';       // sender password
            $mail->SMTPSecure = 'ssl';                  // encryption - ssl/tls
            $mail->Port = 465;                          // port - 587/465

            $mail->setFrom('jobs.ndhcareltd@gmail.com', 'Jor Portal');
            $mail->addAddress($this->toEmail, $this->name = $name);

            // $mail->addReplyTo('jobs.ndhcareltd@gmail.com', 'Jor Portal');
            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = $this->subject;
            $mail->Body = $this->body;

            // $mail->AltBody = plain text version of email body;
            if( !$mail->send() ) {
                NotificationLog::create([
                    "candidate_id" => $this->candidateId,
                    "subject" => $this->subject,
                    "request" => '',
                    "status" => 'No',
                    "response" => 'Failed'
                ]);
                return false;
            } else {
                NotificationLog::create([
                    "candidate_id" => $this->candidateId,
                    "subject" => $this->subject,
                    "request" => '',
                    "status" => 'Yes',
                    "response" => 'Success'
                ]);
                return true;
            }
        } catch (Exception $e) {
            NotificationLog::create([
                "candidate_id" => $this->candidateId,
                "subject" => $this->subject,
                "request" => '',
                "status" => 'No',
                "response" => $e
            ]);
            return false;
        }
    }
}