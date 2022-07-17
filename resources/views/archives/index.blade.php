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
                            {{-- <div class="col-4 text-right">
                                <a href="" class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#addModal">Add Category</a>
                            </div> --}}
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

                    <div class="table-responsive px-4 mb-3">
                        <table id="dataTable" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col text-center">Barcode</th>
                                    <th scope="col text-center">Kondisi</th>
                                    <th scope="col text-center">Lokasi Rak</th>
                                    <th scope="col text-center">Jenis Berkas</th>
                                    <th scope="col text-center">Nomor SK</th>
                                    <th scope="col text-center">Nama</th>
                                    <th scope="col text-center">Status Pindai</th>
                                    <th scope="col text-center">Status Fisik</th>
                                    <th scope="col text-center">Kelurahan</th>
                                    <th scope="col text-center">Pengarsip</th>
                                    <th scope="col text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($archives as $archive)
                                    <tr>
                                        <td>{{ checkNull($archive->barcode_number) }}</td>
                                        <td>{{ checkNullCategory($archive->condition) }}</td>
                                        <td>{{ checkNull($archive->rack_location) }}</td>
                                        <td>{{ checkNullCategory($archive->type) }}</td>
                                        <td>{{ checkNull($archive->sk_number) }}</td>
                                        <td>{{ checkNull($archive->name) }}</td>
                                        <td>{{ checkNullCategory($archive->scanStatus) }}</td>
                                        <td>{{ checkNullCategory($archive->physicalStatus) }}</td>
                                        <td>{{ checkNull($archive->kelurahan) }}</td>
                                        <td>{{ checkNullCategory($archive->user) }}</td>
                                        <td>
                                            <button type="button" data-toggle="modal" class="btn btn-sm btn-info" data-target="#detailModal" 
                                                data-barcode="{{ checkNull($archive->barcode_number) }}" 
                                                data-rack="{{ checkNull($archive->rack_location) }}" 
                                                data-type="{{ checkNullCategory($archive->type) }}" 
                                                data-sk="{{ checkNull($archive->sk_number) }}" 
                                                data-name="{{ checkNull($archive->name) }}" 
                                                data-address="{{ checkNull($archive->address) }}" 
                                                data-provinsi="{{ checkNull($archive->provinsi) }}" 
                                                data-kab="{{ checkNull($archive->kab_kota) }}" 
                                                data-kecamatan="{{ checkNull($archive->kecamatan) }}" 
                                                data-kelurahan="{{ checkNull($archive->kelurahan) }}" 
                                                data-right="{{ checkNullCategory($archive->rightType) }}" 
                                                data-scan="{{ checkNullCategory($archive->scanStatus) }}" 
                                                data-physical="{{ checkNullCategory($archive->physicalStatus) }}" 
                                                data-condition="{{ checkNullCategory($archive->condition) }}" 
                                                data-description="{{ checkNull($archive->description) }}" 
                                                data-user="{{ checkNullCategory($archive->user) }}" 
                                                data-created="{{ checkNull($archive->created_at->toDateString()) }}">Show Detail
                                            </button>
                                        </td>
                                    </tr>    
                                @endforeach
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

        <!-- Modal -->
        {{-- <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('category.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="h5">Name</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-alternative" id="name" name="name" placeholder="Category Name">
                            </div>
                            @error('name')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
            </div>
        </div> --}}

        <!-- Modal -->
        {{-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered " role="document">
                <div class="modal-content bg-gradient-danger">
                    
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        
                        <div class="py-3 text-center">
                            <i class="ni ni-bell-55 ni-3x"></i>
                            <h4 class="heading mt-4">Delete User?</h4>
                            <p>Are you sure want to delete category? <br> Every deleted category can't be restored!</p>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                        <form method="post" id="form_delete"
                            class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-white">Delete Category</button>
                        </form>
                        <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button> 
                    </div>
                    
                </div>
            </div>
        </div> --}}

        <!-- Modal -->
        {{-- <div class="modal fade" id="changeNameModal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    
                    <form method="post" id="form_update">
                        @method('put')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Name</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="h5">Old Name</label> <br>
                                <span id="old_name" class="badge badge-primary">Admin</span>
                            </div>
    
                            <div class="form-group">
                                <label class="h5">New Name</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-alternative" id="new_name" name="new_name" placeholder="New Category Name">
                                </div>
                                @error('new_name')
                                    <span class="invalid-feedback d-inline" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Change Name</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div> --}}

        @include('layouts.footers.auth')
@endsection

@push('js')
    {{-- @if ($errors->has('name'))
        <script>
            $('#addModal').modal('show');
        </script>
    @endif

    @if ($errors->has('new_name'))
        <script>
            $('#changeNameModal').modal('show');
        </script>
    @endif --}}

    <script type="text/javascript" src="{{ asset('argon/vendor/data-tables/datatables.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable({
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
            modal.find('.modal-body #created').html(button.data('created'))
        })
    </script>
@endpush

