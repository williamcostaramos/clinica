<?php
namespace App\Repository;

use App\Models\Customer;

interface CustomerRepository{
    public function all($limit);
    public function find($id);
    public function create(Customer $customer);
}
