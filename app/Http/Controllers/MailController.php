<?php

namespace App\Http\Controllers;

use App\Events\UserRegistrationEvent;
use App\Mail\ExampleMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(User $user)
    {
        event(new UserRegistrationEvent($user));

        return response()->json(['message' => 'Mail sent successfully'], 200);
    }
}
