<?php

namespace App\Repository;

use App\Models\Customer;

class CustomerRepositoryImpl implements CustomerRepository
{

    public function all($limit)
    {
        $query = Customer::query();
        if (!isset($limit)) {
            return $query->paginate(10);
        }
        return $query->paginate($limit);
    }

    public function find($id)
    {
        return Customer::find($id);
    }

    public function create(Customer $customer)
    {
        $customer->save();
    }
}
