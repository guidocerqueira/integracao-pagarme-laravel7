<?php

namespace App\Services;


class PagarmeRequestService extends BaseRequestService
{
    public function getCustomers()
    {
        return $this->get('customers');
    }

    public function getCustomer($id)
    {
        return $this->get(sprintf('%s/%s', 'customers', $id));
    }

    public function createPlan($amount, $days, $name, $payment_methods = null, $trial_days = null)
    {
        $data = [
            'amount' => $amount,
            'days' => $days,
            'name' => $name,
            'payment_methods' => !is_null($payment_methods) ? $this->getPaymentMethods($payment_methods) : null,
            'trial_days' => $trial_days
        ];

        return $this->post('plans', $data);
    }

    public function editPlan($code, $name, $trial_days = null)
    {
        $data = [
            'name' => $name,
            'trial_days' => $trial_days
        ];

        return $this->put(sprintf('%s/%s', 'plans', $code), $data);
    }

    private function getPaymentMethods($type)
    {
        $method = [
            1 => ['boleto'],
            2 => ['credit_card'],
            3 => ['boleto', 'credit_card']
        ];

        return $method[$type];
    }

    public function getBalance()
    {
        return $this->get('balance');
    }
}