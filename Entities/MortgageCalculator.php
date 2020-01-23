<?php

namespace Modules\Mortgage\Entities;

class MortgageCalculator
{

    private $loanTerm, $loanAmount, $rpa, $rpm, $extraAmount, $loanMonths, $downPayment;

    /**
     * Initializes the main parameters
     *
     * @param int $loanTerm
     * @param int $loanAmount
     * @param int $rpa
     * @param int $extraAmount
     */
    function __construct(int $loanTerm, int $loanAmount, int $rpa, int $extraAmount = 0, int $downPayment = 0)
    {
        $this->loanAmount = $loanAmount - $downPayment;
        $this->loanTerm = $loanTerm;
        $this->rpa = $rpa;
        $this->extraAmount = $extraAmount;
        $this->rpm = $rpa / (100 * 12);
        $this->loanMonths = $loanTerm * 12;
        $this->downPayment = $downPayment;
    }

    public function calculateMortgage()
    {
        $rateExp = pow(1 + $this->rpm, $this->loanMonths);

        $monthlyPayment = $this->loanAmount * (($this->rpm * $rateExp) / ($rateExp - 1));
        $totalMonthlyPayment = $monthlyPayment + $this->extraAmount;

        return [
            "loanAmount" => $this->loanAmount,
            "loanTerm" => $this->loanTerm,
            "rpa" => $this->rpa,
            "rpm" => $this->rpm,
            "extraAmount" => $this->extraAmount,
            "loanMonths" => $this->loanMonths,
            "monthlyPayment" => $monthlyPayment,
            "totalMonthlyPayment" => $totalMonthlyPayment,
            "downPayment" => $this->downPayment
        ];
    }

    public function calculateAmortization()
    {
        $mortgage = $this->calculateMortgage();
        $startingBalance = $this->loanAmount;
        $totalMonthlyPayment = $mortgage['totalMonthlyPayment'];
        $endingBalance = 0;
        $totalInterest = 0;
        $amortization = array();
        $month = 1;

        while ($startingBalance > 0) {
            $interest = $startingBalance * $this->rpm;
            $principal = $totalMonthlyPayment - $interest;
            $endingBalance = $startingBalance - $principal;
            $totalInterest = $totalInterest + $interest;
            array_push($amortization, [
                "month" => $month,
                "startingBalance" => $startingBalance,
                "totalMonthlyPayment" => $totalMonthlyPayment,
                "interest" => $interest,
                "principal" => $principal,
                "endingBalance" => $endingBalance,
                "totalInterest" => $totalInterest
            ]);

            $startingBalance = $endingBalance;
            $month = $month + 1;
        }

        $mortgage['amortization'] = $amortization;

        return $mortgage;
    }
}
