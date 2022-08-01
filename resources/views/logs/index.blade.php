@extends('layouts.app')

@section('content')
    <div class="header bg-gradient-primary pb-5 pt-5 pt-md-8"> 
        <div class="container-fluid">
            <div class="header-body">
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7 pt-5 pt-md-0">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Logs</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12"></div>

                    <div class="table-responsive px-4 mb-3">
                        <table id="dataTable" class="table align-items-center table-flush table-wrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col text-center">Barcode</th>
                                    <th scope="col text-center">SK Number</th>
                                    <th scope="col text-center">Action</th>
                                    <th scope="col text-center">Detail</th>
                                    <th scope="col text-center">Date</th>
                                    <th scope="col text-center">Actor</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('argon/vendor/data-tables/datatables.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: [],
                ajax: '/json-logs',
                columns: [
                    {
                        data: 'barcode_number', 
                        name: 'barcode_number', 
                        defaultContent: "No Data",
                        width: "10%",
                    },
                    {
                        data: 'sk_number', 
                        name: 'sk_number', 
                        defaultContent: "No Data",
                        width: "15%",
                    },
                    {
                        data: 'action', 
                        name: 'action', 
                        render: function (data, type, row) {
                            var value = ""

                            if (data == 'CREATE'){
                                value = "<span class='badge badge-success'>CREATE</span>"
                            } else if (data == 'UPDATE') {
                                value = "<span class='badge badge-warning'>UPDATE</span>"
                            } else if (data == 'DELETE') {
                                value = "<span class='badge badge-danger'>DELETE</span>"
                            } else {
                                value = data
                            } 

                            return value;
                        },
                        defaultContent: "No Data",
                        width: "5%",
                    },
                    {
                        data: 'detail', 
                        name: 'detail', 
                        defaultContent: "No Data",
                        width: "40%",
                    },
                    {
                        data: 'created_at', 
                        name: 'created_at', 
                        defaultContent: "No Data",
                        width: "15%",
                    },
                    {
                        data: 'actor_name', 
                        name: 'actor_name', 
                        defaultContent: "No Data",
                        width: "15%",
                    },
                ],
                language: {
                    paginate: {
                        next: '<i class="fa fa-angle-right"></i>',
                        previous: '<i class="fa fa-angle-left"></i>'
                    }
                }
            });
        } );
    </script>
@endpush

