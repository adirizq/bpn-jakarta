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
                                <h3 class="mb-0">Archive Types</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="" class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#addModal">Add type</a>
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

                    <div class="table-responsive px-4 mb-3">
                        <table id="dataTable" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col text-center">No</th>
                                    <th scope="col text-center">Name</th>
                                    <th scope="col text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $type)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $type->name }}</td>
                                        <td>
                                            <button type="button" data-toggle="modal" class="btn btn-sm btn-warning" data-target="#changeNameModal" data-name="{{ $type->name }}" data-id="{{ $type->id }}">Change Name</button>
                                            <button type="button" data-toggle="modal" class="btn btn-sm btn-danger" data-target="#deleteModal" data-name="{{ $type->name }}" data-id="{{ $type->id }}">Delete</button>
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
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('type.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Type</h5>
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
                                <input type="text" class="form-control form-control-alternative" id="name" name="name" placeholder="Type Name">
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
                        <button type="submit" class="btn btn-primary">Add Type</button>
                    </div>
                </form>
            </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                            <p>Are you sure want to delete this type? <br> Every deleted type can't be restored!</p>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                        <form method="post" id="form_delete"
                            class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-white">Delete Type</button>
                        </form>
                        <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button> 
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="changeNameModal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                                    <input type="text" class="form-control form-control-alternative" id="new_name" name="new_name" placeholder="New Type Name">
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
        </div>

        @include('layouts.footers.auth')
@endsection

@push('js')
    @if ($errors->has('name'))
        <script>
            $('#addModal').modal('show');
        </script>
    @endif

    @if ($errors->has('new_name'))
        <script>
            $('#changeNameModal').modal('show');
        </script>
    @endif

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
        $('#changeNameModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var name = button.data('name') 
            var role = button.data('role')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            var baseUrl = '{{ url('/') }}'

            modal.find('.modal-body #user_id').val(id)
            modal.find('.modal-body #old_name').html(name)
            modal.find('.modal-header .modal-title').html('Change type ' + name + ' name')
            modal.find('.modal-content #form_update').attr('action', baseUrl + '/type/' + id)
        })

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var name = button.data('name') 
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            var baseUrl = '{{ url('/') }}'

            modal.find('.modal-body .heading').html('Delete type ' + name + ' ?')
            modal.find('.modal-footer #form_delete').attr('action', baseUrl + '/type/' + id);
        })
    </script>
@endpush

