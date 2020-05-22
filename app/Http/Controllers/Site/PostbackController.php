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

            $current_transaction = $request->all()['subscription']['current_transaction'];

            $neWtransaction = Transaction::where('transaction_code', $current_transaction['id'])->first();

            if (is_null($neWtransaction)) {
                $subscription->user->transactions()->create($this->managerTransactionData($current_transaction));
            }
        }

        return;
    }

    private function managerTransactionData($transaction)
    {
        return [
            'transaction_code' => $transaction['id'],
            'status' => $transaction['status'],
            'authorization_code' => $transaction['authorization_code'],
            'amount' => $transaction['amount'],
            'authorized_amount' => $transaction['authorized_amount'],
            'paid_amount' => $transaction['paid_amount'],
            'refunded_amount' => $transaction['refunded_amount'],
            'installments' => $transaction['installments'],
            'cost' => $transaction['cost'],
            'subscription_code' => $transaction['subscription_id'],
            'postback_url' => $transaction['postback_url'],
            'card_holder_name' => $transaction['card_holder_name'],
            'card_last_digits' => $transaction['card_last_digits'],
            'card_first_digits' => $transaction['card_first_digits'],
            'card_brand' => $transaction['card_brand'],
            'payment_method' => $transaction['payment_method'],
            'boleto_url' => $transaction['boleto_url'],
            'boleto_barcode' => $transaction['boleto_barcode'],
            'boleto_expiration_date' => date('Y-m-d H:i:s', strtotime($transaction['boleto_expiration_date']))
        ];
    }
}
