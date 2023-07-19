@extends('layouts.siswa')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li style="font-size: 12px" class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li style="font-size: 12px" class="breadcrumb-item text-dark active" aria-current="page">Home</li>
        </ol>
        <h6 style="font-size: 15px" class="font-weight-bolder mb-0">Home</h6>
      </nav>
      <div class="" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        </div>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
              <i class="fa fa-user me-sm-1"></i>
              <span style="font-size: 12px" class="d-sm-inline d-none">{{ auth()->user()->name }}</span>
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

@if (auth()->user()->voting == 0 && auth()->user()->status == "active")
<div class="container-fluid py-4">
    <div class="mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row justify-content-md-center">
                    @foreach ($kandidat as $k)
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header text-center fw-bold" style="height: 100px">
                                {{ $k->nama_calon }} & {{ $k->nama_wakil_calon }}
                            </div>
                            @if ($k->foto_calon)
                                <a href="{{ $k->foto_calon->getUrl() }}" target="_blank">
                                    <img src="{{ $k->foto_calon->getUrl() }}" class="card-img-top" style="height: 200px" alt="...">
                                </a>
                            @else
                                <span class="badge badge-warning">No Image</span>
                            @endif
                            <div class="card-body p-0">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingVisi{{ $k->id }}">
                                            <button class="accordion-button collapsed"
                                                style="box-shadow: 0 0 0 0rem " type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseVisi{{ $k->id }}"
                                                aria-expanded="false"
                                                aria-controls="flush-collapseVisi{{ $k->id }}">
                                                Visi
                                            </button>
                                        </h2>
                                        <div id="flush-collapseVisi{{ $k->id }}"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingVisi{{ $k->id }}"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                {{ $k->visi }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingMisi{{ $k->id }}">
                                            <button class="accordion-button collapsed"
                                                style="box-shadow: 0 0 0 0rem " type="button" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse{{ $k->id }}"
                                                aria-expanded="false"
                                                aria-controls="flush-collapse{{ $k->id }}">
                                                Misi
                                            </button>
                                        </h2>
                                        <div id="flush-collapse{{ $k->id }}"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingMisi{{ $k->id }}"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                {{ $k->misi }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('vote.siswa', $k->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary d-grid gap-4 w-100 p-3 show_confirm">Vote</button>
                                </form>
                                <a href="{{ route('detail-osis', $k->id) }}" class="btn btn-info d-grid gap-4 p-3">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="container py-4">
    @if (auth()->user()->voting == 1)
    <div class="alert alert-danger">
        <h4 class="alert-heading">{{ auth()->user()->name }} Sudah Melakukan Voting</h4>
        <p>Jika {{ auth()->user()->name }} merasa belum melakukan voting, silahkan hubungin admin / panitia. <a style="text-decoration: none" href="/polling/messanger/1">kirim pesan</a></p>
    </div>
    @endif

    @if (auth()->user()->status == "inactive")
    <div class="alert alert-danger">
        <h4 class="alert-heading">Akun {{ auth()->user()->name }} sudah tidak aktif</h4>
        <p>Jika {{ auth()->user()->name }} mengalami masalah, silahkan hubungin admin / panitia. <a style="text-decoration: none" href="/polling/messanger/1">kirim pesan</a></p>
    </div>
    @endif
</div>
@endsection
