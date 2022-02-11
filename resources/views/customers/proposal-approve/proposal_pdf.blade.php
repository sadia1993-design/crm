<table border="1" align="left" width="100%">
   <tr>
       <td valign="top">

            Customer Name: {{ $proposal->customers->user->name }} <br>
            Proposal Topic: {{ $proposal->subject }} <br>
            Date: {{ $proposal->date }} <br>
            Due Date: {{ $proposal->due_date }} <br>
            Status: {{$proposal->status}}

        </td>
        <td valign="top">
            <strong>Proposal Information </strong><br>
            Company Name: {{$proposal->customers->company_name}}<br>
            Address: {{$proposal->customers->address}} <br>
            Phone: {{$proposal->customers->phone}} <br>
            City: {{$proposal->customers->city ? $proposal->customers->city : 'NA'}} <br>
            Country: {{$proposal->customers->country ? $proposal->customers->country: 'NA'}} <br>
            Zip: {{$proposal->customers->zip ? $proposal->customers->zip : 'NA'}} <br>
            Vat Number: {{$proposal->customers->vat_number ?$proposal->customers->vat_number : 'Not Applicable'}}
        </td>
   </tr>
</table>

<br>



<table border="1" width="100%" align="center" cellspacing="0" cellpadding="0">
   <thead style="background: blue">
        <tr>
            <th >#</th>
            <th >Item Name</th>
            <th >Unit</th>
            <th >Tax</th>
            <th >Quantity</th>
            <th >Price</th>
            <th >Total Amount</th>
        </tr>
    </thead>
     <tbody>

                        @php
                            $sum = 0;
                            $tax = 0;
                            $totalSum = 0;
                        @endphp
                        @forelse ($proposal->proposalItem as $proposalItem)

                            @php
                                $sum += $proposalItem->quantity * $proposalItem->price;
                            @endphp

                            @php $taxFix = $proposalItem->item->tax->rule ?? 0 ;  @endphp


                           @php
                           $totalSum += ($proposalItem->price*$proposalItem->quantity) + (($proposalItem->price*$proposalItem->quantity)*$taxFix/100);
                           $tax += ($proposalItem->price*$proposalItem->quantity)*$taxFix/100;
                           @endphp


                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $proposalItem->item->name }}</td>
                                <td>{{ $proposalItem->item->unit->name }}</td>
                                <td>
                                    {{ $proposalItem->item->tax->rule ?? '0'}}
                                </td>
                                <td>{{$proposalItem->quantity}}</td>
                                <td>{{$proposalItem->price}}</td>
                                <td>{{$proposalItem->price*$proposalItem->quantity}}</td>
                            </tr>
                        @empty
                        @endforelse

                        <tr>
                            <td colspan="6" style="text-align: right;"><strong>Sub Total</strong></td>
                            <td><strong>{{$sum}}</strong></td>
                        </tr>

                        <tr>
                            <td colspan="6" style="text-align: right;"><strong>Tax</strong></td>
                            <td><strong>{{ $tax}}</strong></td>
                        </tr>

                        <tr>
                            <td colspan="6" style="text-align: right;"><strong>Total</strong></td>
                            <td><strong>{{$totalSum}}</strong></td>
                        </tr>

                    </tbody>
</table>

<br>

<table>
    <tr>
        <th>
            <strong>Signeture</strong>
            <hr>
        </th>
    </tr>
    <tr>
        <td>
            <p>
                @if ($proposal->signText)
                    <img src="{{ $proposal->signText }}" alt="sign" width="200px" height="100px">
                @endif


            </p>
        </td>
    </tr>
</table>
