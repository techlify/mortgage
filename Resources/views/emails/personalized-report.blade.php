@extends('email.layouts.app')

@section('title', 'Personalized report')

@section('content')
<tr>
    <td class="container">

        <table>
            <tr class="text-center">
                <td>Hello {{$user->name}}, please find attachment your personalized amortization schedule report.</td>
            </tr>
        </table>

    </td>
</tr>
@endsection