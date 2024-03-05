@extends('emails.mail_template')
@section('content')
<tr>
    <td style="text-align:left; padding:10px 0px 20px 20px; border-bottom:1px solid #e1e1e1;" bgcolor="#f9f9f9">
        <div style="margin:20px auto 10px; font-size:16px;">Hi {{ $data['role'] }} , </div>
        <div style="margin:20px auto 10px; font-size:16px;">I really appreciate you joining us at VINERO, and I know you’ll love it when you see how easy it is to deliver awesome, personal wishes to every friend on their events.
            We make VINERO to help everyone store precious wishes for lifetime they get on their events, to gift their friends and relatives in a unique way and I hope that we can achieve that for you. 
            For more information about VINERO, including download links and features, Please go to <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
        </div>
        <div style="margin:20px auto 10px; font-size:16px;">
            Thanks!<br>
            Team {{ config('app.name') }}
        </div>
    </td>
</tr>
@endsection