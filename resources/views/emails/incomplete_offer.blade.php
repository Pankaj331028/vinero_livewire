@extends('emails.mail_template')
@section('content')
<tr>
    <td style="text-align:left; padding:10px 0px 20px 20px; border-bottom:1px solid #e1e1e1;" bgcolor="#f9f9f9">
        <div style="margin:20px auto 10px; font-size:16px;">Hi {{ $data->buyer_name }} , </div>
        <div style="margin:20px auto 10px; font-size:16px;">Some of the information is missing. Please review it and resubmit <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
        </div>
        <div style="margin:20px auto 10px; font-size:16px;">
            Thanks!<br>
            Team {{ config('app.name') }}
        </div>
    </td>
</tr>
@endsection