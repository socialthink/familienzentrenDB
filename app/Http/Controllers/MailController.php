<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

            public function sendUpdateEmail()
          {
            $data = [
                'name' => 'John Doe',
            ];

            Mail::send('email.update', $data, function ($message) {
                $message->to('andreas.wyss@socialthink.ch', 'Andreas Wyss')
                        ->subject('Test-E-Mail von Laravel');
            });

            return "E-Mail wurde gesendet!";
          }

}
