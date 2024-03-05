@extends('emails.mail_template')
@section('content')
<tr>
    <td style="text-align:left; padding:10px 0px 20px 20px; border-bottom:1px solid #e1e1e1;" bgcolor="#f9f9f9">
        <div style="margin:20px auto 10px; font-size:16px;"><b>Verify Account</b></div>
        <div style="margin:20px auto 10px; font-size:16px;">Welcome Onboard. You are just one step away to avail our services. Enter below mentioned OTP to activate your account:</div>
        <p style="text-align:center;font-size: 18px;">
            <strong>{{ $otp }}</strong>
        </p>
    </td>
</tr>
@endsection
