<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\customers;
use App\Models\Item;
use Carbon\Carbon;

class IsCustomerController extends Controller
{
    public function index()
    {
        return view('customer');
    }
}
