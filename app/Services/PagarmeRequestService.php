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

    public function createCustomer($name, $email, $external_id, array $phone_numbers, array $documents, $type = 'individual', $country = 'br')
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'external_id' => (string) $external_id,
            'phone_numbers' => $phone_numbers,
            'documents' => $documents,
            'type' => $type,
            'country' => $country
        ];

        return $this->post('customers', $data);
    }

    public function createCreditCard($customer_id, $card_number, $card_expiration_date, $card_holder_name, $card_cvv)
    {
        $data = [
            'customer_id' => $customer_id,
            'card_number' => $card_number,
            'card_expiration_date' => $card_expiration_date,
            'card_expiration_date' => $card_expiration_date,
            'card_holder_name' => $card_holder_name,
            'card_cvv' => $card_cvv
        ];

        return $this->post('cards', $data);
    }

    public function createSubscription(array $customer, $plan_id, $payment_method, $card_id = null)
    {
        $data = [
            'customer' => $customer,
            'plan_id' => $plan_id,
            'payment_method' => $payment_method,
            'card_id' => $card_id
        ];

        return $this->post('subscriptions', $data);
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