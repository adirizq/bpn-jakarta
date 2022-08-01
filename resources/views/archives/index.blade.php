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

                    <div class="table-responsive px-4 mb-3 mt-5">
                        <table id="dataTable" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col text-center">Barcode</th>
                                    <th scope="col text-center">Kondisi</th>
                                    <th scope="col text-center">Jenis Berkas</th>
                                    <th scope="col text-center">Nomor SK</th>
                                    <th scope="col text-center">Nama</th>
                                    <th scope="col text-center">Kelurahan</th>
                                    <th scope="col text-center">Pengarsip</th>
                                    <th scope="col text-center">Pengedit</th>
                                    <th scope="col text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- Modal -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                            <h4 id="barcode">...</h4>
                        </div>
                        
                        <div class="form-group mb-3">
                            <small class="text-muted">Kondisi</small> <br>
                            <h4 id="condition">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Lokasi Rak</small> <br>
                            <h4 id="rack">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Jenis Berkas</small> <br>
                            <h4 id="type">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Nomor SK</small> <br>
                            <h4 id="sk">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Nama</small> <br>
                            <h4 id="name">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Alamat</small> <br>
                            <h4 id="address">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Provinsi</small> <br>
                            <h4 id="provinsi">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Kabupaten / Kota</small> <br>
                            <h4 id="kab">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Kecamatan</small> <br>
                            <h4 id="kecamatan">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Kelurahan</small> <br>
                            <h4 id="kelurahan">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Jenis Hak</small> <br>
                            <h4 id="right">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Status Scan Berkas</small> <br>
                            <h4 id="scan">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Status Fisik Berkas</small> <br>
                            <h4 id="physical">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Keterangan</small> <br>
                            <h4 id="description">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Diarsipkan Oleh</small> <br>
                            <h4 id="user">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Diedit Oleh</small> <br>
                            <h4 id="edited">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Diarsipkan Tanggal</small> <br>
                            <h4 id="created">...</h4>
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
        $(document).ready( function () {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: [],
                ajax: '/json-archives',
                columns: [
                    {data: 'barcode_number', name: 'barcode_number', defaultContent: "[No Data]"},
                    {data: 'condition.name', name: 'condition.name', defaultContent: "[No Data]"},
                    {data: 'type.name', name: 'type.name', defaultContent: "[No Data]"},
                    {data: 'sk_number', name: 'sk_number', defaultContent: "[No Data]"},
                    {data: 'name', name: 'name', defaultContent: "[No Data]"},
                    {data: 'kelurahan', name: 'kelurahan', defaultContent: "[No Data]"},
                    {data: 'user.name', name: 'user.name', defaultContent: "[No Data]"},
                    {data: 'edited_by.name', name: 'edited_by.name', defaultContent: "[No Data]"},
                    {data: 'action', name: 'Action', 'searchable': false}
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

    <script>
        // $('#changeNameModal').on('show.bs.modal', function (event) {
        //     var button = $(event.relatedTarget) // Button that triggered the modal
        //     var id = button.data('id') // Extract info from data-* attributes
        //     var name = button.data('name') 
        //     var role = button.data('role')
        //     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        //     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        //     var modal = $(this)
        //     var baseUrl = '{{ url('/') }}'

        //     modal.find('.modal-body #user_id').val(id)
        //     modal.find('.modal-body #old_name').html(name)
        //     modal.find('.modal-header .modal-title').html('Change Category ' + name + ' Name')
        //     modal.find('.modal-content #form_update').attr('action', baseUrl + '/category/' + id)
        // })

        // $('#deleteModal').on('show.bs.modal', function (event) {
        //     var button = $(event.relatedTarget) // Button that triggered the modal
        //     var id = button.data('id') // Extract info from data-* attributes
        //     var name = button.data('name') 
        //     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        //     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        //     var modal = $(this)
        //     var baseUrl = '{{ url('/') }}'

        //     modal.find('.modal-body .heading').html('Delete Category ' + name + ' ?')
        //     modal.find('.modal-footer #form_delete').attr('action', baseUrl + '/category/' + id);
        // })

        $('#detailModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var modal = $(this)

            modal.find('.modal-body #barcode').html(button.data('barcode'))
            modal.find('.modal-body #rack').html(button.data('rack'))
            modal.find('.modal-body #type').html(button.data('type'))
            modal.find('.modal-body #sk').html(button.data('sk'))
            modal.find('.modal-body #name').html(button.data('name'))
            modal.find('.modal-body #address').html(button.data('address'))
            modal.find('.modal-body #provinsi').html(button.data('provinsi'))
            modal.find('.modal-body #kab').html(button.data('kab'))
            modal.find('.modal-body #kecamatan').html(button.data('kecamatan'))
            modal.find('.modal-body #kelurahan').html(button.data('kelurahan'))
            modal.find('.modal-body #right').html(button.data('right'))
            modal.find('.modal-body #scan').html(button.data('scan'))
            modal.find('.modal-body #physical').html(button.data('physical'))
            modal.find('.modal-body #condition').html(button.data('condition'))
            modal.find('.modal-body #description').html(button.data('description'))
            modal.find('.modal-body #user').html(button.data('user'))
            modal.find('.modal-body #edited').html(button.data('edited'))
            modal.find('.modal-body #created').html(button.data('created'))
        })
    </script>
@endpush

