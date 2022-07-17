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
                                <h3 class="mb-0">Users</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="" class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#addUserModal">Add user</a>
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
                                    <th scope="col text-center">Name</th>
                                    <th scope="col text-center">Role</th>
                                    <th scope="col text-center">Email</th>
                                    <th scope="col text-center">Creation Date</th>
                                    <th scope="col text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            @if ($user->id == 1)
                                                <span class="badge badge-danger">Super Admin</span>
                                            @elseif ($user->role == 1)
                                                <span class="badge badge-success">Admin</span>
                                            @else
                                                <span class="badge badge-info">Member</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            @if ($user->id != 1)
                                                <button type="button" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#changePassModal" data-name="{{ $user->name }}" data-id="{{ $user->id }}">Change Password</button>
                                                <button type="button" data-toggle="modal" class="btn btn-sm btn-warning" data-target="#changeRoleModal" data-name="{{ $user->name }}" data-id="{{ $user->id }}" data-role="{{ $user->role }}">Change Role</button>
                                                <button type="button" data-toggle="modal" class="btn btn-sm btn-danger" data-target="#deleteUserModal" data-name="{{ $user->name }}" data-id="{{ $user->id }}">Delete</button>
                                            @endif 
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
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="h5">Name</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-alternative" id="name" name="name" placeholder="name">
                            </div>
                            @error('name')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="h5">Role</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-badge"></i></span>
                                </div>
                                <select class="form-control form-control-alternative mr-2" id="role" name="role">
                                    <option value="0">Member</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            @error('role')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label class="h5">Email</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input type="email" class="form-control form-control-alternative" id="email" name="email" placeholder="name@example.com">
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="h5">Password</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" placeholder="Password" id="password" name="password" type="password">
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="h5">Password Confirmation</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" placeholder="Retype Password" id="password_confirmation" name="password_confirmation" type="password">
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-inline h6" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('user.change_password') }}" method="post">
                    @method('put')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" id="user_id" name="user_id">

                        <div class="form-group">
                            <label class="h5">New Password</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" placeholder="New password" id="new_password" name="new_password" type="password">
                            </div>
                            @error('new_password')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="h5">New Password Confirmation</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" placeholder="Retype new password" id="new_password_confirmation" name="new_password_confirmation" type="password">
                            </div>
                            @error('new_password')
                                <span class="invalid-feedback d-inline h6" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                            <p>Are you sure want to delete user? <br> Every deleted user can't be restored!</p>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                        <form method="post" id="form_delete"
                            class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-white">Delete User</button>
                        </form>
                        <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button> 
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="changeRoleModal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    
                    <form action="{{ route('user.change_role') }}" method="post">
                        @method('put')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
    
                            <input type="hidden" id="user_id" name="user_id">

                            <div class="form-group">
                                <label class="h5">Old Role</label> <br>
                                <span id="old_role" class="badge badge-success">Admin</span>
                            </div>
    
                            <div class="form-group">
                                <label class="h5">New Role</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-badge"></i></span>
                                    </div>
                                    <select class="form-control form-control-alternative" id="new_role" name="new_role">
                                        <option value="0">Member</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                                @error('new_role')
                                    <span class="invalid-feedback d-inline" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Change Role</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
@endsection

@push('js')
    @if ($errors->has('name') or $errors->has('role') or $errors->has('email') or $errors->has('password'))
        <script>
            $('#addUserModal').modal('show');
        </script>
    @endif

    @if ($errors->has('new_password') or $errors->has('old_password'))
        <script>
            $('#changePassModal').modal('show');
        </script>
    @endif

    @if ($errors->has('new_role'))
        <script>
            $('#changeRoleModal').modal('show');
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
        $('#changePassModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var name = button.data('name') 
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-body #user_id').val(id)
            modal.find('.modal-header .modal-title').html('Change User ' + name + ' Password')
        })

        $('#changeRoleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var name = button.data('name') 
            var role = button.data('role')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            var baseUrl = '{{ url('/') }}'
            modal.find('.modal-body #user_id').val(id)
            modal.find('.modal-header .modal-title').html('Change User ' + name + ' Role')

            console.log(role)

            if (role == 0){
                modal.find('.modal-body #old_role').removeClass()
                modal.find('.modal-body #old_role').addClass("badge badge-info")
                modal.find('.modal-body #old_role').html('Member')
            } else if (role == 1) {
                modal.find('.modal-body #old_role').removeClass()
                modal.find('.modal-body #old_role').addClass("badge badge-success")
                modal.find('.modal-body #old_role').html('Admin')
            }
        })

        $('#deleteUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var name = button.data('name') 
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            var baseUrl = '{{ url('/') }}'
            modal.find('.modal-footer #form_delete').attr('action', baseUrl + '/user/' + id);
            modal.find('.modal-body .heading').html('Delete User ' + name + ' ?')
        })
    </script>
@endpush

