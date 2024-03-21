<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $data = Customer::all();
        return response()->json($data);
    }
    public function create(Request $request)
    {
        $rowData = $request->only(["name", "document", "age"]);
        return Customer::create($rowData);
    }
}
