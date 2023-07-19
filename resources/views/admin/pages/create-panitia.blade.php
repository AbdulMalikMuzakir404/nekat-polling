@extends('layouts.app')

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
          <li style="font-size: 12px" class="breadcrumb-item text-dark active" aria-current="page">Data Panitia</li>
        </ol>
        <h6 style="font-size: 15px" class="font-weight-bolder mb-0">Data Panitia</h6>
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

{{-- Modal Import Data Panitia --}}
<div style="opacity: 90%" class="modal fade" id="modalImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalImportLabel">Import Data panitia</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('import.data.panitia') }}" method="post" enctype="multipart/form-data">
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
{{-- End Modal Import Data panitia --}}

<div class="container-fluid py-4">
    {{-- Form Create --}}
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div style="opacity: 80%" class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <p>Buat Data panitia</p>
                        </div>
                        <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0 position-absolute end-0">
                            <button type="button" class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2 btn-sm w-auto" data-bs-toggle="modal" data-bs-target="#modalImport">Import Excel</button>
                            <a href="{{ route('export.data.panitia') }}" class="btn bg-gradient-success w-100 px-3 mb-2 ms-2 btn-sm w-auto">Export Excel</a>
                        </div>
                      </div>
                </div>
                <div class="card-body p-3">
                    <form role="form" action="{{ route("data-panitia.store") }}" method="post">
                        @csrf
                            <div class="">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <div class="mb-3">
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama Lengkap" autofocus required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <p style="font-size: 13px">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="mb-3">
                                        <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" aria-label="Email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <p style="font-size: 13px">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="mb-3">
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <p style="font-size: 13px">{{ $message }}</p>
                                            </span>
                                        @enderror
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

    {{-- Modal Update Data panitia --}}
    <div style="opacity: 90%;" class="modal fade shadow-blur editModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data panitia</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            {{-- Form Update --}}
            <form role="form" action="{{ route('data-panitia.ubah') }}" method="post">
                @csrf
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label for="name_edit">Nama Lengkap</label>
                        <div class="mb-3">
                            <input type="text" id="name_edit" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama Lengkap" autofocus required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <p style="font-size: 13px">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email_edit">Email</label>
                        <div class="mb-3">
                            <input type="text" id="email_edit" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" aria-label="Email" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <p style="font-size: 13px">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_edit">Password</label>
                        <div class="mb-3">
                            <input type="text" id="password_edit" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Password" required>
                            @error('password')
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
                                <input class="form-check-input" type="radio" name="status" value="active" id="status_panitia_active_edit">
                                <label class="form-check-label" for="status_panitia_active_edit">
                                Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="inactive" id="status_panitia_nonactive_edit">
                                <label class="form-check-label" for="status_panitia_nonactive_edit">
                                NonActive
                                </label>
                            </div>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <p style="font-size: 13px">{{ $message }}</p>
                                </span>
                            @enderror
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
    {{-- End Modal Update Data panitia --}}

    {{-- Table --}}
    <div class="mt-5">
        <div style="opacity: 80%" class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6">
                        <p>Table Data Panitia</p>
                    </div>
                    <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0 position-absolute end-0">
                        <form action="{{ route('data-panitia.create') }}" method="get">
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
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><i class="bi bi-gear"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($dataPanitia as $key => $panitia)
                        <tr>
                            <td class="text-center">
                                <div class="d-flex flex-column justify-content-center">
                                    <p class="text-xs mb-0">{{ $key+= $dataPanitia->firstItem() }}</p>
                                </div>
                            </td>
                            <td>
                              <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <p class="text-xs text-secondary mb-0">{{ $panitia->name }}</p>
                                </div>
                              </div>
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">
                                  <div class="d-flex flex-column justify-content-center">
                                    <p class="text-xs text-secondary mb-0">{{ $panitia->email }}</p>
                                  </div>
                                </div>
                              </td>
                            <td class="align-middle text-center text-sm">
                                @if($panitia->status === 'active')
                                <span class="badge badge-sm bg-gradient-success">{{ $panitia->status }}</span>
                                @else
                                <span class="badge badge-sm bg-gradient-secondary">{{ $panitia->status }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="row">
                                    <div class="col-6 col-sm-3">
                                        <button type="button" value="{{ $panitia->id }}" class="badge badge-sm text-secondary bg-gradient-primary editBtn" data-toggle="tooltip" data-original-title="Edit panitia">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </div>
                                    <div class="col-6 col-sm-3 mx-1">
                                        <form method="POST" action="{{ route('data-panitia.destroy', $panitia->id) }}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="badge badge-sm text-secondary bg-gradient-danger show_confirm" data-toggle="tooltip" title='Delete' data-original-title="Delete panitia"><i class="bi bi-trash"></i></button>
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
                    {{ $dataPanitia->links() }}
                  </div>
            </div>
        </div>
    </div>
    {{-- End Table --}}
</div>

@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('.editBtn').on('click', function () {
            let panitia_id = $(this).val();

            $('.editModal').modal('show');

            $.ajax({
                type: "GET",
                url: "/admin/data-panitia/" + panitia_id + "/edit",
                success: function(response) {
                    console.log(response);
                    $('#user_id').val(response.data.id);
                    $('#name_edit').val(response.data.name);
                    $('#email_edit').val(response.data.email);
                    $('#password_edit').val(response.data.password_show);
                    if (response.data.status === 'active') {
                        $('#status_panitia_active_edit').attr('checked', true);
                    } else if (response.data.status === 'inactive') {
                        $('#status_panitia_nonactive_edit').attr('checked', true);
                    }
                }
            });
        });
    });
</script>
@endpush
