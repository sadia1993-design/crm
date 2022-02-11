<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Generation</title>
</head>
<body>
     <h1>Inv-{{$details[0]->invoice_number}} Generated Successfully!!!</h1>
     <div class="container-fluid wrapper">
         <div class="card">
             <div class="card-body">
                 @if (count($details) > 0)
                     @php
                         $customer = $details[0]->customer;
                     @endphp
                     <div class="addr-wrap d-flex justify-content-between">
                         <div class="addr">
                             <h3><strong>Street Address:</strong></h3>
                             <p>
                                 {{$customer->address}}  <br>
                                 {{$customer->phone}}
                             </p>
                         </div>
                         <div class="invId">
                             <table border="1" class="table">
                                 <tr>
                                     <td><strong>Invoice No</strong></td>
                                     <td>{{$details[0]->invoice_number}}</td>
                                 </tr>
                                 <tr>
                                     <td>Date</td>
                                     <td>{{$details[0]->date}}</td>
                                 </tr>
                                 <tr>
                                     <td>Type</td>
                                     <td>{{$details[0]->invoice_type}}</td>
                                 </tr>
                             </table>
                         </div>
                     </div>

                     <!--Bill to-->
                     <table border="1" class="table">
                         <tr>
                             <td><strong>Bill To:</strong></td>
                         </tr>
                         <tr>
                             <td>
                                 <span><strong>Name: </strong>  {{$customer->user->name}}</span> <br>
                                 <span><strong>Address: </strong> {{$customer->address}}</span> <br>
                                 <span><strong>Email: </strong> {{$customer->user->email}}</span> <br>
                                 <span><strong>Phone: </strong> {{$customer->phone}}</span> <br>
                             </td>
                         </tr>
                     </table>

                     <!--Product Details -->
                     <div class="items-info">
                         <h4><strong>Product Details:</strong></h4>
                         <table border="1" class="table">
                             <tr>
                                 <td><strong>SL</strong></td>
                                 <td><strong>Product Name</strong></td>
                                 <td><strong>Unit</strong></td>
                                 <td><strong>Price</strong></td>
                                 <td><strong>Quantity</strong></td>
                                 <td><strong>Tax</strong></td>
                                 <td><strong>Discount</strong></td>
                                 <td><strong>Total</strong></td>
                             </tr>

                             @php
                                 $subTotal = 0;
                                 $tax=0;
                                 $discount=0;
                             @endphp

                             @forelse($details as $value)

                                 @php
                                     $subTotal += $value->total;
                                     $tax += $value->tax;
                                     $discount += $value->discount;


                                 @endphp

                                 <tr>
                                     <td>{{$loop->iteration}}</td>
                                     <td>{{$value->items->name}}</td>
                                     <td>{{$value->items->unit->name}}</td>
                                     <td>{{$value->items->rate}}/-</td>
                                     <td>{{$value->qty}}</td>
                                     <td>{{$value->tax}}</td>
                                     <td>{{$value->discount}}/-</td>
                                     <td>{{$value->total}}</td>
                                 </tr>
                             @empty
                             @endforelse
                             <tr>
                                 <td colspan="6"></td>
                                 <td><strong>SubTotal</strong></td>
                                 <td><strong>{{$subTotal}}/-</strong></td>
                             </tr>
                             <tr>
                                 <td colspan="6"></td>
                                 <td><strong>Tax</strong></td>
                                 <td><strong>{{$tax}}/-</strong></td>
                             </tr>
                             <tr>
                                 <td colspan="6"></td>
                                 <td><strong>Discount</strong></td>
                                 <td><strong>{{$discount}}/-</strong></td>
                             </tr>
                             <tr>
                                 <td colspan="6"></td>
                                 <td><strong>GrandTotal</strong></td>
                                 <td><strong>{{$value->payable}}/-</strong></td>
                             </tr>

                         </table>
                     </div>
                 @else
                     <p> No Data Found ! </p>
                 @endif



             </div>
         </div>
     </div>




</body>
</html>
