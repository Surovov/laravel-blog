<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscribeEmail;
use App\Models\Subscription;

class TestMailController extends Controller
{
    public function sendTestMail()
    {
        $subscriber = new Subscription();
        $subscriber->email = 'test@example.com';
        $subscriber->token = 'testtoken123';

        Mail::to('test@example.com')->send(new SubscribeEmail($subscriber));

        return 'Test email sent!';
    }
}
