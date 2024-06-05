<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerCreateRequest;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Repository\CustomerRepository;
use App\Services\CustomerCreatedService;

class CustomerController extends Controller
{
    private $customerCreatedService;
    private $repository;
    public function __construct(CustomerCreatedService $customerCreatedService, CustomerRepository $repository)
    {
        $this->customerCreatedService = $customerCreatedService;
        $this->repository = $repository;
    }

    public function index()
    {
        $customers = $this->repository->all(10);
        return response()->json($customers, 200);
    }

    public function create(CustomerCreateRequest $request)
    {
        $customer = $this->customerCreatedService->create($request);
        return response()->json($customer, 201);
    }
}
