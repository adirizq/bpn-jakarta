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
                                <h3 class="mb-0">Archives</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-12"></div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
                            <span class="alert-inner--text">{{ session('success') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="p-4">
                        <div class="table-responsive mb-3">
                            <table id="dataTable" class="table align-items-center table-flush table-wrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col text-center">Action</th>
                                        <th scope="col text-center">Barcode</th>
                                        <th scope="col text-center">Kondisi</th>
                                        <th scope="col text-center">Lokasi Rak</th>
                                        <th scope="col text-center">Jenis Berkas</th>
                                        <th scope="col text-center">Nomor SK</th>
                                        <th scope="col text-center">Nama</th>
                                        <th scope="col text-center">Kelurahan</th>
                                        <th scope="col text-center">Pengarsip</th>
                                        <th scope="col text-center">Pengedit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Archive Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <small class="text-muted">Nomor Barcode</small> <br>
                            <h4 id="barcode">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Kondisi</small> <br>
                            <h4 id="condition">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Lokasi Rak</small> <br>
                            <h4 id="rack">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Jenis Berkas</small> <br>
                            <h4 id="type">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Nomor SK</small> <br>
                            <h4 id="sk">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Nama</small> <br>
                            <h4 id="name">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Alamat</small> <br>
                            <h4 id="address">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Provinsi</small> <br>
                            <h4 id="provinsi">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Kabupaten / Kota</small> <br>
                            <h4 id="kab">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Kecamatan</small> <br>
                            <h4 id="kecamatan">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Kelurahan</small> <br>
                            <h4 id="kelurahan">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Jenis Hak</small> <br>
                            <h4 id="right">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Status Scan Berkas</small> <br>
                            <h4 id="scan">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Status Fisik Berkas</small> <br>
                            <h4 id="physical">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Keterangan</small> <br>
                            <h4 id="description">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Diarsipkan Oleh</small> <br>
                            <h4 id="user">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Diedit Oleh</small> <br>
                            <h4 id="edited">[No Data]</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Diarsipkan Tanggal</small> <br>
                            <h4 id="created">[No Data]</h4>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    @endsection

    @push('js')
        <script type="text/javascript" src="{{ asset('argon/vendor/data-tables/datatables.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    aaSorting: [],
                    ajax: '/json-archives',
                    columns: [{
                            data: 'action',
                            name: 'Action',
                            width: "10%",
                            'searchable': false
                        },
                        {
                            data: 'barcode_number',
                            name: 'barcode_number',
                            defaultContent: "No Data",
                            width: "5%"
                        },
                        {
                            data: 'condition_name',
                            name: 'condition_name',
                            defaultContent: "No Data",
                            width: "10%"
                        },
                        {
                            data: 'rack_location',
                            name: 'rack_location',
                            defaultContent: "No Data",
                            width: "5%"
                        },
                        {
                            data: 'type',
                            name: 'type',
                            defaultContent: "No Data",
                            width: "5%"
                        },
                        {
                            data: 'sk_number',
                            name: 'sk_number',
                            defaultContent: "No Data",
                            width: "20%"
                        },
                        {
                            data: 'name',
                            name: 'name',
                            defaultContent: "No Data",
                            width: "15%"
                        },
                        {
                            data: 'kelurahan',
                            name: 'kelurahan',
                            defaultContent: "No Data",
                            width: "10%"
                        },
                        {
                            data: 'user',
                            name: 'user',
                            defaultContent: "No Data",
                            width: "10%"
                        },
                        {
                            data: 'edited_by',
                            name: 'edited_by',
                            defaultContent: "No Data",
                            width: "10%"
                        },
                    ],
                    language: {
                        paginate: {
                            next: '<i class="fa fa-angle-right"></i>',
                            previous: '<i class="fa fa-angle-left"></i>'
                        }
                    }
                });
            });
        </script>

        <script>
            $('#detailModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var modal = $(this)

                $.ajax({
                    url: "{{ url('') }}" + '/archive/' + button.data('id'),
                    method: 'GET',
                    success: function(response) {
                        var data = JSON.parse(response);
                        modal.find('.modal-body #barcode').html(check(data[0].barcode_number))
                        modal.find('.modal-body #rack').html(check(data[0].rack_location))
                        modal.find('.modal-body #type').html(check(data[0].type.name))
                        modal.find('.modal-body #sk').html(check(data[0].sk_number))
                        modal.find('.modal-body #name').html(check(data[0].name))
                        modal.find('.modal-body #address').html(check(data[0].address))
                        modal.find('.modal-body #provinsi').html(check(data[0].provinsi))
                        modal.find('.modal-body #kab').html(check(data[0].kab_kota))
                        modal.find('.modal-body #kecamatan').html(check(data[0].kecamatan))
                        modal.find('.modal-body #kelurahan').html(check(data[0].kelurahan))
                        modal.find('.modal-body #right').html(check(data[0].right_type.name))
                        modal.find('.modal-body #scan').html(check(data[0].scan_status.name))
                        modal.find('.modal-body #physical').html(check(data[0].physical_status.name))
                        modal.find('.modal-body #condition').html(check(data[0].condition.name))
                        modal.find('.modal-body #description').html(check(data[0].description))
                        modal.find('.modal-body #user').html(check(data[0].user.name))
                        modal.find('.modal-body #edited').html(check(data[0].edited_by.name))
                        modal.find('.modal-body #created').html(check(data[0].created_at.substring(0, 10)))
                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    }
                });
            })

            function check(val) {
                if (val == null) {
                    return '[No Data]';
                } else {
                    return val;
                }
            }
        </script>
    @endpush
