<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ env('APP_URL') }}/frontend/assets/img/apple-icon.png)">
  <link rel="icon" type="image/png" href="{{ env('APP_URL') }}/frontend/assets/img/favicon.png)">
  <title>
    Dashboard
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ env('APP_URL') }}/frontend/assets/css/nucleo-icons.css)" rel="stylesheet" />
  <link href="{{ env('APP_URL') }}/frontend/assets/css/nucleo-svg.css)" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ env('APP_URL') }}/frontend/') }}../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ env('APP_URL') }}/frontend/assets/css/soft-ui-dashboard.css?v=1.0.7)" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>

<body class="">
    <style>
        ::-webkit-scrollbar {
            display: none;
        }
    </style>

  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
            <div class="container-fluid pe-0">
              <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3" href="#">
                OSIS Katapang
              </a>
              <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
              </button>
              <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
                  <li class="nav-item">
                    <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ route('welcome') }}">
                      <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                      Dashboard
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link me-2" href="#">
                      <i class="fa fa-user opacity-6 text-dark me-1"></i>
                      About
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link me-2" href="{{ route('login') }}">
                      <i class="fas fa-key opacity-6 text-dark me-1"></i>
                      Sign In
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <!-- End Navbar -->
      </div>
    </div>
  </div>

  <div class="container-fluid py-5">
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
                                        <h2 class="accordion-header" id="">
                                            <button class="accordion-button collapsed"
                                                style="box-shadow: 0 0 0 0rem " type="button"
                                                data-bs-toggle="collapse">
                                                Jumlah Suara : {{ $k->suara . ' siswa' }}
                                            </button>
                                        </h2>
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

  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="{{ env('APP_URL') }}/frontend/assets/js/core/popper.min.js"></script>
  <script src="{{ env('APP_URL') }}/frontend/assets/js/core/bootstrap.min.js"></script>
  <script src="{{ env('APP_URL') }}/frontend/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="{{ env('APP_URL') }}/frontend/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ env('APP_URL') }}/frontend/assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    // code toaster
  </script>
</body>

</html>
