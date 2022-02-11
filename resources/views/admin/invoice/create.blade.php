@extends('layouts.app')
@section('page_title')
<nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Invoice</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between">
      <h1 class="m-0"><span>Add Invoice</span></h1>
      <a href="{{route('invoice.index')}}" class="btn btn-md btn-blue">Back to Invoice List</a>
    </div>
@endsection

@section('content')
<div class="container-fluid wrapper">

    @if (session('success'))
        <div class="alert alert-success  alert-dismissible  fade show" role="alert">
            <span style="color: darkblue"> {{ session('success') }} </span>
            <button type="button"  class="close" data-dismiss="alert" aria-label="Close">
                <span style="color: red" aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif
           <form action="{{route('invoice.store')}}" method="post">
                @csrf


                <div class="card">
                    <div class="card-body">
                        <div class="form-row flex-nowrap">
                            <div class="form-group col-md-6">
                                    <label for="customer_name">Select Customer</label><br>
                                    <select id="customer_name" class="custom-select" name="customer_id">
                                        <option value="">Select Customer</option>
                                        @forelse ($all_customers as $all)
                                        <option value="{{$all->id}}">{{$all->user->name}}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                @if($errors->has('customer_id'))
                                    <div style="color:red;font-weight: bold">{{ $errors->first('customer_id') }}</div>
                                @endif
                                </div>

                                .<div class="form-group col-md-6">
                                    <label for="invoice_no">Invoice Number</label><br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text">INV-</span>
                                        </div>
                                        <input type="text" class="form-control" name="invoice_no" readonly value="{{$newId}}">
                                    </div>
                                </div>

                        </div>



                        <div class="form-row">
                            <div class="form-group col-md-6">
                                    <label for="invoice_date">Invoice Date</label>
                                    <input type="date" class="form-control" id="invoice_date" name="invoice_date"  value="{{ now()->format('Y-m-d')}}">
                            </div>
                            <div class="form-group col-md-6">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $due_date  }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="invoice_type">Invoice Type</label><br>
                                <select id="invoice_type" class="custom-select invoice-type" name="invoice_type" >
                                    <option value="">Select Invoice Type</option>
                                    <option value="regular">Regular</option>
                                    <option value="recurring">Recurring</option>
                                </select>
                                @if($errors->has('invoice_type'))
                                    <div style="color:red;font-weight: bold">{{ $errors->first('invoice_type') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 recurring-block" style="display: none;">
                                <label for="recurring " ></label><br>
                                <input type="text" name="recurring" id="recurring" class="form-control recurring " style="margin-top: 7px" placeholder="type(in days)">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="country">Select Item</label><br>
                                <select class="custom-select get-item" id="invoice_item"  name="invoice_item">
                                    <option value="">Select Item</option>
                                    @foreach ($Item as $items)
                                       <option value="{{$items}}">{{$items->name}}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="table-responsive">
                                    <table class="table"  id="invoice-table" style="width:100%">
                                        <thead class=" bg-blue">
                                            <tr >
                                                <th class="text-white">Item Name</th>
                                                <th class="text-white">Quantity</th>
                                                <th class="text-white">Price</th>
                                                <th class="text-white">Tax</th>
                                                <th class="text-white">Amount</th>
                                                <th class="text-white">DisCount</th>
                                                <th class="text-white">Total</th>
                                                <th class="text-white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="invoice-item-tbody py-2">


                                            <tr class="text-right">
                                                <td colspan="6" >SubTotal</td>
                                                <td><input type="text" readonly class="form-control subTotal" value="0"></td>
                                            </tr>
                                            <tr class="text-right">
                                                <td colspan="6" >Total Discount</td>
                                                <td><input type="text" readonly class="form-control total-discount"value="0"></td>
                                            </tr>
                                            <tr class="text-right">
                                                <td  colspan="6" >GrandTotal</td>
                                                <td><input type="text" readonly class="form-control Total" name="grandTotal" value="0"></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-block btn-primary" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
           </form>

</div>

<script>

    $(document).ready( function() {


        $('.invoice-type').on('change', function() {
            var selected = $(this).val();
            if(selected == 'recurring') {
                $('.recurring-block').show();
                $('.recurring').val('').attr('disabled', false);
            } else {
                $('.recurring-block').hide();
                $('.recurring').val('').attr('disabled', true);
            }
        });

        var items = [];

        $('.get-item').on('change', function() {

            var data = JSON.parse($(this).val());
            var duplicate = false;
            if (items.length > 0) {
                items.forEach(function(value) {
                    if (value == data.id) {
                        $("#quantity-" + value).val(parseFloat($("#quantity-" + data.id).val()) + 1);
                        $("#quantity-" + value).trigger('keyup');
                        duplicate = true
                    } else {
                        items.push(data.id);
                    }
                });
            } else {
                //if items array is empty
                items.push(data.id);
            }
            // make items array unique
            items = items.filter((element, index) => {
                return items.indexOf(element) === index;
            });

            if (!duplicate) {
                if(data.tax.rule) {
                    var tax = data.tax.rule;
                } else {
                    tax = 0;
                }

                // console.log(items)
                var html =  '<tr>' +
                    '<td style="padding-left:0 !important" class="col-md-1">' +
                       '<input type="text" readonly class="form-control" name="item_name[]"   value="'  + data.name + '">' +
                       '<input type="hidden"  name="item_id[]"   value="'  + data.id + '">' +
                    '</td>' +
                    '<td style="padding-left:0 !important" class="col-md-1">' +
                       '<input type="number" id="quantity-'+data.id+'" class="form-control qty-custom" name="qty[]"  value="1">' +
                    '</td>' +
                    '<td style="padding-left:0 !important" class="col-md-2">' +
                        '<div class="input-group">' +
                           '<div class="input-group-prepend">' +
                              '<span class="input-group-text">TK-</span>' +
                           '</div>' +
                           '<input type="number"  class="form-control price-custom"  name="rate[]"  value="' +data.rate+ '">' +
                        '</div>'+
                    '</td>' +
                    '<td style="padding-left:0 !important" class="col-md-1">' +
                       '<input type="number"   class="form-control tax-custom" name="tax[]"   value="' + tax+ '">' +
                    '</td>' +
                    '<td style="padding-left:0 !important" class="col-md-2">' +
                        '<div class="input-group">' +
                            '<div class="input-group-prepend">' +
                                '<span class="input-group-text">Amount</span>' +
                             '</div>' +
                             '<input type="text" readonly class="form-control total-custom "   value="0">' +
                        '</div>'+
                    '</td>' +
                    '<td style="padding-left:0 !important" class="col-md-2">' +
                       '<input type="number"  class="form-control discount" name="discount[]"  value="0">' +
                    '</td>' +
                    '<td style="padding-left:0 !important" class="col-md-2">' +
                        '<div class="input-group">' +
                           '<div class="input-group-prepend">' +
                               '<span class="input-group-text">Total</span>' +
                           '</div>' +
                           '<input type="text" readonly class="form-control total-custom net-amount" name="amount[]"  value="0">' +
                      '</div>'+
                    '</td>' +
                    '<td style="padding-left:0 !important" class="col-md-1">' +
                        '<button type="button" class="btn btn-danger btn-md remove-item" id="close-tr"><i class="fa fa-window-close"></i></button>' +
                    '</td>' +
                    '</tr>' ;

                $('.invoice-item-tbody ').prepend(html);
                $("#quantity-" + data.id).trigger('keyup');
                updateSubTotal();
                updateGrandTotal();
                updateDisTotal();
            }
        });

        //remove selected item
        $(document).on('click', '#close-tr', function() {
            $(this).closest('tr').remove();
            updateSubTotal();
            updateGrandTotal();
            updateDisTotal();
        });

        //calculation
        $(document).on('keyup change', '.qty-custom', function() {

            var thisAttr = $(this);
            if (parseFloat(thisAttr.val()) < 0 ) {
                thisAttr.val(0)
            }

            var qty = $(this).val();
            var rate = $(this).closest('tr').find('.price-custom').val();
            var tax = $(this).closest('tr').find('.tax-custom').val();
            var total = qty * rate;
            var tax_amount = total * tax / 100;
            var total_amount = total + tax_amount;
            $(this).closest('tr').find('.total-custom').val(total_amount);

            updateSubTotal();
            updateGrandTotal();
            updateDisTotal();

        });

        $(document).on('keyup change', '.price-custom', function() {

            var thisAttr = $(this);
            if (parseFloat(thisAttr.val()) < 0 ) {
                thisAttr.val(0)
            }

            var rate = $(this).val();
            var qty = $(this).closest('tr').find('.qty-custom').val();
            var tax = $(this).closest('tr').find('.tax-custom').val();
            var total = qty * rate;
            var tax_amount = total * tax / 100;
            var total_amount = total + tax_amount;
            $(this).closest('tr').find('.total-custom').val(total_amount);

            updateSubTotal();
            updateGrandTotal();
            updateDisTotal();
        });

        $(document).on('keyup change', '.tax-custom', function() {
            var thisAttr = $(this);
            if (parseFloat(thisAttr.val()) < 0 ) {
                thisAttr.val(0)
            }


            var tax = $(this).val();
            var qty = $(this).closest('tr').find('.qty-custom').val();
            var rate = $(this).closest('tr').find('.price-custom').val();
            var total = qty * rate;
            var tax_amount = total * tax / 100;
            var total_amount = total + tax_amount;
            $(this).closest('tr').find('.total-custom').val(total_amount);

            updateSubTotal();
            updateGrandTotal();
            updateDisTotal();
        });

        $(document).on('keyup change', '.discount', function () {

            var thisAttr = $(this);

            if (parseFloat(thisAttr.val()) < 0 || thisAttr.val() == '') {
                thisAttr.val(0)
            }
            var discount = $(this).val();
            var qty = $(this).closest('tr').find('.qty-custom').val();
            var rate = $(this).closest('tr').find('.price-custom').val();
            var tax = $(this).closest('tr').find('.tax-custom').val();
            var total = qty * rate;
            var tax_amount = total * tax / 100;
            var total_amount = total + tax_amount;
            var decimal = total_amount * (discount/100);
            var grandTotal = parseFloat(total_amount) - parseFloat(decimal);
            $(this).closest('tr').find('.net-amount').val(grandTotal);

            updateSubTotal();
            updateGrandTotal();
            updateDisTotal();
        })
    });

    function updateSubTotal() {
        var amount = 0.00
        $('.net-amount').each(function() {
            var currentElement = $(this);
            var value = parseFloat(currentElement.val());
            amount += value
        });

        $(".subTotal").val(amount)
    }

    function  updateDisTotal(){
        var amount = 0.00;
        $('.discount').each( function () {

            var currentElement = $(this);
            var value = parseFloat(currentElement.val());
            amount += value;
        });
        $(".total-discount").val(amount)

    }

    function updateGrandTotal(){
        var subTotal = $('.subTotal').val();
        $('.Total').val(subTotal);

    }

</script>

@endsection
