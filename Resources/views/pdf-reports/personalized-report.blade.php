<!DOCTYPE html>
<html>

<head>
    <style>
        table.schedule {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin: 20pt;
        }

        .schedule td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .schedule tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body style="width:550pt; margin:20pt auto">
    <h3 style="text-align:center;"> Mortgage Amortization Schedule - <a style="color:inherit"
            href="{{ env('APP_LINK') }}">{{ env('APP_NAME') }}</a>
    </h3>

    <table style="width:100%; margin:20pt">
        <tr>
            <td>Name: {{$user->name}}</td>
            <td>Email: {{$user->email}}</td>
        </tr>
        <tr>
            <td>Loan Amount: ${{round($mortgage['loanAmount'],2)}}</td>
            <td>Down Payment: ${{round($mortgage['downPayment'],2)}}</td>
        </tr>
        <tr>
            <td>Loan Terms(Year): {{$mortgage['loanTerm']}}</td>
            <td>Loan Months: {{$mortgage['loanMonths']}}</td>
        </tr>
        <tr>
            <td>Rate / Annum: {{round($mortgage['rpa'],2)}}%</td>
            <td>Extra Amount / Month: ${{round($mortgage['extraAmount'],2)}}</td>
        </tr>
        <tr>
            <td>Monthly Payment: ${{round($mortgage['totalMonthlyPayment'],2)}}</td>
        </tr>
    </table>

    <table class="schedule">
        <tr>
            <th>Month</th>
            <th>Starting Balance($)</th>
            <th>Monthly Payment($)</th>
            <th>Interest($)</th>
            <th>Principal($)</th>
            <th>Ending Balance($)</th>
            <th>Total Interest($)</th>
        </tr>
        @foreach ($mortgage['amortization'] as $schedule)
        <tr>
            <td>{{$schedule['month']}}</td>
            <td>{{round($schedule['startingBalance'],2)}}</td>
            <td>{{round($schedule['totalMonthlyPayment'],2)}}</td>
            <td>{{round($schedule['interest'],2)}}</td>
            <td>{{round($schedule['principal'],2)}}</td>
            <td>{{round($schedule['endingBalance'],2)}}</td>
            <td>{{round($schedule['totalInterest'],2)}}</td>
        </tr>
        @endforeach

    </table>

</body>

</html>