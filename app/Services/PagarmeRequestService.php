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
}