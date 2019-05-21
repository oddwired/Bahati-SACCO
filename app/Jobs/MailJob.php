<?php

namespace BahatiSACCO\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class MailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $data;
    /**
     * Create a new job instance.
     * @param
     * @return void
     */
    public function __construct($data)
    {
        $this->data = unserialize($data);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = ["name"=> $this->data->name, "body"=> $this->data->body];
        Mail::send("", $data, function ($message){
            $message->to($this->data->email, $this->data->name)
                ->subject($this->data->subject)
                ->from("kshem@kabarak.ac.ke", "Bahati SACCO");
        });
    }
}
