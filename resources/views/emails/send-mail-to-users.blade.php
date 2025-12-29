@extends('emails.email-layout')
@section('content')
    
	 <tr>
      <td bgcolor="#ffffff" style="padding: 40px 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; width:100%; max-width:600px;"><p style="margin: 0;"> <strong>Hi {{$firstname}} {{$lastname}},</strong><br>

    <h4>Message:</h4>
    <p>{!!$message_body!!}</p>

@endsection