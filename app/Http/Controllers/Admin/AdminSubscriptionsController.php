<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;


class AdminSubscriptionsController extends Controller
{
    public function index()
    {
        $subs = Subscription::all();
        return view('admin.subs.index', ['subs'=>$subs]);
    }
    public function create()
    {
        return view('admin.subs.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        if ($validator->fails()) {
            return redirect()->route('subscriptions.create')
                ->withErrors($validator)
                ->withInput();
        }

        Subscription::add($request->get('email'));
        return redirect()->route('subscriptions.index');
    }
    public function destroy(string $id)
    {
        Subscription::find($email)->delete();
        return redirect()->route('admin.subs.index');
    }

}
