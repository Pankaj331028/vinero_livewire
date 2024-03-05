@extends('emails.mail_template')
@section('content')
<tr>
    <td style="text-align:left; padding:10px 0px 20px 20px; border-bottom:1px solid #e1e1e1;" bgcolor="#f9f9f9">
        <div style="margin:20px auto 10px; font-size:16px;">Hi {{ $admin->name }} , </div>
        <div style="margin:20px auto 10px; font-size:16px;">{{env('APP_NAME')}} Admin has created a new SubAdmin Account for you. Login to your <a href="{{route('login')}}">panel</a> using below credentials:
            <br>
            <p>
                <strong>Email: </strong>{{$admin->email}}<br>
                <strong>Password: </strong>{{$pwd}}
            </p>
        </div>
        <div style="margin:20px auto 10px; font-size:16px;">
            Thanks!<br>
            Team {{ config('app.name') }}
        </div>
    </td>
</tr>
@endsection