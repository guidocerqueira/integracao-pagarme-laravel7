<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Plan;
use App\Services\PagarmeRequestService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::all();

        return view('admin.plan.index', [
            'plans' => $plans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $rules = [
            'amount' => 'required',
            'days' => 'required',
            'name' => 'required',
            'payment_methods' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['amount'] = preg_replace('/[^0-9]/', '', $data['amount']);

        try {
            DB::beginTransaction();

            $pagarme = new PagarmeRequestService();
            $createPagarmePlan = $pagarme->createPlan($data['amount'], $data['days'], $data['name'], $data['payment_methods'], $data['trial_days']);

            if (isset($createPagarmePlan['errors'])) {
                foreach($createPagarmePlan['errors'] as $error){
                    $validator->errors()->add($error['parameter_name'], $error['message']);
                }

                DB::rollBack();
                return redirect()->back()->withInput()->withErrors($validator);
            }

            $createPlan = Plan::create([
                'name' => $createPagarmePlan['name'],
                'code' => $createPagarmePlan['id'],
                'amount' => $createPagarmePlan['amount'],
                'days' => $createPagarmePlan['days'],
                'trial_days' => $createPagarmePlan['trial_days'],
                'status' => $data['status'],
                'payment_methods' => $data['payment_methods'],
                'benefits' => $data['benefits']
            ]);

            DB::commit();

            return redirect()->route('admin.plan.edit', ['plan' => $createPlan->id])->with([
                'color' => 'success',
                'message' => 'Plano criado com sucesso!'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = Plan::find($id);

        return view('admin.plan.edit', [
            'plan' => $plan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plan = Plan::find($id);

        $data = $request->all();

        $rules = [
            'name' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        try {
            DB::beginTransaction();

            $pagarme = new PagarmeRequestService();
            $editPagarmePlan = $pagarme->editPlan($plan->code, $data['name'], $data['trial_days']);

            if (isset($editPagarmePlan['errors'])) {
                foreach($editPagarmePlan['errors'] as $error){
                    $validator->errors()->add($error['parameter_name'], $error['message']);
                }

                DB::rollBack();
                return redirect()->back()->withInput()->withErrors($validator);
            }

            $plan->name = $editPagarmePlan['name'];
            $plan->trial_days = $editPagarmePlan['trial_days'];
            $plan->status = $data['status'];
            $plan->benefits = $data['benefits'];
            $plan->save();

            DB::commit();

            return redirect()->route('admin.plan.edit', ['plan' => $plan->id])->with([
                'color' => 'success',
                'message' => 'Plano atualizado com sucesso!'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
    }
}
