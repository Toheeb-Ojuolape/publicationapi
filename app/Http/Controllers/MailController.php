<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function mail(Request $request){
       $mailData = [
           'recipient' => $request->email,
            'name' => $request->name,
            'subject'=> $request->subject,
            'body' => $request->body,
            'from' => 'hello.tellbooks@gmail.com'
       ];
       \Mail::send('email-template',$mailData,function($message) use ($mailData){
           $message ->to($mailData['recipient'])
                    ->from($mailData['from'],'Tell! Books')
                    ->subject($mailData['subject']);
       });
       return "Email sent successfully";
    }
}
