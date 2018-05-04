<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Realtime;

class Establish_changerate extends Mailable
{
    use Queueable, SerializesModels;

    public $Realtime;

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
        return $this->view('emails.establish_changerate')
        ->subject('Kabuboard お知らせ 条件成立 急騰急落')
        ->with([
          'establish_code' => $this->realtime->code,
          'establish_name' => $this->realtime->name,
          'establish_changerate' => $this->realtime->changerate,
          'establish_pre_changerate' => $this->realtime->pre_changerate,
          'establish_changecount' => $this->realtime->changecount,
          'establish_changerate_range' => $this->realtime->changerate_range
        ]);
    }
}
