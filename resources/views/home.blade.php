@extends('layouts.new')

@section('title')
    {{ __('Dashboard') }}
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Work Orders - For Action</h5>
        <div class="tab-content">
            <div class="table-responsive text-nowrap padding-table">
                <table id="work-order-action-table" class="table table-hover table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>Work Order No.</th>
                        <th>Site</th>
                        <th>Contract</th>
                        <th>Short Description</th>
                        <th>Client</th>
                        <th>Days Open</th>
                        <th>Date Logged</th>
                        <th>Status</th>
                        <th>Created By</th>
                    </tr>
                </thead>
                    <tbody>
                   
                        <tr class="tr-link" data-id="sdfsd">
                            <td>W</td>
                            <td class="text-overflow-ellipsis">f</td>
                            <td class="text-overflow-ellipsis">f</td>
                            <td class="text-overflow-ellipsis">f</td>
                            <td>sdf</td>
                            <td>sf</td>
                            <td>sdf</td>
                            <td>sdf</td>
                            <td>sdff</td>
                        </tr>
                    </tbody>                               
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#work-order-action-table').DataTable({
            // scrollX: true,
        });
        $('#work-order-tracking-table').DataTable({
            // scrollX: true,
        });
    
        $('table tbody').on('click', 'tr', function () {
            // var workOrderId = $(this).parent().data('id');
            var workOrderId = $(this).data('id');
            if(workOrderId) {
                var url = '/work-order/view/' + workOrderId;
                window.location.href = url;
            }
        });

        // $('#data-select').fSelect({placeholder: 'Select Status(s)', showSearch: true});
        // $("#status-check-all-btn").click(function (event) {
        //     event.preventDefault();
        //     $('#data-select').prev(".fs-dropdown").find(".fs-options .fs-option").each(function () {
        //         $(this).click();
        //     });
        //     $('#data-select').closest("div.fs-wrap").addClass("fs-open");
        // });
    });
    
    
    // $("table tbody").on('change', 'tr td.is-deleted-checkbox form input[name=deleted_at]', function () {
        //     var workOrderId = $(this).closest('tr').data('id');
        //     $(".workOrderDeleted-"+workOrderId).submit();
        // }); 
</script>
@endsection
