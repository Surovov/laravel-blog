<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Mail\SubscribeEmail;
use Illuminate\Support\Facades\Mail;


class SubsController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:subscriptions',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $subs = Subscription::add($request->get('email'));
        $subs->generateToken();
        Mail::to($subs)->send(new SubscribeEmail($subs));

        return redirect()->back()->with('status','Добавлено, проверьте почту');

    }
    public function verify($token)
    {
        $subs = Subscription::where('token', $token)->firstOrFail();
        $subs->token = null;
        $subs->save();
        return redirect('/')->with('status', 'Ваша почта подтверждена');
    }
}
