<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // old method 
        // return $this->from('info@harrishairtransplants.com')->subject('New Customer Equiry')->view('dynamic_email_template')->with('data', $this->data);



        $address = $this->data['Email'];
        $subject = $this->data['Subject'];
        $name    = 'kashif';

        return $this->view('email_template_small')
        // return $this->view('email_reset_password_template')
                    ->from('no-reply@inu.edu.pk','Admission')
                     // ->cc('kashif_mushtaq2008@hotmail.com', $name)
                    // ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    // ->with([ 'data' => $this->data['message'] ]);
                    ->with('data' , $this->data );



    }
}

?>