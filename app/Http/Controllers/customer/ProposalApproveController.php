<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\customers;
use App\Models\Proposal;
use App\Models\ProposalItem;



class ProposalApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $proposals = Proposal::with('customers',  'customers.user')
            ->where('customer_id', auth()->user()->customer->id)
            ->get();

        // dd($proposals);
        return view('customers.proposal-approve.proposal_approve', compact('proposals'));
    }

    public function status()
    {
        return view('customers.proposal-approve.proposal_status');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approved()
    {
        $proposals = Proposal::with('customers',  'customers.user')
            ->where('customer_id', auth()->user()->customer->id)
            ->where('status', 'accepted')
            ->get();
        return response()->json(['status' => 'success', 'data' => $proposals], 200);
    }

    public function pending()
    {
        $pending = Proposal::with('customers',  'customers.user')
            ->where('customer_id', auth()->user()->customer->id)
            ->where('status', 'sent')
            ->get();

        return response()->json(['status' => 'success', 'data' => $pending], 200);
    }

    public function declined()
    {
        $pending = Proposal::with('customers',  'customers.user')
            ->where('customer_id', auth()->user()->customer->id)
            ->where('status', 'rejected')
            ->get();

           

        return response()->json(['status' => 'success', 'data' => $pending], 200);
    }

    public function store(Request $request)
    {

        try {
            if ($request->length <= 1858) {
                throw new \Exception('Please enter your signature');
            }
            $proposal = Proposal::find($request->id);
            if ($proposal) {
                $proposal->update([
                    'status' => 'accepted',
                    'signText' => $request->sign_text,
                ]);
                return response()->json(['status' => 'success', 'message' => 'Accepted Successfully !']);
            }
            return response()->json(['status' => 'error', 'message' =>  'Accept Failed !']);
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json(['status' => 'error', 'message' =>  'Accept Failed !']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proposal = Proposal::with('proposalItem', 'proposalItem.item', 'customers', 'customers.user', 'proposalItem.item.unit', 'proposalItem.item.tax')
            ->where('id', $id)
            ->first();

        //  dd($proposalItem->toArray());

        return view('customers.proposal-approve.proposal_approve_single', compact('proposal'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $proposal = Proposal::find($id);
            if ($proposal) {
                $proposal->update([
                    'status' => 'rejected',
                ]);
                return response()->json(['status' => 'success', 'message' => 'Rejected Successfully !']);
            }
            return response()->json(['status' => 'error', 'message' =>  'Reject Failed !']);
        } catch (\Exception $e) {

            return $e;
            return response()->json(['status' => 'error', 'message' =>  'Reject Failed !']);
        }
    }

    public function printToPdf($id)
    {

        $proposal = Proposal::with('proposalItem', 'proposalItem.item', 'customers', 'customers.user', 'proposalItem.item.unit', 'proposalItem.item.tax')
            ->where('id', $id)
            ->first();


        $pdf = \PDF::loadView('customers.proposal-approve.proposal_pdf', compact('proposal'));
        return $pdf->download();
    }
}
