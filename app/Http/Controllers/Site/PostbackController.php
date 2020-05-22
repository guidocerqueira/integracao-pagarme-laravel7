<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Subscription;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostbackController extends Controller
{
    public function postback(Request $request)
    {
        DB::table('postbacks')->insert([
            'postback' => json_encode($request->all())
        ]);

        $transaction_code = $request->all()['transaction']['id'];

        $transaction = Transaction::where('transaction_code', $transaction_code)->first();

        if (!is_null($transaction)) {
            $transaction->status = $request->all()['transaction']['status'];
            $transaction->save();
        }

        return;
    }

    public function postbackSubscription(Request $request)
    {
        DB::table('postbacks')->insert([
            'postback' => json_encode($request->all())
        ]);

        $subscription_code = $request->all()['subscription']['id'];

        $subscription = Subscription::where('subscription_code', $subscription_code)->first();

        if (!is_null($subscription)) {
            $subscription->status = $request->all()['subscription']['status'];
            $subscription->save();
        }

        return;
    }
}
