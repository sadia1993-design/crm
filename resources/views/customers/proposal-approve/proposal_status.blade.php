@extends('layouts.app')
@section('page_title')
    <span>View Proposals Status</span>
@endsection
@section('content')
<div class="z-0">
    <ul class="nav nav-tabs nav-tabs-custom"
        role="tablist">
        <li class="nav-item">
            <a href="#pending"
                class="nav-link active pending"
                data-toggle="tab"
                role="tab"
                aria-controls="tab-21"
                aria-selected="true">
                <span class="nav-link__count">Pending</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#accepted"
                class="nav-link accepted"
                data-toggle="tab"
                role="tab"
                aria-selected="false">
                <span class="nav-link__count">Accepted</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#declined"
                class="nav-link declined"
                data-toggle="tab"
                role="tab"
                aria-selected="false">
                <span class="nav-link__count">Declined</span>
            </a>
        </li>
    </ul>

    <div class="card">
        <div class="card-body tab-content">
            <div class="tab-pane active show fade"
                    id="pending">

            </div>
            <div class="tab-pane fade"
                    id="accepted">

            </div>
            <div class="tab-pane fade"
                    id="declined">

            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
   $(document).ready(function(){
      $('.pending').trigger('click')
    })

        $('.pending').on('click' , function(){
            var pendingBody = $("#pending")
            var url = '{{ route("proposals.pending") }}';
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var content = makeDatatable(response.data, 'pending');
                    pendingBody.empty()
                    pendingBody.append(content)
                    callDatatable('pending');
                }
            })
        });

        $('.accepted').on('click' , function() {
            var approvedBody = $("#accepted")
            var url = '{{ route("proposals.approved") }}';
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var content = makeDatatable(response.data, 'accepted');
                    approvedBody.empty()
                    approvedBody.append(content)
                    callDatatable('accepted');
                }
            })
        });

        $('.declined').on('click' , function() {
            var declinedBody = $("#declined")
            var url = '{{ route("proposals.declined") }}';
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var content = makeDatatable(response.data, 'declined');
                    declinedBody.empty()
                    declinedBody.append(content)
                    callDatatable('declined');
                }
            });
        });

        function callDatatable(table) {
            $('.' + table + '-datatable').DataTable( {
                responsive: true,
                serverSide: false,
            });
        }

        function makeDatatable(data, table) {
            var content = '';
            content += "<table class='table table-bordered table-hover " + table + "-datatable'>" +
                "<thead>" +
                    "<th>##</th>" +
                    "<th>Customer Name:</th>" +
                    "<th>Subject:</th>" +
                    "<th>Date:</th>" +
                    "<th>Due Date:</th>" +
                    "<th>Status:</th>" +
                    "<th>Action:</th>" +
                "</thead>" +
                "<tbody>";

            var statusClass = table == 'pending' ? 'primary' :
                              table == 'accepted' ? 'success' :
                              table == 'declined' ? 'warning' : ''

            $.each(data, function(key, value) {
                content +=  "<tr>" +
                        "<td>" + (++key) + "</td>" +
                        "<td>" + value.customers.user.name + "</td>" +
                        "<td>" + value.subject + "</td>" +
                        "<td>" + value.date + "</td>" +
                        "<td>" + value.due_date + "</td>" +
                        "<td><span class='badge badge-"+statusClass+" text-capitalize text-white'>" + value.status + "</span></td>" +
                        "<td><a href='{{ url("/proposals/") }}/" + value.id + "' class='btn btn-sm btn-primary'>Details</a></td>" +
                    "</tr>";
            });
            content += "</tbody></table>";
            return content;
        }

</script>
@endsection
