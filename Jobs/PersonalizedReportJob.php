<?php

namespace Modules\Mortgage\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Mortgage\Entities\MortgageCalculator;
use Modules\Mortgage\Emails\PersonalizedReportEmail;
use Illuminate\Support\Facades\Mail;
use Exception;

class PersonalizedReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data, $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $user)
    {
        $this->data = $data;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $mortgageCalculator = new MortgageCalculator($this->data['loanTerm'], $this->data['loanAmount'], $this->data['rpa'], $this->data['extraAmount'], $this->data['downPayment']);

            $mortgage = $mortgageCalculator->calculateAmortization();

            Mail::send(new PersonalizedReportEmail($this->user, $mortgage));
        } catch (Exception $e) {
            report($e);
        }
    }
}
