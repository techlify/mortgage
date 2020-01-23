<?php

namespace Modules\Mortgage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\User;
use Modules\Mortgage\Entities\MortgageCalculator;

use Modules\Mortgage\Jobs\PersonalizedReportJob;

class MortgageController extends Controller
{
    public function mortgage(Request $request)
    {

        $rules = [
            "loanAmount" => "required",
            "rpa" => "required",
            "loanTerm" => "required"
        ];

        $request->validate($rules);

        $mortgageCalculator = new MortgageCalculator(request('loanTerm'), request('loanAmount'), request('rpa'), request('extraAmount', 0), request('downPayment', 0));
        return ["data" => $mortgageCalculator->calculateMortgage()];
    }

    public function amortization(Request $request)
    {
        $rules = [
            "loanAmount" => "required",
            "rpa" => "required",
            "loanTerm" => "required"
        ];

        $request->validate($rules);

        $mortgageCalculator = new MortgageCalculator(request('loanTerm'), request('loanAmount'), request('rpa'), request('extraAmount', 0), request('downPayment', 0));
        return ["data" => $mortgageCalculator->calculateAmortization()];
    }

    public function report(Request $request)
    {
        $rules = [
            "loanAmount" => "required",
            "rpa" => "required",
            "loanTerm" => "required"
        ];

        $request->validate($rules);

        $user = auth()->user();

        $data = [
            "loanTerm" => request('loanTerm'),
            "loanAmount" => request('loanAmount'),
            "rpa" => request('rpa'),
            "extraAmount" => request('extraAmount', 0),
            "downPayment" => request('downPayment', 0)
        ];

        PersonalizedReportJob::dispatch($data, $user);

        return ["status" => "success"];
    }
}
