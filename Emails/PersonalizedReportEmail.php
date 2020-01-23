<?php

namespace Modules\Mortgage\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Barryvdh\DomPDF\Facade as PDF;

class PersonalizedReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $mortgage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $mortgage)
    {
        $this->user = $user;
        $this->mortgage = $mortgage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $mortgage = $this->mortgage;

        $pdf = PDF::loadView('mortgage::pdf-reports.personalized-report', compact('user'), compact('mortgage'))->setPaper('a4', 'landscape')->setWarnings(false);

        return $this->from(env('EMAIL_FROM', 'no-reply@techlify.com'), env('EMAIL_FROM_NAME', 'Properties.gy'))
            ->to($this->user['email'])
            ->subject('Personalized Amortization Schedule Report')
            ->view('mortgage::emails.personalized-report')
            ->with('user', $this->user)
            ->attachData($pdf->output(), 'personalized-report.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
