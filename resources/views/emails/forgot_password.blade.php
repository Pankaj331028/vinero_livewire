@extends('emails.mail_template')
@section('content')
<tr>
    <td style="text-align:left; padding:10px 0px 20px 20px; border-bottom:1px solid #e1e1e1;" bgcolor="#f9f9f9">
        <div style="margin:20px auto 10px; font-size:16px;"><b>Password Reset</b></div>
        <div style="margin:20px auto 10px; font-size:16px;">If you've lost your password, please use below Otp to login. You can change password anytime.</div>
        <p style="text-align:center;font-size: 18px;">
            <strong>{{ $otp }}</strong>
        </p>
    </td>
</tr>
@endsection
