<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ToShareEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$playStoreLink="https://play.google.com/store/apps/details?id=br.com.prak.planoz";
        $websiteLink = "https://sys.regcalls.com/demo/public";
		return $this->view('email/toshare-email')
		->withPlayStoreLink($playStoreLink)->withWebsiteLink($websiteLink);
    }
}

