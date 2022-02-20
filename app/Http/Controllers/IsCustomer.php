<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\customers;
use App\Models\Item;

class IsCustomer extends Controller
{
    public function index()
    {
//
        $invoices = Invoice::with('customer', 'items', 'customer.user', 'items.unit', 'items.tax')
            ->where('customer_id', auth()->user()->customer->id)
            ->where('invoice_type', 'recurring')
            ->orderBy('invoice_number', 'desc')
            ->get(['invoice_number',  'customer_id', 'item_id',   'invoice_type', 'due_date', 'date', 'interval', 'price', 'qty', 'tax', 'total', 'discount', 'payable', 'status']);

//        if($invoices){
//            foreach ($invoices as $invo_recurring){
////                $invo_date =  date("d", strtotime($invo_recurring->date));
////                $interval= $invo_recurring->interval;
////                return  $invo_recurring->date;
//
//            }
//        }
//
//        if(  $invoices[0]->invoice_type   ==  'recurring'){
//            $invo_date =  date("d", strtotime($invoices[0]->date));
//            $interval = $invoices[0]->interval ;
//            $total = ($invo_date+ $interval) -3;
////            return $total;
//        }
        return view('customer', compact('invoices'));
    }
}
