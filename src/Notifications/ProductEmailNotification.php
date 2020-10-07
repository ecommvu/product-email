<?php

namespace Ecommvu\ProductEmail\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductEmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    /*
     * @var data
     *
     */
    public $context;

    public function __construct($context)
    {
        $this->context = $context;
    }

    public function build()
    {
        return $this->to($this->context['customer_email'], $this->context['customer_name'])
            ->from(\Company::getCurrent()->email, \Company::getCurrent()->name)
            ->subject($this->context['subject'])
            ->view('productemail::emails.product-email');
    }
}
