<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\customers;
use App\Models\Item;
use Carbon\Carbon;

class IsCustomer extends Controller
{


    public function index()
    {
        //in voices due
       $invoice_due = Invoice::where('invoice_type', 'regular')
       ->where('customer_id', auth()->user()->customer->id)
       ->get();


       $invoices =  Invoice::with('customer', 'items', 'customer.user', 'items.unit', 'items.tax')
            ->where('customer_id', auth()->user()->customer->id)
            ->where('invoice_type', 'recurring')
            ->get()
            ->filter(function($q) {
                $intervalDate = Carbon::createFromFormat('Y-m-d H:i:s',  $q->due_date.' 00:00:00')
                    ->addDays($q->interval);
                $diff = $intervalDate->diffInDays(now()) + 1;
                if ($diff > 0 && $diff <= 3) {
                    return $q;
                }
            });
        return view('customer', compact('invoices','invoice_due'));
    }
}
