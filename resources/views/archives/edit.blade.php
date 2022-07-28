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
                                <h3 class="mb-0">Edit Archives</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12"></div>

                    <form action="{{ route('archive.update', $archive->id) }}" method="post" autocomplete="off">
                        @method('put')
                        @csrf
                        <div class="modal-body">
    
                            <div class="form-group" id="barcode_number_form">
                                <label class="h5">Nomor Barcode</label>
                                <div class="input-group input-group-alternative">
                                    <input value="{{ old('barcode_number', $archive->barcode_number) }}" required type="number" class="form-control form-control-alternative" id="barcode_number" name="barcode_number" placeholder="Nomor Barcode" autocomplete="off">
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
                                            <option {{ old('condition_id', $condition->id) == $condition->id ? 'selected' : '' }} value="{{ $condition->id }}">{{ $condition->name }}</option>
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
                                    <input value="{{ old('rack_location', $archive->rack_location) }}" required type="text" class="form-control form-control-alternative" id="rack_location" name="rack_location" placeholder="Lokasi Rak" autocomplete="off">
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
                                            <option {{ old('type_id', $type->id) == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
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
                                    <input value="{{ old('sk_number', $archive->sk_number) }}" required type="text" class="form-control form-control-alternative" id="sk_number" name="sk_number" placeholder="Nomor SK" autocomplete="off">
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
                                    <input value="{{ old('name', $archive->name) }}" required type="text" class="form-control form-control-alternative" id="name" name="name" placeholder="Nama" autocomplete="off">
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
                                    <input value="{{ old('address', $archive->address) }}" required type="text" class="form-control form-control-alternative" id="address" name="address" placeholder="Alamat" autocomplete="off">
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
                                            <option {{ old('right_type_id', $right->id) == $right->id ? 'selected' : '' }} value="{{ $right->id }}">{{ $right->name }}</option>
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
                                            <option {{ old('scan_status_id', $scan->id) == $scan->id ? 'selected' : '' }} value="{{ $scan->id }}">{{ $scan->name }}</option>
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
                                            <option {{ old('physical_status_id', $physical->id) == $physical->id ? 'selected' : '' }} value="{{ $physical->id }}">{{ $physical->name }}</option>
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
                                    <input value="{{ old('description', $archive->description) }}" type="text" class="form-control form-control-alternative" id="description" name="description" placeholder="Keterangan Berkas" autocomplete="off">
                                </div>
                                @error('description')
                                    <span class="invalid-feedback d-inline" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-secondary" data-dismiss="modal" href="{{ url()->previous(); }}">Back</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            var prov = "{{ $archive->rack_location }}"
        </script>

        @include('layouts.footers.auth')
@endsection

@push('js')
    <script>
        $(document).ready(function() {

            var first = true;

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
                                
                                if("{{ $archive->provinsi }}"){
                                    if(first){
                                        $("#kab_kota option:contains('{{ $archive->kab_kota }}')").prop("selected", "selected").change();
                                    }
                                }
                            }else{
                                $('#kab_kota').empty();
                            } 
                        }
                    });
                }else{
                    $('#kab_kota').empty();
                }
            }); 

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

                                if("{{ $archive->provinsi }}"){
                                    if(first){
                                        $("#kecamatan option:contains('{{ $archive->kecamatan }}')").prop("selected", "selected").change();
                                    } 
                                }
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

                                if("{{ $archive->provinsi }}"){
                                    if(first){
                                        $("#kelurahan option:contains('{{ $archive->kelurahan }}')").prop("selected", "selected").change();
                                    } 
                                }
                            }else{
                                $('#kelurahan').empty();
                            }

                            first = false;
                        }
                    });
                }else{
                    $('#kelurahan').empty();
                }
            }); 

            $("#provinsi option:contains('{{ $archive->provinsi }}')").prop("selected", "selected").change();

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

                    $('#rack_location').val("");
                    $('#name').val("");
                    $('#address').val("");
                    $('#kelurahan').val("");
                    $('#kecamatan').val("");
                    $('#kab_kota').val("");
                    $('#provinsi').val("");
                    $('#right_type_id').val("");
                    $('#scan_status_id').val("");
                    $('#physical_status_id').val("");

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

            $("#condition_id").val({{ $archive->condition_id }}).change();

        });
    </script>
@endpush
