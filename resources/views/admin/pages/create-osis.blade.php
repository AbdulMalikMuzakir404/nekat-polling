@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
<style>
    ::-webkit-scrollbar {
        display: none;
    }
</style>

<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li style="font-size: 12px" class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li style="font-size: 12px" class="breadcrumb-item text-dark active" aria-current="page">Data OSIS</li>
        </ol>
        <h6 style="font-size: 15px" class="font-weight-bolder mb-0">Data OSIS</h6>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        </div>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
              <i class="fa fa-user me-sm-1"></i>
              <span style="font-size: 12px" class="d-sm-inline d-none">{{ auth()->user()->name }}</span>
            </a>
          </li>
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
          <li class="nav-item px-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0">
              <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<!-- End Navbar -->

{{-- Modal Import Data Osis --}}
<div style="opacity: 90%" class="modal fade" id="modalImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalImportLabel">Import Data Osis</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('import.data.osis') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="mb-3">
                        <label for="import" class="form-label">Pilih File</label>
                        <input class="form-control" type="file" name="file" id="import" multiple required>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
{{-- End Modal Import Data osis --}}

<div class="container-fluid py-4">
    {{-- Form Create --}}
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div style="opacity: 80%" class="card">
                <div class="card-header">
                    <p>Buat Data OSIS</p>
                </div>
                <div class="card-body p-3">
                    <form role="form" action="{{ route("data-osis.store") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nis_calon">NIS Calon Ketua OSIS</label>
                                    <div class="mb-3">
                                        <input type="text" id="nis_calon" name="nis_calon" class="form-control @error('nis_calon') is-invalid @enderror" value="{{ old('nis_calon') }}" placeholder="NIS Calon Ketua OSIS" autofocus required>
                                        @error('nis_calon')
                                            <span class="invalid-feedback" role="alert">
                                                <p style="font-size: 13px">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nis_wakil_calon">NIS Wakil Calon OSIS</label>
                                    <div class="mb-3">
                                        <input type="text" id="nis_wakil_calon" name="nis_wakil_calon" class="form-control @error('nis_wakil_calon') is-invalid @enderror" value="{{ old('nis_wakil_calon') }}" placeholder="NIS Wakil Calon OSIS" required>
                                        @error('nis_wakil_calon')
                                            <span class="invalid-feedback" role="alert">
                                                <p style="font-size: 13px">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_calon">Nama Calon Ketua OSIS</label>
                                    <div class="mb-3">
                                        <input type="text" id="nama_calon" name="nama_calon" class="form-control @error('nama_calon') is-invalid @enderror" value="{{ old('nama_calon') }}" placeholder="Nama Calon Ketua OSIS" required>
                                        @error('nama_calon')
                                            <span class="invalid-feedback" role="alert">
                                                <p style="font-size: 13px">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_wakil_calon">Nama Wakil Calon OSIS</label>
                                    <div class="mb-3">
                                        <input type="text" id="nama_wakil_calon" name="nama_wakil_calon" class="form-control @error('nama_wakil_calon') is-invalid @enderror" value="{{ old('nama_wakil_calon') }}" placeholder="Nama Wakil Calon OSIS" required >
                                        @error('nama_wakil_calon')
                                            <span class="invalid-feedback" role="alert">
                                                <p style="font-size: 13px">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="foto_calon">Foto Calon OSIS</label>
                                    <div class="mb-3">
                                        <div class="needsclick dropzone" id="calonDropzone">

                                        </div>
                                        @error('foto_calon')
                                            <span class="invalid-feedback" role="alert">
                                                <p style="font-size: 13px">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="team">Team</label>
                                    <div class="mb-3">
                                        <select name="team" id="team" class="form-select @error('team') is-invalid @enderror" value="{{ old('team') }}" required aria-label="Default select example">
                                            <option disabled="true" selected>Team</option>
                                            <option value="Team A">Team A</option>
                                            <option value="Team B">Team B</option>
                                            <option value="Team C">Team C</option>
                                            <option value="Team D">Team D</option>
                                            <option value="Team E">Team E</option>
                                        </select>
                                        @error('team')
                                            <span class="invalid-feedback" role="alert">
                                                <p style="font-size: 13px">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="visi">VISI</label>
                                    <div class="mb-3">
                                        <textarea name="visi" id="visi" cols="30" rows="8" class="form-control @error('visi') is-invalid @enderror" value="{{ old('visi') }}" placeholder="VISI" required></textarea>
                                        @error('visi')
                                            <span class="invalid-feedback" role="alert">
                                                <p style="font-size: 13px">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="misi">MISI</label>
                                    <div class="mb-3">
                                        <textarea name="misi" id="misi" cols="30" rows="7" class="form-control @error('misi') is-invalid @enderror" value="{{ old('misi') }}" placeholder="MISI" required></textarea>
                                        @error('misi')
                                            <span class="invalid-feedback" role="alert">
                                                <p style="font-size: 13px">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <button type="submit" class="btn bg-gradient-info w-20 mt-4 mb-0">Save</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Form Create --}}

    {{-- Modal Update Data osis --}}
    <div style="opacity: 90%;" class="modal fade shadow-blur editModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data OSIS</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            {{-- Form Update --}}
            <form role="form" action="{{ route("data-osis.ubah") }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="osis_id" id="osis_id">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nis_calon_edit">NIS Calon Ketua OSIS</label>
                            <div class="mb-3">
                                <input type="text" id="nis_calon_edit" name="nis_calon" class="form-control @error('nis_calon') is-invalid @enderror" value="{{ old('nis_calon') }}" placeholder="NIS Calon Ketua OSIS" autofocus required>
                                @error('nis_calon')
                                    <span class="invalid-feedback" role="alert">
                                        <p style="font-size: 13px">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nis_wakil_calon_edit">NIS Wakil Calon OSIS</label>
                            <div class="mb-3">
                                <input type="text" id="nis_wakil_calon_edit" name="nis_wakil_calon" class="form-control @error('nis_wakil_calon') is-invalid @enderror" value="{{ old('nis_wakil_calon') }}" placeholder="NIS Wakil Calon OSIS" required>
                                @error('nis_wakil_calon')
                                    <span class="invalid-feedback" role="alert">
                                        <p style="font-size: 13px">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_calon_edit">Nama Calon Ketua OSIS</label>
                            <div class="mb-3">
                                <input type="text" id="nama_calon_edit" name="nama_calon" class="form-control @error('nama_calon') is-invalid @enderror" value="{{ old('nama_calon') }}" placeholder="Nama Calon Ketua OSIS" required>
                                @error('nama_calon')
                                    <span class="invalid-feedback" role="alert">
                                        <p style="font-size: 13px">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_wakil_calon_edit">Nama Wakil Calon OSIS</label>
                            <div class="mb-3">
                                <input type="text" id="nama_wakil_calon_edit" name="nama_wakil_calon" class="form-control @error('nama_wakil_calon') is-invalid @enderror" value="{{ old('nama_wakil_calon') }}" placeholder="Nama Wakil Calon OSIS" required >
                                @error('nama_wakil_calon')
                                    <span class="invalid-feedback" role="alert">
                                        <p style="font-size: 13px">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="foto_calon_edit">Foto Calon OSIS</label>
                            <div class="mb-3">
                                <div class="needsclick dropzone" id="calonEditDropzone">

                                </div>
                                @error('foto_calon')
                                    <span class="invalid-feedback" role="alert">
                                        <p style="font-size: 13px">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="team_edit">Team</label>
                            <div class="mb-3">
                                <select name="team" id="team_edit" class="form-select @error('team') is-invalid @enderror" value="{{ old('team') }}" required aria-label="Default select example">
                                    <option disabled="true" selected>Team</option>
                                    <option value="Team A">Team A</option>
                                    <option value="Team B">Team B</option>
                                    <option value="Team C">Team C</option>
                                    <option value="Team D">Team D</option>
                                    <option value="Team E">Team E</option>
                                </select>
                                @error('team')
                                    <span class="invalid-feedback" role="alert">
                                        <p style="font-size: 13px">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="visi_edit">VISI_edit</label>
                            <div class="mb-3">
                                <textarea name="visi" id="visi_edit" cols="30" rows="5" class="form-control @error('visi') is-invalid @enderror" value="{{ old('visi') }}" placeholder="VISI" required></textarea>
                                @error('visi')
                                    <span class="invalid-feedback" role="alert">
                                        <p style="font-size: 13px">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="misi_edit">MISI</label>
                            <div class="mb-3">
                                <textarea name="misi" id="misi_edit" cols="30" rows="5" class="form-control @error('misi') is-invalid @enderror" value="{{ old('misi') }}" placeholder="MISI" required></textarea>
                                @error('misi')
                                    <span class="invalid-feedback" role="alert">
                                        <p style="font-size: 13px">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="#">Status</label>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_polling" value="1" id="status_polling_active_edit">
                                    <label class="form-check-label" for="status_polling_active_edit">
                                    Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_polling" value="0" id="status_polling_nonactive_edit">
                                    <label class="form-check-label" for="status_polling_nonactive_edit">
                                    NonActive
                                    </label>
                                </div>
                                @error('status_polling')
                                    <span class="invalid-feedback" role="alert">
                                        <p style="font-size: 13px">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary w-auto mt-4 mb-0" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-info w-auto mt-4 mb-0">Save</button>
                    </div>
                </div>
              </form>
            {{-- End Form Update --}}
            </div>
        </div>
        </div>
    </div>
    {{-- End Modal Update Data osis --}}

    {{-- Table --}}
    <div class="mt-5">
        <div style="opacity: 80%" class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6">
                        <p>Table Data OSIS</p>
                    </div>
                    <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0 position-absolute end-0">
                        <form action="{{ route('data-osis.create') }}" method="get">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" name="search" class="form-control" placeholder="Type here..." value="{{ old('cari') }}">
                            </div>
                        </form>
                    </div>
                  </div>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-center text-xxs font-weight-bolder opacity-7">No</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto Calon OSIS</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Calon OSIS</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Visi</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Misi</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><i class="bi bi-gear"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($dataCalon as $key => $osis)
                        <tr>
                            <td class="text-center">
                                <div class="d-flex flex-column justify-content-center">
                                    <p class="text-xs mb-0">{{ $key+= $dataCalon->firstItem() }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-xs">
                                    @if ($osis->foto_calon)
                                        <a href="{{ $osis->foto_calon->getUrl() }}" target="_blank">
                                            <img src="{{ $osis->foto_calon->getUrl() }}" class="rounded-circle" alt="image" width="45px" height="45px">
                                        </a>
                                    @else
                                        <span class="badge badge-warning">No Image</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                              <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm">{{ $osis->nama_calon }}</h6>
                                  <p class="text-xs text-secondary mb-0">{{ $osis->nama_wakil_calon }}</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">{{ $osis->visi }}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">{{ $osis->misi }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                @if($osis->status_polling === 1)
                                <span class="badge badge-sm bg-gradient-success">Active</span>
                                @else
                                <span class="badge badge-sm bg-gradient-secondary">NonActive</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="row">
                                    <div class="col-6 col-sm-3">
                                        <button type="button" value="{{ $osis->id }}" class="badge badge-sm text-secondary bg-gradient-primary editBtn" data-toggle="tooltip" data-original-title="Edit osis">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </div>
                                    <div class="col-6 col-sm-3 mx-1">
                                        <form method="POST" action="{{ route('data-osis.destroy', $osis->id) }}">
                                            @csrf
                                            @method('delete')
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="badge badge-sm text-secondary bg-gradient-danger show_confirm" data-toggle="tooltip" title='Delete' data-original-title="Delete osis"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="container mt-3">
                    {{ $dataCalon->links() }}
                  </div>
            </div>
        </div>
    </div>
    {{-- End Table --}}
</div>

@endsection

@push('js')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<script>
    Dropzone.options.calonDropzone = {
            url: "{{ route('data-osis.storeImage') }}",
            acceptedFiles: '.jpeg,.jpg,.png',
            maxFiles: 1,
            maxFilesize: 2, // satuan MB(Mega Byte)
            addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').find('input[name="foto_calon"]').remove()
            $('form').append('<input type="hidden" name="foto_calon" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="foto_calon"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }
            return _results
        }
    }

    Dropzone.options.calonEditDropzone = {
            url: "{{ route('data-osis.storeImage') }}",
            acceptedFiles: '.jpeg,.jpg,.png',
            maxFiles: 1,
            maxFilesize: 2,
            addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').find('input[name="foto_calon_edit"]').remove()
            $('form').append('<input type="hidden" name="foto_calon_edit" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="foto_calon_edit"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function () {
            @if(isset($osis) && $osis->foto_calon)
                var file = {!! json_encode($osis->foto_calon) !!}
                    this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, "{{ $osis->foto_calon->getUrl() }}")
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="foto_calon_edit" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
            @endif
        },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }
            return _results
        }
    }
</script>

<script>
    $(function(){
        // create
        $('#nis_calon').on('keyup', function(){
            let nis_calon=$(this).val();
            console.log(nis_calon);
            $.ajax({
            url:'get-calon-osis/'+nis_calon,
            method:'get',
            success:function(data){
                console.log(data);
                $('#nama_calon').val(data['nama']);
            }
            });
        });

        $('#nis_wakil_calon').on('keyup', function(){
            let nis_wakil_calon=$(this).val();
            console.log(nis_wakil_calon);
            $.ajax({
            url:'get-wakil-calon-osis/'+nis_wakil_calon,
            method:'get',
            success:function(data){
                console.log(data);
                $('#nama_wakil_calon').val(data['nama']);
            }
            });
        });

        // edit
        $('#nis_calon_edit').on('keyup', function(){
        let nis_calon_edit=$(this).val();
        console.log(nis_calon_edit);
        $.ajax({
          url:'get-calon-osis/'+nis_calon_edit,
          method:'get',
          success:function(data){
            console.log(data);
            $('#nama_calon_edit').val(data['nama']);
          }
        });
      });

      $('#nis_wakil_calon_edit').on('keyup', function(){
        let nis_wakil_calon_edit=$(this).val();
        console.log(nis_wakil_calon_edit);
        $.ajax({
          url:'get-wakil-calon-osis/'+nis_wakil_calon_edit,
          method:'get',
          success:function(data){
            console.log(data);
            $('#nama_wakil_calon_edit').val(data['nama']);
          }
        });
      });
    });
</script>


<script>
    $(document).ready(function () {
        $('.editBtn').on('click', function () {
            let osis_id = $(this).val();

            $('.editModal').modal('show');

            $.ajax({
                type: "GET",
                url: "/admin/data-osis/" + osis_id + "/edit",
                success: function(response) {
                    console.log(response);
                    $('#osis_id').val(response.data.id);
                    $('#nis_calon_edit').val(response.data.nis_calon);
                    $('#nis_wakil_calon_edit').val(response.data.nis_wakil_calon);
                    $('#nama_calon_edit').val(response.data.nama_calon);
                    $('#nama_wakil_calon_edit').val(response.data.nama_wakil_calon);
                    $('#team_edit').val(response.data.team);
                    $('#visi_edit').val(response.data.visi);
                    $('#misi_edit').val(response.data.misi);
                    if (response.data.status_polling === 1) {
                        $('#status_polling_active_edit').attr('checked', true);
                    } else if (response.data.status_polling === 0) {
                        $('#status_polling_nonactive_edit').attr('checked', true);
                    }
                }
            });
        });
    });
</script>
@endpush
