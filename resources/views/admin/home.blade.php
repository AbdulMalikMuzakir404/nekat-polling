@extends('layouts.app')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li style="font-size: 12px" class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li style="font-size: 12px" class="breadcrumb-item text-dark active" aria-current="page">Dashboard</li>
        </ol>
        <h6 style="font-size: 15px" class="font-weight-bolder mb-0">Dashboard</h6>
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

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p style="font-size: 12px" class="mb-0 text-capitalize font-weight-bold">Siswa Sudah Polling</p>
                    <h6 class="font-weight-bolder mb-0">
                      {{ $siswaSudahVoting }}
                      <span style="font-size: 12px" class="text-success font-weight-bolder">siswa</span>
                    </h6>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p style="font-size: 12px" class="mb-0 text-capitalize font-weight-bold">Siswa Belum Polling</p>
                    <h6 class="font-weight-bolder mb-0">
                      {{ $siswaBelumVoting }}
                      <span style="font-size: 12px" class="text-danger font-weight-bolder">siswa</span>
                    </h6>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p style="font-size: 12px" class= mb-0 text-capitalize font-weight-bold">Jumlah Siswa</p>
                    <h6 class="font-weight-bolder mb-0">
                      {{ $jumlahSiswa }}
                      <span style="font-size: 12px" class="text-info font-weight-bolder">siswa</span>
                    </h6>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p style="font-size: 12px" class= mb-0 text-capitalize font-weight-bold">Jumlah Panitia</p>
                    <h6 class="font-weight-bolder mb-0">
                      {{ $jumlahPanitia }}
                      <span style="font-size: 12px" class="text-info font-weight-bolder">panitia</span>
                    </h6>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-atom text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="row mt-3">
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col">
                    <div id="chartBar">
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col">
                      <div id="chartPie">
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    @foreach ($kandidat as $k)
                        <div class="col-sm-5">
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
                                                    <p class="text-xs font-weight-bold mb-0" style="overflow: hidden; max-height: 100px;">{{ $k->visi }}</p>
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
                                                    <p class="text-xs font-weight-bold mb-0" style="overflow: hidden; max-height: 100px;">{{ $k->misi }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('data-osis.create') }}" class="d-grid gap-2 p-3">
                                        <button class="btn btn-primary">Edit</button>
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
@endsection


@push('js')
    <script>
        var options = {
          series: [{
          data: [
                parseInt({{ $total_team_a }}),
                parseInt({{ $total_team_b }}),
                parseInt({{ $total_team_c }}),
                parseInt({{ $total_team_d }}),
                parseInt({{ $total_team_e }}),
          ]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: [
            'Team A',
            'Team B',
            'Team C',
            'Team D',
            'Team E'
          ],
        },
        };

        var chart = new ApexCharts(document.querySelector("#chartBar"), options);
        chart.render();

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

        var chart = new ApexCharts(document.querySelector("#chartPie"), options);
        chart.render();
    </script>
@endpush
