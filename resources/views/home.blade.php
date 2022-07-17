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
                        <div class="row align-items-center justify-content-center">
                            <h3 class="mb-0">Archives</h3>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
                            <span class="alert-inner--text">{{ session('success') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>  
                    @endif
                    
                    <div class="col-12"></div>

                    @foreach ($archives as $archive)
                    <div class="card mb-3 mx-3 shadow" type="button" data-toggle="modal" class="btn btn-sm btn-info" data-target="#detailModal"
                            data-id="{{ $archive->id }}"
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
                            data-created="{{ checkNull($archive->created_at->toDateString()) }}">
                        <div class="card-body">
                            <div class="text-primary active font-weight-bold" style="font-size: 12px">{{ checkNull($archive->barcode_number) }}</div>
                            <div style="font-size: 16px; color:black">{{ checkNull($archive->sk_number) }}</div>
                            <div>
                                <span class="badge badge-primary">{{ checkNullCategory($archive->type) }}</span>
                                <span class="badge badge-primary">{{ checkNullCategory($archive->condition) }}</span>
                            </div>
                            <div class="text-default d-flex align-items-center mt-2" style="font-size: 12px; white-space: nowrap; overflow: hidden value=""; text-overflow: ellipsis;">
                                <i class="ni ni-pin-3"></i> &nbsp; {{ checkNull($archive->kelurahan) }} &nbsp;&nbsp;
                                <i class="ni ni-calendar-grid-58"></i> &nbsp; {{ checkNull($archive->created_at->toDateString()) }} &nbsp;&nbsp;
                                <i class="ni ni-single-02"></i> &nbsp; {{ checkNull($archive->name) }}
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="d-flex justify-content-center my-3">
                        {{ $archives->links('vendor.pagination.default') }}
                    </div>

                    <button class="btn btn-primary mx-3 mb-3" type="button" data-toggle="modal" data-target="#addModal">Add Archive</button>

                </div>
            </div>
        </div>
    </div>
            
        <!-- Modal -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden value="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Archive Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden value="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <small class="text-muted">Nomor Barcode</small> <br>
                            <h4 id="barcode_info">...</h4>
                        </div>
                        
                        <div class="form-group mb-3">
                            <small class="text-muted">Kondisi</small> <br>
                            <h4 id="condition_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Lokasi Rak</small> <br>
                            <h4 id="rack_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Jenis Berkas</small> <br>
                            <h4 id="type_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Nomor SK</small> <br>
                            <h4 id="sk_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Nama</small> <br>
                            <h4 id="name_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Alamat</small> <br>
                            <h4 id="address_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Provinsi</small> <br>
                            <h4 id="provinsi_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Kabupaten / Kota</small> <br>
                            <h4 id="kab_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Kecamatan</small> <br>
                            <h4 id="kec_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Kelurahan</small> <br>
                            <h4 id="kel_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Jenis Hak</small> <br>
                            <h4 id="right_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Status Scan Berkas</small> <br>
                            <h4 id="scan_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Status Fisik Berkas</small> <br>
                            <h4 id="physical_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Keterangan</small> <br>
                            <h4 id="description_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Diarsipkan Oleh</small> <br>
                            <h4 id="user_info">...</h4>
                        </div>

                        <div class="form-group mb-3">
                            <small class="text-muted">Diarsipkan Tanggal</small> <br>
                            <h4 id="created_info">...</h4>
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn_delete" data-toggle="modal" class="btn btn-danger" data-target="#deleteModal">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden value="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('archive.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Archive</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden value=""="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group" id="barcode_number_form">
                            <label class="h5">Nomor Barcode</label>
                            <div class="input-group input-group-alternative">
                                <input required type="number" class="form-control form-control-alternative" id="barcode_number" name="barcode_number" placeholder="Nomor Barcode">
                            </div>
                            @error('barcode_number')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" id="condition_id_form">
                            <label class="h5">Kondisi</label>
                            <div class="input-group input-group-alternative">
                                <select required class="form-control form-control-alternative mr-2" id="condition_id" name="condition_id">
                                    <option hidden value="">Pilih Kondisi Berkas</option>
                                    @foreach ($conditions as $condition)
                                        <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('condition_id')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" id="rack_location_form">
                            <label class="h5">Lokasi Rak</label>
                            <div class="input-group input-group-alternative">
                                <input required type="text" class="form-control form-control-alternative" id="rack_location" name="rack_location" placeholder="Lokasi Rak">
                            </div>
                            @error('rack_location')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="form-group" id="type_id_form">
                            <label class="h5">Jenis Berkas</label>
                            <div class="input-group input-group-alternative">
                                <select required class="form-control form-control-alternative mr-2" id="type_id" name="type_id">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('type_id')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" id="sk_number_form">
                            <label class="h5">Nomor SK</label>
                            <div class="input-group input-group-alternative">
                                <input required type="text" class="form-control form-control-alternative" id="sk_number" name="sk_number" placeholder="Nomor SK">
                            </div>
                            @error('sk_number')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" id="name_form">
                            <label class="h5">Nama</label>
                            <div class="input-group input-group-alternative">
                                <input required type="text" class="form-control form-control-alternative" id="name" name="name" placeholder="Nama">
                            </div>
                            @error('name')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" id="address_form">
                            <label class="h5">Alamat</label>
                            <div class="input-group input-group-alternative">
                                <input required type="text" class="form-control form-control-alternative" id="address" name="address" placeholder="Alamat">
                            </div>
                            @error('address')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" id="provinsi_form">
                            <label class="h5">Provinsi</label>
                            <div class="input-group input-group-alternative">
                                <select required class="form-control form-control-alternative mr-2" id="provinsi" name="provinsi">
                                    @foreach ($provinsi as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('provinsi')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" id="kab_kota_form">
                            <label class="h5">Kabupaten / Kota</label>
                            <div class="input-group input-group-alternative">
                                <select required class="form-control form-control-alternative mr-2" id="kab_kota" name="kab_kota">
                                </select>
                            </div>
                            @error('kab_kota')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" id="kecamatan_form">
                            <label class="h5">Kecamatan</label>
                            <div class="input-group input-group-alternative">
                                <select required class="form-control form-control-alternative mr-2" id="kecamatan" name="kecamatan">
                                </select>
                            </div>
                            @error('kecamatan')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" id="kelurahan_form">
                            <label class="h5">Kelurahan</label>
                            <div class="input-group input-group-alternative">
                                <select required class="form-control form-control-alternative mr-2" id="kelurahan" name="kelurahan">
                                </select>
                            </div>
                            @error('kelurahan')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" id="right_type_id_form">
                            <label class="h5">Jenis Hak</label>
                            <div class="input-group input-group-alternative">
                                <select required class="form-control form-control-alternative mr-2" id="right_type_id" name="right_type_id">
                                    <option hidden value="">Pilih Jenis Hak</option>
                                    @foreach ($rights as $right)
                                        <option value="{{ $right->id }}">{{ $right->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('right_type_id')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" id="scan_status_id_form">
                            <label class="h5">Status Pindai Berkas</label>
                            <div class="input-group input-group-alternative">
                                <select required class="form-control form-control-alternative mr-2" id="scan_status_id" name="scan_status_id">
                                    <option hidden value="">Pilih Status Pindai</option>
                                    @foreach ($scans as $scan)
                                        <option value="{{ $scan->id }}">{{ $scan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('scan_status_id')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" id="physical_status_id_form">
                            <label class="h5">Status Fisik Berkas</label>
                            <div class="input-group input-group-alternative">
                                <select required class="form-control form-control-alternative mr-2" id="physical_status_id" name="physical_status_id">
                                    <option hidden value="">Pilih Status Fisik</option>
                                    @foreach ($physicals as $physical)
                                        <option value="{{ $physical->id }}">{{ $physical->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('physical_status_id')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" id="description_form">
                            <label class="h5">Keterangan</label>
                            <div class="input-group input-group-alternative">
                                <input type="text" class="form-control form-control-alternative" id="description" name="description" placeholder="Keterangan Berkas">
                            </div>
                            @error('description')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Archive</button>
                    </div>
                </form>
            </div>
            </div>
        </div>

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
                            <h4 class="heading mt-4">Delete Archive?</h4>
                            <p>Are you sure want to delete this archive? <br> Every deleted archive can't be restored!</p>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                        <form method="post" id="form_delete"
                            class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-white">Delete Archive</button>
                        </form>
                        <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button> 
                    </div>
                    
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
@endsection

@push('js')
    @if (!$errors->isEmpty())
        <script>
            $('#addModal').modal('show');
        </script>
    @endif

    <script type="text/javascript" src="{{ asset('argon/vendor/data-tables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('select[name=type_id] option[value=1]').attr('selected','selected');
            $('#type_id').val(1).change()

            $('select[name=physical_status_id] option[value=1]').attr('selected','selected');
            $('#physical_status_id').val(1).change()

            $('.select2').select2();

            $('#detailModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var modal = $(this)

                modal.find('.modal-body #barcode_info').html(button.data('barcode'))
                modal.find('.modal-body #rack_info').html(button.data('rack'))
                modal.find('.modal-body #type_info').html(button.data('type'))
                modal.find('.modal-body #sk_info').html(button.data('sk'))
                modal.find('.modal-body #name_info').html(button.data('name'))
                modal.find('.modal-body #address_info').html(button.data('address'))
                modal.find('.modal-body #provinsi_info').html(button.data('provinsi'))
                modal.find('.modal-body #kab_info').html(button.data('kab'))
                modal.find('.modal-body #kec_info').html(button.data('kecamatan'))
                modal.find('.modal-body #kel_info').html(button.data('kelurahan'))
                modal.find('.modal-body #right_info').html(button.data('right'))
                modal.find('.modal-body #scan_info').html(button.data('scan'))
                modal.find('.modal-body #physical_info').html(button.data('physical'))
                modal.find('.modal-body #condition_info').html(button.data('condition'))
                modal.find('.modal-body #description_info').html(button.data('description'))
                modal.find('.modal-body #user_info').html(button.data('user'))
                modal.find('.modal-body #created_info').html(button.data('created'))

                modal.find('.modal-footer #btn_delete').data('id', button.data('id'))
                modal.find('.modal-footer #btn_delete').data('name', button.data('sk'))
            })

            $('#deleteModal').on('show.bs.modal', function (event) {
                $('#detailModal').modal('hide')

                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-* attributes
                var name = button.data('name') 
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                var baseUrl = '{{ url('/') }}'

                modal.find('.modal-body .heading').html('Delete archive ' + name + ' ?')
                modal.find('.modal-footer #form_delete').attr('action', baseUrl + '/archive/' + id);
            })

            $(document).on('change', '#provinsi', function() {
                var provinsiID = $(this).val();
                if(provinsiID) {
                    $.ajax({
                        url: '/getCities/'+provinsiID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data)
                        {
                            if(data){
                                $('#kab_kota').empty();
                                $('#kab_kota').append('<option hidden value="">Pilih Kabupaten / Kota</option>' );
                                $.each(data, function(key, item){
                                    $('#kab_kota').append('<option value="'+item.id+'">'+item.name+'</option>' );
                                });
                            }else{
                                $('#kab_kota').empty();
                            }
                        }
                    });
                }else{
                    $('#kab_kota').empty();
                }
            });

            $('select[name=provinsi] option[value=11]').attr('selected','selected');
            $('#provinsi').val(11).change()

            $(document).on('change', '#kab_kota', function() {
               var kabID = $(this).val();
               if(kabID) {
                   $.ajax({
                        url: '/getDistricts/'+kabID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data)
                        {
                            if(data){
                                $('#kecamatan').empty();
                                $('#kecamatan').append('<option hidden value="">Pilih Kecamatan</option>' );
                                $.each(data, function(key, item){
                                    console.log(item.name)
                                    $('#kecamatan').append('<option value="'+item.id+'">'+item.name+'</option>' );
                                });
                            }else{
                                $('#kecamatan').empty();
                            }
                        }
                   });
               }else{
                 $('#kecamatan').empty();
               }
            });

            $(document).on('change', '#kecamatan', function() {
                var kecamatanID = $(this).val();
                if(kecamatanID) {
                    $.ajax({
                        url: '/getVillages/'+kecamatanID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data)
                        {
                            if(data){
                                $('#kelurahan').empty();
                                $('#kelurahan').append('<option hidden value="">Pilih Kelurahan</option>' );
                                $.each(data, function(key, item){
                                    $('#kelurahan').append('<option value="'+item.id+'">'+item.name+'</option>' );
                                });
                            }else{
                                $('#kelurahan').empty();
                            }
                        }
                    });
                }else{
                    $('#kelurahan').empty();
                }
            });

            $(document).on('change', '#condition_id', function() {
                var conditionID = $(this).val();
                if(conditionID == 4) {
                    $('#sk_number').removeAttr('required');
                    $('#rack_location').removeAttr('required');
                    $('#name').removeAttr('required');
                    $('#address').removeAttr('required');
                    $('#kelurahan').removeAttr('required');
                    $('#kecamatan').removeAttr('required');
                    $('#kab_kota').removeAttr('required');
                    $('#provinsi').removeAttr('required');
                    $('#right_type_id').removeAttr('required');
                    $('#scan_status_id').removeAttr('required');
                    $('#physical_status_id').removeAttr('required');

                    $('#rack_location_form').hide();
                    $('#name_form').hide();
                    $('#address_form').hide();
                    $('#kelurahan_form').hide();
                    $('#kecamatan_form').hide();
                    $('#kab_kota_form').hide();
                    $('#provinsi_form').hide();
                    $('#right_type_id_form').hide();
                    $('#scan_status_id_form').hide();
                    $('#physical_status_id_form').hide();
                } else {
                    $('#sk_number').prop('required',true);
                    $('#rack_location').prop('required',true);
                    $('#name').prop('required',true);
                    $('#address').prop('required',true);
                    $('#kelurahan').prop('required',true);
                    $('#kecamatan').prop('required',true);
                    $('#kab_kota').prop('required',true);
                    $('#provinsi').prop('required',true);
                    $('#right_type_id').prop('required',true);
                    $('#scan_status_id').prop('required',true);
                    $('#physical_status_id').prop('required',true);

                    $('#rack_location_form').show();
                    $('#name_form').show();
                    $('#address_form').show();
                    $('#kelurahan_form').show();
                    $('#kecamatan_form').show();
                    $('#kab_kota_form').show();
                    $('#provinsi_form').show();
                    $('#right_type_id_form').show();
                    $('#scan_status_id_form').show();
                    $('#physical_status_id_form').show();
                }
            });

        });
    </script>
@endpush

