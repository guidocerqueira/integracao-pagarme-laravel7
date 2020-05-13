<?php

namespace App\Http\Controllers\Site;

use App\Plan;
use App\User;
use Exception;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\PagarmeRequestService;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    public function home()
    {
        $products = Product::paginate(8);

        return view('site.home', [
            'products' => $products
        ]);
    }

    public function plans()
    {
        $plans = Plan::where('status', 1)->orderBy('amount', 'asc')->get();

        return view('site.plan', [
            'plans' => $plans
        ]);
    }

    public function formLogin()
    {
        if (Auth::check()) {
            return redirect()->route('site.account.home');
        }
        
        return view('site.account.login');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];

        $message = [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Esse e-mail já está cadastrado.',
            'password.required' => 'A senha é obrigatória.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        try {
            DB::beginTransaction();

            $userCreate = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            DB::commit();
            return redirect()->route('site.account.login')->with([
                'color' => 'success',
                'message' => 'Cadastro efetuado com sucesso. Faça o Login!'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        if (in_array('', $request->only('email', 'password'))) {
            return redirect()->back()->withInput()->withErrors([
                'message' => 'Oooops, informe todos os dados para efetuar o login!'
            ]);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput()->withErrors([
                'message' => 'Oooops, informe um e-mail válido!'
            ]);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)) {
            return redirect()->back()->withInput()->withErrors([
                'message' => 'Oooops, dados não conferem ou você não tem acesso a essa área!'
            ]);
        }

        return redirect()->route('site.account.home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('site.account.login');
    }

    public function homeAccount()
    {
        if (!is_null($remember = session()->get('remember_url'))) {
            session()->forget('remember_url');
            return redirect($remember);
        }

        return view('site.account.home');
    }

    public function infoAccount()
    {
        return view('site.account.info', [
            'user' => Auth::user()
        ]);
    }

    public function updateInfoAccount(UserRequest $request)
    {
        $user = Auth::user();

        try {
            DB::beginTransaction();

            $user->fill($request->all());
            $user->save();

            DB::commit();
            return redirect()->route('site.account.info')->with([
                'color' => 'success',
                'message' => 'Cadastro atualizado com sucesso!'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function transactionAccount()
    {
        return view('site.account.transaction');
    }

    public function planSubscription($id)
    {
        $plan = Plan::find($id);

        if (is_null($plan)) {
            abort(404, 'Plano não encontrado.');
        }

        return view('site.account.subscription', [
            'plan' => $plan
        ]);
    }

    public function planSubscriptionStore(Request $request, $id)
    {
        $plan = Plan::find($id);

        if (is_null($plan)) {
            abort(404, 'Plano não encontrado.');
        }

        $data = $request->all();

        $rules = [
            'card_number' => 'required_without:card_id',
            'card_holder_name' => 'required_without:card_id',
            'month' => 'required_without:card_id|max:2',
            'year' => 'required_without:card_id|max:2',
            'card_cvv' => 'required_without:card_id',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = Auth::user();

        $pagarme = new PagarmeRequestService();

        

        try {
            DB::beginTransaction();

            if (!is_null($user->pagarme_id)) {
                $customer = $pagarme->getCustomer($user->pagarme_id);
            }else{
                $phone_numbers = [sprintf('%s%s', '+55', $user->cell)];
                $documents = [
                    [
                        'type' => 'cpf',
                        'number' => $user->cpf
                    ]
                ];
    
                $customer = $pagarme->createCustomer($user->name, $user->email, $user->id, $phone_numbers, $documents);
            }
    
            if (isset($customer['errors'])) {
                $errors = collect($customer['errors'])->pluck('message');
                return redirect()->back()->withInput()->withErrors($errors);
            }
    
            if (!empty($data['card_id'])) {
                $card_id = $data['card_id'];
            }else{
                $card_expiration_date = sprintf('%s%s', $data['month'], $data['year']);
                $card = $pagarme->createCreditCard($customer['id'], $data['card_number'], $card_expiration_date, $data['card_holder_name'], $data['card_cvv']);
                
                if (isset($card['errors'])) {
                    $errors = collect($card['errors'])->pluck('message');
                    return redirect()->back()->withInput()->withErrors($errors);
                }

                $user->usercards()->create([
                    'card_id' => $card['id'],
                    'brand' => $card['brand'],
                    'last_digits' => $card['last_digits'],
                    'holder_name' => $card['holder_name']
                ]);
    
                $card_id = $card['id'];
            }
    
            $subscription = $pagarme->createSubscription($customer, $plan->code, 'credit_card', $card_id);
    
            if (isset($subscription['errors'])) {
                $errors = collect($subscription['errors'])->pluck('message');
                return redirect()->back()->withInput()->withErrors($errors);
            }

            $user->subscriptions()->create([
                'subscription_code' => $subscription['id'],
                'plan_id' => $plan->id,
                'status' => $subscription['status']
            ]);

            if (isset($subscription['current_transaction']['id'])) {
                $user->transactions()->create([
                    'transaction_code' => $subscription['current_transaction']['transaction_code'],
                    'status' => $subscription['current_transaction']['status'],
                    'authorization_code' => $subscription['current_transaction']['authorization_code'],
                    'amount' => $subscription['current_transaction']['amount'],
                    'authorized_amount' => $subscription['current_transaction']['authorized_amount'],
                    'paid_amount' => $subscription['current_transaction']['paid_amount'],
                    'refunded_amount' => $subscription['current_transaction']['refunded_amount'],
                    'installments' => $subscription['current_transaction']['installments'],
                    'cost' => $subscription['current_transaction']['cost'],
                    'subscription_code' => $subscription['current_transaction']['subscription_code'],
                    'postback_url' => $subscription['current_transaction']['postback_url'],
                    'card_holder_name' => $subscription['current_transaction']['card_holder_name'],
                    'card_last_digits' => $subscription['current_transaction']['card_last_digits'],
                    'card_first_digits' => $subscription['current_transaction']['card_first_digits'],
                    'card_brand' => $subscription['current_transaction']['card_brand'],
                    'payment_method' => $subscription['current_transaction']['payment_method'],
                    'boleto_url' => $subscription['current_transaction']['boleto_url'],
                    'boleto_barcode' => $subscription['current_transaction']['boleto_barcode'],
                    'boleto_expiration_date' => $subscription['current_transaction']['boleto_expiration_date']
                ]);
            }

            DB::commit();
            return redirect()->route('site.account.home')->with([
                'color' => 'success',
                'message' => 'Plano contratado com sucesso'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
    }
}
