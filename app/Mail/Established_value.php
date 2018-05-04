<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Realtime;

class Established_value extends Mailable
{
    use Queueable, SerializesModels;

    public $Realtime; // 追加

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Realtime $Realtime)
    {
      $this->realtime = $Realtime;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.establish_value')
        ->subject('Kabuboard お知らせ 条件成立 現在値')
        ->with([
          'establish_code' => $this->realtime->code,
          'establish_name' => $this->realtime->name,
          'establish_value' => $this->realtime->value,
          'establish_upperlimit' => $this->realtime->upperlimit,
          'establish_lowerlimit' => $this->realtime->lowerlimit
        ]);
    }
}
