@extends('emails.web_mail_template')
@section('content')
<tr>
    <td style="text-align:left; padding:10px 0px 20px 20px; border-bottom:1px solid #e1e1e1;" bgcolor="#f9f9f9">
        <div style="margin:20px auto 10px; font-size:16px;"><b>NEW INQUIRY</b></div>
        <div style="margin:20px auto 10px; font-size:16px;">Thank you for connecting! We are delighted to hear from you. A trusted Qonectin advisor will contact 
            you shortly. In the meantime, you can check the following resources:</div>
        <p style="text-align:center;font-size: 18px;">
           <ul>
                <li><a href="{{ route('web-faq') }}">Frequently Asked Questions </a></li>
                <li><a href="{{ route('web-resources') }}">Buyer and Seller Resources</a></li>
           </ul>
        </p>
    </td>
</tr>
@endsection
