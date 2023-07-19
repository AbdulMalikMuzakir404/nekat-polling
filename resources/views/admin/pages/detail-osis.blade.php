@extends('layouts.siswa')

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
          <li style="font-size: 12px" class="breadcrumb-item text-dark active" aria-current="page">Details OSIS</li>
        </ol>
        <h6 style="font-size: 15px" class="font-weight-bolder mb-0">Details OSIS</h6>
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

<div class="container-fluid py-4">
    @if (auth()->user()->voting == 0 && auth()->user()->status == "active")
    <div class="row">
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3" style="height: 400px">
              <div class="row">
                <div class="col">
                    @if ($kandidat->foto_calon)
                    <a href="{{ $kandidat->foto_calon->getUrl() }}" target="_blank">
                        <div class="profile-image float-md-right"> <img style="border-radius: 20px" width="200px" height="250px" src="{{ $kandidat->foto_calon->getUrl() }}" alt="..."> </div>
                    </a>
                    @else
                        <span class="badge badge-warning">No Image</span>
                    @endif
                </div>
                <div class="col position-secondary">
                    <h6 class="m-t-0 m-b-0"><strong>{{ $kandidat->nama_calon . ' & ' . $kandidat->nama_wakil_calon }}</strong></h6>
                    <h6 class="job_post"><strong>{{ $kandidat->team }}</strong></h6>
                    <span class="job_post">Jumlah Suara : <p>{{ $kandidat->suara . ' Siswa' }}</p></span>
                    <div class="mt-5">
                        <div class="row">
                            <div class="row mb-3">
                                <div class="col">
                                    <h6 class="mb-0">Nama Ketua Calon</h6>
                                </div>
                                <div class="col">
                                    <p class="text-muted font-size-sm">{{ $kandidat->nama_calon }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <h6 class="mb-0">Nama Wakil Ketua Calon</h6>
                                </div>
                                <div class="col">
                                    <p class="text-muted font-size-sm">{{ $kandidat->nama_wakil_calon }}</p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <form action="{{ route('vote.siswa', $kandidat->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-round show_confirm">Vote</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3" style="height: 400px">
                <div class="" id="chart"></div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mt-4">
                <div class="card">
                  <div class="card-body p-3">
                    <div class="row mb-3">
                        <div class="col">
                            <h6 class="mb-0">Visi</h6>
                        </div>
                        <div class="col">
                            <p class="text-muted font-size-sm">{{ $kandidat->visi }}</p>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mt-4">
                <div class="card">
                  <div class="card-body p-3">
                    <div class="row mb-3">
                        <div class="col">
                            <h6 class="mb-0">Misi</h6>
                        </div>
                        <div class="col">
                            <p class="text-muted font-size-sm">{{ $kandidat->misi }}</p>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

    @endif

    @if (auth()->user()->voting == 1)
    <div class="alert alert-danger">
        <h4 class="alert-heading">Anda Sudah Melakukan Voting</h4>
        <p>Jika anda merasa belum melakukan voting, silahkan hubungin admin / panitia. <a style="text-decoration: none" href="/polling/messanger/1">kirim pesan</a></p>
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

@push('js')
<script>
var options = {
          series: [
                parseInt({{ $total_team_a }}),
                parseInt({{ $total_team_b }}),
                parseInt({{ $total_team_c }}),
                parseInt({{ $total_team_d }}),
                parseInt({{ $total_team_e }}),
            ],
          chart: {
          type: 'donut',
        },
        labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
</script>
@endpush
